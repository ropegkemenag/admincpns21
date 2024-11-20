<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  const SSO_URL     = 'https://sso.kemenag.go.id/auth';
  const SSO_SIGNIN  = self::SSO_URL.'/signin';
  const SSO_SIGNOUT = self::SSO_URL.'/signout';
  const SSO_VERIFY  = self::SSO_URL.'/verify';
  const APP_ID      = 'ef64219ea4848f7938e7d9b0f1a9e1a9';

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    if (!$this->session->userdata('nip')) {
      redirect(self::SSO_SIGNIN.'?appid='.self::APP_ID);
    }else{
      redirect('admin/dashboard');
    }
  }

  public function callback()
  {
    $token = $_GET['token'] ?? '';
    if($token){
      $verify_url = self::SSO_VERIFY;
      $ch = curl_init($verify_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Authorization: Bearer '. $token]);

      $response = curl_exec($ch);

      if (curl_errno($ch)) {
          echo "CURL ERROR: ".curl_error($ch);
          curl_close($ch);
          exit();
      }
      curl_close($ch);

      $ret = json_decode($response, true);


      if($ret['status'] == 200)
      {

        $pegawai = $ret['pegawai'];
        $check = $this->crud->get_row('admin',array('nip'=>$pegawai['NIP']));

        if($check){
          $session_data = array(
            'nip_lama'   => $pegawai['NIP_LAMA'],
            'nip'   => $pegawai['NIP'],
            'kode_jabatan' => $pegawai['KODE_JABATAN'],
            'level' => $pegawai['KODE_LEVEL_JABATAN'],
            'jabatan' => $pegawai['FULL_JABATAN'],
            'nama' => $pegawai['NAMA'],
            'photo' => $pegawai['PHOTO_SMALL'],
            'role' => $pegawai['ROLE'],
            'kode_satker' => $check->kode_satker,
            'nama_satker' => $check->satker,
            'group' => $check->group,
            'userpppk' => $check->userpppk,
            'satker1' => $pegawai['KODE_SATKER_1'],
            'satker2' => $pegawai['KODE_SATKER_2'],
            'satker3' => $pegawai['KODE_SATKER_3'],
            'satker4' => $pegawai['KODE_SATKER_4'],
            'satker5' => $pegawai['KODE_SATKER_5'],
            'type' => 'user',
          );
          $this->session->set_userdata($session_data);
          redirect('admin/dashboard');
        }else{
          redirect(self::SSO_SIGNIN.'?appid='.self::APP_ID.'&info=2');
        }
      }else{
        redirect('admin/auth');
      }
    }
    else
    {
      die('Something Wrong');
    }
  }

	public function logout()
	{
	   $this->session->sess_destroy();
	   redirect($this->SSO_SIGNOUT);
	}

    public function is_loggedin($value='')
    {
      if($this->session->userdata('nip'))
      {
        return true;
      }

      return false;
    }

}

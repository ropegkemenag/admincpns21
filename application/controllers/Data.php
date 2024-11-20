<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

  }

  function index()
  {

  }

  public function peserta($page=0)
  {
    $peserta = $this->db->query("SELECT a.nik,a.nopeserta,a.nama,a.kelompok,a.formasi,a.kode_satker,a.satker,a.lokasi_kode,a.agama,b.penguji1 AS penguji_praktek1,b.penguji2 AS penguji_praktek2,b.pewawancara1 AS penguji_wawancara1,b.pewawancara2 AS penguji_wawancara2 FROM peserta a
                                LEFT JOIN zooms b ON b.nopeserta=a.nopeserta")->result();

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($peserta));
  }

  public function serdik()
  {
    $peserta = $this->db->query("SELECT nik,nama,formasi,nuptk,npk,pegid,nrg,CONCAT('https://ropeg.kemenag.go.id/cpns2019/uploads/serdik/',serdik) AS fileserdik FROM peserta WHERE serdik IS NOT NULL")->result();

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($peserta));
  }

  public function absen($type,$nik)
  {
    if($type == 'praker'){
      $this->crud->update('peserta',array('absen_praktik'=>1),array('nik'=>$nik));
    }else if($type == 'psikotest'){
      $this->crud->update('peserta',array('absen_psikotest'=>1),array('nik'=>$nik));
    }else if($type == 'wawancara'){
      $this->crud->update('peserta',array('absen_wawancara'=>1),array('nik'=>$nik));
    }

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode(array('status'=>'ok')));
  }

  public function satker($value='')
  {
    $satker = $this->db->query("SELECT id,satker,kode_satker FROM satker WHERE kode_satker IS NOT NULL")->result();

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($satker));
  }

  public function lokasi($value='')
  {
    $lokasi = $this->crud->get_array('lokasi');

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($lokasi));
  }

  public function penguji($value='')
  {
    $penguji = $this->crud->get_array('penguji');

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($penguji));
  }

  public function embedpeserta($id)
  {
    $data['peserta'] = $this->crud->get_row('peserta',array('nik'=>$id));
    $data['pesertax'] = $this->crud->get_row('peserta_cpns',array('nik'=>$id));

    if(!$data['peserta']){
      echo 'Data peserta tidak ditemukan!';
      exit;
    }
    $data['pendidikan'] = $this->crud->get_array('pendidikan',array('nik'=>$id),array('field'=>'tahun','by'=>'ASC'));
    $data['pekerjaan'] = $this->crud->get_array('pekerjaan',array('nik'=>$id),array('field'=>'mulai_tahun','by'=>'ASC'));
    $data['organisasi'] = $this->crud->get_array('organisasi',array('nik'=>$id),array('field'=>'mulai_tahun','by'=>'ASC'));
    $data['dokumen'] = $this->crud->get_array('dokumen_peserta',array('nik'=>$id));

	$this->load->view('embed_peserta',$data);
  }

  public function status($type,$nik)
  {

  }
}

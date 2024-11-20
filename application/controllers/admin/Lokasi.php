<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('nip'))
		{
			redirect('admin/auth');
		}
  }

  public function index()
  {
    $this->cpns();
  }

  function cpns()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $satker = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));

    $data['lokasi'] = $this->db->query("SELECT lokasi_ujian_nama, COUNT(nik) AS jumlah FROM peserta_cpns WHERE lokasi_kode='$kodesatker' AND status_verifikasi='1' GROUP BY lokasi_ujian_nama")->result();
    $this->load->tpl('lokasi/cpns', $data);
  }

}

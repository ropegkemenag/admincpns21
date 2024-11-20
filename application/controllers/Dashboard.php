<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
	 // echo 'MAINTENIS';
	  //return false;
    // redirect('admin');
    $data['fcpns'] = $this->crud->get_array('fjabatan');
    $data['fpppk'] = $this->db->query("SELECT jabatan, count(jabatan) AS jumlah FROM formasi_pppk GROUP BY jabatan")->result();
    $this->load->view('frontend/index', $data);
  }

  function home()
  {
    // redirect('admin');
    $data['fcpns'] = $this->crud->get_array('fjabatan');
    $data['fpppk'] = $this->db->query("SELECT jabatan, count(jabatan) AS jumlah FROM formasi_pppk GROUP BY jabatan")->result();
    $this->load->view('frontend/index', $data);
  }

  function administrasi()
  {
    $data['peserta'] = $this->crud->get_array('stat_pelamar');
    $this->load->view('frontend/administrasi', $data);
  }

}

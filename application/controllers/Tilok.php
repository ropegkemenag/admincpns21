<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tilok extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index($kode=false)
  {
    if($kode){
      $data['lokasi'] = $this->crud->get_row('lokasi', array('kode_tilok'=>$kode));
      $data['peserta'] = $this->crud->get_array('peserta', array('lokasi_kode'=>$kode));
      // print_r($data['lokasi']);
      $this->load->view('tilok',$data);
    }else{
      show_error('Data tidak ditemukan',404,'Error');
    }
  }

}

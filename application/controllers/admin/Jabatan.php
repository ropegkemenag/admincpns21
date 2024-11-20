<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index($kode='01000000000000')
  {
    $data['parent'] = $this->crud->get_row('tm_satuan_kerja',['KODE_SATUAN_KERJA'=>$kode]);
    $data['satker'] = $this->crud->get_array('tm_satuan_kerja',['KODE_ATASAN'=>$kode]);

    $this->load->tpl('jabatan/index',$data);
  }

  function detail($kode,$detail=false)
  {
    $data['satker'] = $this->crud->get_row('tm_satuan_kerja',['KODE_SATUAN_KERJA'=>$kode]);
    $data['grup'] = $this->crud->get_array('tm_grup_satuan_kerja');
    $data['level'] = $this->crud->get_array('tm_level_jabatan');
    if($detail){
      $data['detail'] = $this->load->view('jabatan/detail/'.$detail, $data, TRUE);;
    }else{
      $data['detail'] = false;
    }
    $this->load->tpl('jabatan/detail',$data);
  }

  public function ubahjabatan()
  {
    $param = array(
              'PIMPINAN' => $this->input->post('pimpinan'),
              'SATUAN_KERJA' => $this->input->post('satuan_kerja'),
              'LEVEL_JABATAN' => $this->input->post('level_jabatan'),
              'KODE_GRUP_SATUAN_KERJA' => $this->input->post('grup'),
              'KAB_KOTA' => $this->input->post('kabkota'),
              'PROVINSI' => $this->input->post('provinsi'),
              'USER_UPDATE' => 1,
              'TIME_UPDATE' => date('Y-m-d H:i:s'),
             );

    $update = $this->crud->update('tm_satuan_kerja',$param,['kode_satuan_kerja'=>$this->input->post('kode_satuan_kerja')]);

    $message = array('status'=>true,'message'=>'Data telah diubah');
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($message));
  }

  public function saveuraian()
  {
    $param = array(
              'id_parent' => $this->input->post('parent'),
              'kode_satuan_kerja' => $this->input->post('kode_satuan_kerja'),
              'nomor' => $this->input->post('keterangan'),
              'uraian' => $this->input->post('uraian'),
              'keterangan' => $this->input->post('keterangan'),
              'created_by' => 1,
              'created_date' => date('Y-m-d H:i:s'),
             );

    $insert = $this->crud->insert('uraian_jabatan',$param);

    $message = array('status'=>true,'message'=>'Data telah ditambahkan');
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($message));
  }

  public function struktur($kode)
  {
    $satker = $this->crud->get_row('tm_satuan_kerja',['KODE_SATUAN_KERJA'=>$kode]);
    $subs = $this->crud->get_array('tm_satuan_kerja',['KODE_ATASAN'=>$kode]);
    $parent = $this->crud->get_row('tm_satuan_kerja',['KODE_SATUAN_KERJA'=>$satker->KODE_ATASAN]);

    foreach ($subs as $s) {
      $sub[] = array('name' => $s->SATUAN_KERJA,'title'=>$s->SATUAN_KERJA);
    }
    $struktur = array(
      'name' => $parent->SATUAN_KERJA,
      'title' => $parent->SATUAN_KERJA,
      'children' =>array(
        array('name' => $satker->SATUAN_KERJA, 'title' => $satker->PIMPINAN, 'children' => $sub)
      )
     );

     $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($struktur));
  }

}

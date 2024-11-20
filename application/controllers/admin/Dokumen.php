<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('nip'))
		{
			redirect('admin/auth');
		}
  }

  function index()
  {
    if($this->session->userdata('kode_satker') == '30120001'){
      $data['dokumen'] = $this->crud->get_array('dokumen');
    }else{
      $data['dokumen'] = $this->crud->get_array('dokumen', array('nip'=>$this->session->userdata('nip')));
    }
    $this->load->tpl('dokumen/index', $data);
  }

  function add()
  {
    $this->load->tpl('dokumen/add');
  }

  public function save()
  {
    $config['upload_path']   = './uploads/dokumen/';
    $config['overwrite']      = TRUE;
    $config['allowed_types'] = '*';
    $config['file_name']      = time();
    $this->load->library('upload', $config);

    if ( $this->upload->do_upload('dokumen') ) {
      $param = array(
                    'keterangan' => $this->input->post('keterangan'),
                    'satker' => $this->session->userdata('nama_satker'),
                    'kode_satker' => $this->session->userdata('kode_satker'),
                    'nip' => $this->session->userdata('nip'),
                    'kategori' => $this->input->post('kategori'),
                    'dokumen' => $this->upload->data('file_name'),
                    'status' => 0,
                    'created_date' => date('Y-m-d H:i:s'),
                   );
      $insert = $this->crud->insert('dokumen', $param);
      $this->session->set_flashdata('message', 'Dokumen telah ditambahkan');
    }else{
      $this->session->set_flashdata('message', $this->upload->display_errors());
    }

    redirect('admin/dokumen');
  }

  public function setstatus($status,$id)
  {
    $update = $this->crud->update('dokumen', array('status'=>$status), array('id'=>$id));
    $this->session->set_flashdata('message', 'Status Dokumen telah diubah');
    redirect('admin/dokumen');
  }

  public function tolak()
  {
    $update = $this->crud->update('dokumen', array('status'=>2,'alasan_tolak'=>$this->input->post('alasan')), array('id'=>$this->input->post('id')));
    echo 'ok';
  }

}

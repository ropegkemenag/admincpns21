<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller{

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
    $idsatker = $this->session->userdata('kode_satker');

    $this->form_validation->set_rules('kontak', 'Kontak', 'required');
    // $this->form_validation->set_rules('informasi', 'Informasi', 'required');

    if ($this->form_validation->run() == true)
  	{
      $input = array(
                'kontak' => $this->input->post('kontak'),
                'informasi' => $this->input->post('informasi'),
               );
      $update = $this->crud->update('satker', $input, array('kode_satker' => $idsatker));
      $this->session->set_flashdata('message', 'Data berhasil diupdate.');
    }

    $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
    $data['satker'] = $this->crud->get_row('satker', array('kode_satker'=>$idsatker));

  	$this->load->tpl('skb/info', $data);
  }
}

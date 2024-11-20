<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panitia extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('nip'))
		{
			redirect('admin/auth');
		}
  }

  function index($lokasi=false)
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $data['lokasi'] = $this->db->query("SELECT a.lokasi_kode,a.lokasi_titik, a.lokasi_kabupaten, a.lokasi_provinsi,lokasi.jumlah_ruangan,c.tilok,c.alamat,c.maps,c.kontak,c.kontak_panitia, COUNT(a.nik) AS jumlah FROM peserta a
                                      INNER JOIN lokasi ON lokasi.kode_tilok=a.lokasi_kode
                                      LEFT JOIN lokasi_titik c ON c.lokasi_kode=a.lokasi_kode
                                      WHERE lokasi.kode_satker='$kodesatker'
                                      GROUP BY a.lokasi_kode")->result();

    $this->load->tpl('skb/panitia', $data);
  }
}

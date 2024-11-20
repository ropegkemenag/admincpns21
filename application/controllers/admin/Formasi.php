<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Formasi extends CI_Controller{

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
    $this->cpns();
  }

  public function cpns($satker=false)
  {
    $kodesatker = $this->session->userdata('kode_satker');
    if($satker){
      $data['kodesatker'] = $satker;
      $data['cpns'] = $this->crud->get_array('formasi', array('lokasi_formasi_kode'=>$satker));
    }else{
      $data['cpns'] = $this->crud->get_array('formasi', array('lokasi_formasi_kode'=>$kodesatker));
    }

    if($this->session->userdata('kode_satker') == '30120001'){
      $data['satker'] = $this->crud->get_array('satker');
    }

    $this->load->tpl('formasi/cpns', $data);
  }

  public function cpnsmenpan($satker=false)
  {
    $kodesatker = $this->session->userdata('kode_satker');
    if($satker){
      $data['kodesatker'] = $satker;
      $data['cpns'] = $this->crud->get_array('formasi_cpns', array('kode_satker'=>$satker));
    }else{
      $data['cpns'] = $this->crud->get_array('formasi_cpns', array('kode_satker'=>$kodesatker));
    }

    if($this->session->userdata('kode_satker') == '30120001'){
      $data['satker'] = $this->crud->get_array('satker');
    }

    $this->load->tpl('formasi/cpns_menpan', $data);
  }

  public function pppk()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $data['pppk'] = $this->crud->get_array('formasi_pppk', array('kode_satker'=>$kodesatker));
    $this->load->tpl('formasi/pppk', $data);
  }

  public function exportcpns()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $fileName = 'formasi-cpns-2021.xlsx';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'NO');
    $sheet->setCellValue('B1', 'KELOMPOK');
    $sheet->setCellValue('C1', 'JABATAN');
    $sheet->setCellValue('D1', 'KUALIFIKASI PENDIDIKAN');
    $sheet->setCellValue('E1', 'JUMLAH');
    $sheet->setCellValue('F1', 'UNIT PENEMPATAN');

    $cpns = $this->crud->get_array('formasi_cpns', array('kode_satker'=>$kodesatker));
    $i = 2;
    $no = 1;
    foreach ($cpns as $row) {
      $sheet->setCellValue('A'.$i, $no);
      $sheet->setCellValue('B'.$i, $row->kelompok);
      $sheet->setCellValue('C'.$i, $row->jabatan);
      $sheet->setCellValue('D'.$i, $row->pendidikan);
      $sheet->setCellValue('E'.$i, $row->jumlah);
      $sheet->setCellValue('F'.$i, $row->unit_kerja);
      $i++;
      $no++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');
  }

  public function exportpppk()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $fileName = 'formasi-pppk-2021.xlsx';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'NO');
    $sheet->setCellValue('B1', 'KATEGORI UNIT');
    $sheet->setCellValue('C1', 'JABATAN');
    $sheet->setCellValue('D1', 'KUALIFIKASI PENDIDIKAN');
    $sheet->setCellValue('E1', 'UNIT PENEMPATAN');

    $cpns = $this->crud->get_array('formasi_pppk', array('kode_satker'=>$kodesatker));
    $i = 2;
    $no = 1;
    foreach ($cpns as $row) {
      $sheet->setCellValue('A'.$i, $no);
      $sheet->setCellValue('B'.$i, $row->kategori_unit);
      $sheet->setCellValue('C'.$i, $row->jabatan);
      $sheet->setCellValue('D'.$i, $row->pendidikan);
      $sheet->setCellValue('E'.$i, $row->unit_kerja);
      $i++;
      $no++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');
  }

}

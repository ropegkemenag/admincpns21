<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Jadwal extends CI_Controller{

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
    $satker = $this->session->userdata('kode_satker');
    $data['peserta'] = $this->db->query("SELECT
                                        peserta.*,
                                        zooms.*
                                        FROM
                                        peserta
                                        INNER JOIN zooms ON peserta.nopeserta = zooms.nopeserta
                                        WHERE peserta.kode_satker='$satker'")->result();
    $data['accounts'] = $this->db->query("SELECT DISTINCT(email_praktik) FROM zooms
                                        WHERE kode_satker='$satker'")->result();
    $this->load->tpl('skb/jadwal_zoom', $data);
  }

  public function importjadwal()
  {
    $fname = time();
    $config['upload_path']    = './temp/';
    $config['allowed_types']  = 'xlsx';
    $config['file_name']      = $fname;
    $config['overwrite']      = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('lampiran')) {
      $inputFileType = 'Xlsx';
      $inputFileName = './temp/'.$fname.'.xlsx';

      $reader = IOFactory::createReader($inputFileType);
      $spreadsheet = $reader->load($inputFileName);
      $sheetData = (object) $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

      $satker = $this->session->userdata('kode_satker');

      $i = 0;
      foreach ($sheetData as $row) {
        if($i > 0){

          $nopeserta  = preg_replace( '/[\x{200B}-\x{200D}]/u', '', $row['A'] );
          $nopeserta  = str_replace("'", "", $nopeserta );
          $emailprak  = $row['B'];
          $zoompraktik  = $row['C'];
          $passpraktik  = $row['D'];
          $emailwaw  = $row['E'];
          $zoomwawancara  = $row['F'];
          $passwawancara  = $row['G'];
          $pengujiprak1  = $row['H'];
          $pengujiprak2  = $row['I'];
          $pengujiwaw1  = $row['J'];
          $pengujiwaw2  = $row['K'];

          // $namap1 = $this->crud->get_row('penguji',array('nip'=>preg_replace( '/[\x{200B}-\x{200D}]/u', '', $pengujiprak1 )))->nama;
          // $namap2 = $this->crud->get_row('penguji',array('nip'=>preg_replace( '/[\x{200B}-\x{200D}]/u', '', $pengujiprak2 )))->nama;
          $namaw1 = $this->crud->get_row('penguji',array('nip'=>preg_replace( '/[\x{200B}-\x{200D}]/u', '', $pengujiwaw1 )))->nama;
          $namaw2 = $this->crud->get_row('penguji',array('nip'=>preg_replace( '/[\x{200B}-\x{200D}]/u', '', $pengujiwaw2 )))->nama;

          $param = array(
            // 'email_praktik' => $emailprak,
            // 'id_praktik' => $zoompraktik,
            // 'password_praktik' => $passpraktik,
            'email_wawancara' => $emailwaw,
            'id_wawancara' => $zoomwawancara,
            'password_wawancara' => $passwawancara,
            // 'penguji1' => $pengujiprak1,
            // 'nama_penguji1' => $namap1,
            // 'penguji2' => $pengujiprak2,
            // 'nama_penguji2' => $namap2,
            'pewawancara1' => $pengujiwaw1,
            'nama_pewawancara1' => $namaw1,
            'pewawancara2' => $pengujiwaw2,
            'nama_pewawancara2' => $namaw2
          );
          $update = $this->crud->update('zooms',$param,array('nopeserta'=>$nopeserta,'kode_satker'=>$satker));
        }
        $i++;
      }

      $this->session->set_flashdata('message','Selesai');
    }else{
      $this->session->set_flashdata('message',$this->upload->display_errors());
    }
    redirect('admin/skb/jadwal');
  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('nip'))
		{
			redirect('auth');
		}
  }

  function index()
  {
    $kodesatker = $this->session->userdata('kode_satker');

    $data['formasi'] = $this->db->query("SELECT id,lokasi_formasi_kode,jabatan,jenis_formasi,jumlah,
                                        (SELECT COUNT(nik) FROM peserta WHERE kode_satker=formasi.lokasi_formasi_kode AND kode_formasi=formasi.jabatan_id AND jenis=formasi.jenis_formasi) AS jumlah_skb
                                         FROM formasi WHERE lokasi_formasi_kode='$kodesatker'")->result();

    $this->load->tpl('skb/dashboard', $data);
  }

  public function export($jenis='cpns')
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $satker = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));
    if($jenis=='cpns'){
      $cpns = $this->crud->get_array('peserta_cpns', array('lokasi_kode'=>$kodesatker));
      $fileName = 'peserta-cpns-'.get_option('last_update').'.xlsx';
    }else if($jenis=='pppk'){
      $cpns = $this->crud->get_array('peserta_pppk', array('lokasi_parent'=>$kodesatker));
      $fileName = 'peserta-pppk-'.get_option('last_update').'.xlsx';
    }

    $spreadsheet = new Spreadsheet();

    $range = 'B2:D'.count($cpns);
    $sheet = $spreadsheet->getActiveSheet();

    // $sheet->getStyle($range)
    // ->getNumberFormat()
    // ->setFormatCode( \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT );

    $sheet->setCellValue('A1', 'remark');
    $sheet->setCellValue('B1', 'nik');
    $sheet->setCellValue('C1', 'no_register');
    $sheet->setCellValue('D1', 'no_peserta');
    $sheet->setCellValue('E1', 'tgl_daftar');
    $sheet->setCellValue('F1', 'nama_ktp');
    $sheet->setCellValue('G1', 'tempat_lahir_ktp');
    $sheet->setCellValue('H1', 'tgl_lahir_ktp');
    $sheet->setCellValue('I1', 'gelar_depan_ijazah');
    $sheet->setCellValue('J1', 'nama_ijazah');
    $sheet->setCellValue('K1', 'gelar_belakang_ijazah');
    $sheet->setCellValue('L1', 'tempat_lahir_ijazah');
    $sheet->setCellValue('M1', 'tgl_lahir_ijazah');
    $sheet->setCellValue('N1', 'jenis_kelamin');
    $sheet->setCellValue('O1', 'agama');
    $sheet->setCellValue('P1', 'jenis_disabilitas');
    $sheet->setCellValue('Q1', 'link_disabilitas');
    $sheet->setCellValue('R1', 'alamat_domisili');
    $sheet->setCellValue('S1', 'kabkota_domisili');
    $sheet->setCellValue('T1', 'provinsi_domisili');
    $sheet->setCellValue('U1', 'lembaga_pendidikan');
    $sheet->setCellValue('V1', 'prodi');
    $sheet->setCellValue('W1', 'no_ijazah');
    $sheet->setCellValue('X1', 'akreditasi_lembaga');
    $sheet->setCellValue('Y1', 'akreditasi_prodi');
    $sheet->setCellValue('Z1', 'ipk_nilai');
    $sheet->setCellValue('AA1', 'jabatan_kode');
    $sheet->setCellValue('AB1', 'jabatan_nama');
    $sheet->setCellValue('AC1', 'lokasi_kode');
    $sheet->setCellValue('FD1', 'lokasi_nama');
    $sheet->setCellValue('AE1', 'jenis_formasi');
    $sheet->setCellValue('AF1', 'pendidikan_kode');
    $sheet->setCellValue('AG1', 'pendidikan_nama');
    $sheet->setCellValue('AH1', 'lokasi_ujian_id');
    $sheet->setCellValue('AI1', 'lokasi_ujian_nama');
    $sheet->setCellValue('AJ1', 'lokasi_ujian_luar_negeri_id');
    $sheet->setCellValue('AK1', 'lokasi_ujian_luar_negeri_nama');
    $sheet->setCellValue('AL1', 'email');
    $sheet->setCellValue('AM1', 'pt_dikti');
    $sheet->setCellValue('AN1', 'prodi_dikti');
    $sheet->setCellValue('AO1', 'status_verifikasi');
    $sheet->setCellValue('AP1', 'alasan_tms');
    $sheet->setCellValue('AQ1', 'alasan_tms_detail');
    $sheet->setCellValue('AR1', 'tanggal_verifikasi');
    $sheet->setCellValue('AS1', 'verifikator_username');
    $sheet->setCellValue('AT1', 'verifikator_nama');
    $sheet->setCellValue('AU1', 'supervisor_username');
    $sheet->setCellValue('AV1', 'supervisor_nama');
    $sheet->setCellValue('AW1', 'tanggal_supervisi');

    $i = 2;
    foreach ($cpns as $row) {
      $sheet->setCellValue('A'.$i, $row->remark);
      $sheet->getCell('B'.$i)->setValueExplicit($row->nik,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
      $sheet->getCell('C'.$i)->setValueExplicit($row->no_register,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
      $sheet->getCell('D'.$i)->setValueExplicit($row->no_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
      $sheet->setCellValue('E'.$i, $row->tgl_daftar);
      $sheet->setCellValue('F'.$i, $row->nama_ktp);
      $sheet->setCellValue('G'.$i, $row->tempat_lahir_ktp);
      $sheet->setCellValue('H'.$i, $row->tgl_lahir_ktp);
      $sheet->setCellValue('I'.$i, $row->gelar_depan_ijazah);
      $sheet->setCellValue('J'.$i, $row->nama_ijazah);
      $sheet->setCellValue('K'.$i, $row->gelar_belakang_ijazah);
      $sheet->setCellValue('L'.$i, $row->tempat_lahir_ijazah);
      $sheet->setCellValue('M'.$i, $row->tgl_lahir_ijazah);
      $sheet->setCellValue('N'.$i, $row->jenis_kelamin);
      $sheet->setCellValue('O'.$i, $row->agama);
      $sheet->setCellValue('P'.$i, $row->jenis_disabilitas);
      $sheet->setCellValue('Q'.$i, $row->link_disabilitas);
      $sheet->setCellValue('R'.$i, $row->alamat_domisili);
      $sheet->setCellValue('S'.$i, $row->kabkota_domisili);
      $sheet->setCellValue('T'.$i, $row->provinsi_domisili);
      $sheet->setCellValue('U'.$i, $row->lembaga_pendidikan);
      $sheet->setCellValue('V'.$i, $row->prodi);
      $sheet->setCellValue('W'.$i, $row->no_ijazah);
      $sheet->setCellValue('X'.$i, $row->akreditasi_lembaga);
      $sheet->setCellValue('Y'.$i, $row->akreditasi_prodi);
      $sheet->setCellValue('Z'.$i, $row->ipk_nilai);
      $sheet->setCellValue('AA'.$i, $row->jabatan_kode);
      $sheet->setCellValue('AB'.$i, $row->jabatan_nama);
      $sheet->setCellValue('AC'.$i, $row->lokasi_kode);
      $sheet->setCellValue('AD'.$i, $row->lokasi_nama);
      $sheet->setCellValue('AE'.$i, $row->jenis_formasi);
      $sheet->setCellValue('AF'.$i, $row->pendidikan_kode);
      $sheet->setCellValue('AG'.$i, $row->pendidikan_nama);
      $sheet->setCellValue('AH'.$i, $row->lokasi_ujian_id);
      $sheet->setCellValue('AI'.$i, $row->lokasi_ujian_nama);
      $sheet->setCellValue('AJ'.$i, $row->lokasi_ujian_luar_negeri_id);
      $sheet->setCellValue('AK'.$i, $row->lokasi_ujian_luar_negeri_nama);
      $sheet->setCellValue('AL'.$i, $row->email);
      $sheet->setCellValue('AM'.$i, $row->pt_dikti);
      $sheet->setCellValue('AN'.$i, $row->prodi_dikti);
      $sheet->setCellValue('AO'.$i, $row->status_verifikasi);
      $sheet->setCellValue('AP'.$i, $row->alasan_tms);
      $sheet->setCellValue('AQ'.$i, $row->alasan_tms_detail);
      $sheet->setCellValue('AR'.$i, $row->tanggal_verifikasi);
      $sheet->setCellValue('AS'.$i, $row->verifikator_username);
      $sheet->setCellValue('AT'.$i, $row->verifikator_nama);
      $sheet->setCellValue('AU'.$i, $row->supervisor_username);
      $sheet->setCellValue('AV'.$i, $row->supervisor_nama);
      $sheet->setCellValue('AW'.$i, $row->tanggal_supervisi);
      $i++;
    }

    // $sheet->getStyle($range)->getNumberFormat()
    // ->setFormatCode('@');

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');
  }

}

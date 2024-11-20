<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Ilovepdf\Ilovepdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class download extends CI_Controller{

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
    $kodesatker = $this->session->userdata('kode_satker');
    $data['jfcpns'] = $this->crud->get_sum('jumlah','formasi_cpns',array('kode_satker'=>$kodesatker));
    $data['jfpppk'] = $this->crud->get_count('formasi_pppk',array('kode_satker'=>$kodesatker));

    $satker = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));
    // echo $satker->kode_satker_bkn_new;
    $data['pelamar_cpns'] = $this->crud->get_count('peserta_cpns', array('lokasi_kode'=>$kodesatker));
    $data['jabatans'] = $this->crud->preport_jabatan($kodesatker);
    $data['verifikasi'] = $this->crud->preport_verifikasi($kodesatker);
    $this->load->tpl('index', $data);
  }

  function indexx()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $data['jfcpns'] = $this->crud->get_sum('jumlah','formasi_cpns',array('kode_satker'=>$kodesatker));
    $data['jfpppk'] = $this->crud->get_count('formasi_pppk',array('kode_satker'=>$kodesatker));

    $satker = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));
    // print_r($satker);
    $data['pelamar_cpns'] = $this->crud->get_count('peserta_cpns', array('lokasi_kode'=>$kodesatker));
    $data['jabatans'] = $this->crud->preport_jabatan($kodesatker);
    $this->load->tpl('index', $data);
    // $this->output->enable_profiler(TRUE);
  }

  public function surat()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $satker = $this->crud->get_row('satker', array('kode_satker_bkn'=>$kodesatker));
    $jfcpns = $this->crud->get_sum('jumlah','formasi_cpns',array('kode_satker'=>$kodesatker));
    $jfpppk = $this->crud->get_count('formasi_pppk',array('kode_satker'=>$kodesatker));

    $this->load->helper('file');
    $filename = 'Surat-pengantar-'.$kodesatker.'.docx';
    $filename2 = 'Surat-pengantar-'.$kodesatker.'.pdf';

    if(read_file('./uploads/'.$filename2)){
      $this->load->helper('download');
      force_download('./uploads/'.$filename2, NULL);
    }else{
      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH.'assets/surat_penetapan_formasi.docx');
      $templateProcessor->setValue('nomorsurat', $satker->nomor_surat);
      $templateProcessor->setValue('satker', $satker->satker);
      $templateProcessor->setValue('pimpinan', $satker->pimpinan);
      $templateProcessor->setValue('jcpns', $jfcpns);
      $templateProcessor->setValue('jpppk', $jfpppk);
      $templateProcessor->setValue('jtotal', $jfcpns+$jfpppk);

      $templateProcessor->saveAs('uploads/'.$filename);

      $ilovepdf = $this->ilovepdf();
      $myTaskConvertOffice = $ilovepdf->newTask('officepdf');
      $file1 = $myTaskConvertOffice->addFile('./uploads/'.$filename);
      $myTaskConvertOffice->execute();
      // $myTaskConvertOffice->download();
      $myTaskConvertOffice->download('uploads/');

      $this->load->helper('download');
      force_download('./uploads/'.$filename2, NULL);
    }

  }


  public function ilovepdf()
  {
      // $public = array('project_public_ac86ff73b6abf0abee71d40e09ca1672_PG7l61b20eb41c9b9bdc9a0ea679aacb2c112','project_public_ac86ff73b6abf0abee71d40e09ca1672_PG7l61b20eb41c9b9bdc9a0ea679aacb2c112');
      // $secret = array('secret_key_9e255b7370cceebf66b6c3a77df4ef66_WNctP5305f7a927f4dfd15c7dc6288b7eee92','secret_key_179e01370672d38afc00afdcfbb46bd1_axjzTd2d43204eac5ca0f83dd4925bfd0fc1e');
      // $x = rand(0, 1);
      // return new Ilovepdf($public[$x],$secret[$x]);
      $public = 'project_public_ac86ff73b6abf0abee71d40e09ca1672_PG7l61b20eb41c9b9bdc9a0ea679aacb2c112';
      $secret = 'secret_key_179e01370672d38afc00afdcfbb46bd1_axjzTd2d43204eac5ca0f83dd4925bfd0fc1e';
      return new Ilovepdf($public,$secret);
  }

  public function qrcode($code)
  {
    $sertifikat = $this->crud->get_row('sertifikat', array('kode'=>$code));
    $jenis = $this->crud->get_row('jenis_sertifikat', array('id'=>$sertifikat->jenis));

    $qrCode = new QrCode(site_url()."home/validasi/".$dokumen->kode);

    $qrCode->setSize(500);
    $qrCode->setMargin(5);
    $qrCode->setEncoding('UTF-8');
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
    $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
    $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
    $qrCode->setLogoPath('./assets/images/logokemenag.png');
    $qrCode->setLogoSize(200);

    // header('Content-Type: '.$qrCode->getContentType());
    // echo $qrCode->writeString();
    $qrCode->writeFile('uploads/qrcode-'.$code.'.png');
  }

  public function sanggah()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $satker = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));
    $cpns = $this->crud->get_array('cpns_sanggah', array('lokasi_kode'=>$kodesatker));

    $fileName = 'sanggah-cpns.xlsx';
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
    $sheet->setCellValue('AX1', 'sanggah');
    $sheet->setCellValue('AY1', 'sanggah_diterima');
    $sheet->setCellValue('AZ1', 'jawab_sanggah');
    $sheet->setCellValue('BA1', 'tgl_jawab_sanggah');
    $sheet->setCellValue('BB1', 'jawab_sanggah_nama');

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
      $sheet->setCellValue('AX'.$i, $row->sanggah);
      $sheet->setCellValue('AY'.$i, $row->sanggah_diterima);
      $sheet->setCellValue('AZ'.$i, $row->jawab_sanggah);
      $sheet->setCellValue('BA'.$i, $row->tgl_jawab_sanggah);
      $sheet->setCellValue('BB'.$i, $row->jawab_sanggah_nama);
      $i++;
    }

    // $sheet->getStyle($range)->getNumberFormat()
    // ->setFormatCode('@');

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');
  }

  public function jadwalskd()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $satker = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));
    $cpns = $this->crud->get_array('vjadwalcpns', array('lokasi_ujian_id'=>$satker->lokasi));

    $fileName = 'jadwal-skd-cpns.xlsx';
    $spreadsheet = new Spreadsheet();

    $range = 'B2:D'.count($cpns);
    $sheet = $spreadsheet->getActiveSheet();

    // $sheet->getStyle($range)
    // ->getNumberFormat()
    // ->setFormatCode( \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT );

    $sheet->setCellValue('A1', 'Nomor Peserta');
    $sheet->setCellValue('B1', 'Nomor Register');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Lokasi Formasi');
    $sheet->setCellValue('E1', 'Formasi');
    $sheet->setCellValue('F1', 'Tanggal');
    $sheet->setCellValue('G1', 'Hari');
    $sheet->setCellValue('H1', 'Sesi');
    $sheet->setCellValue('I1', 'Ruangan');

    $i = 2;
    foreach ($cpns as $row) {
      $sheet->getCell('A'.$i)->setValueExplicit($row->nomor_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
      $sheet->getCell('B'.$i)->setValueExplicit($row->no_register,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
      $sheet->setCellValue('C'.$i, $row->nama);
      $sheet->setCellValue('D'.$i, $row->lokasi_nama);
      $sheet->setCellValue('E'.$i, $row->jabatan_nama);
      $sheet->setCellValue('F'.$i, $row->tanggal);
      $sheet->setCellValue('G'.$i, $row->hari);
      $sheet->setCellValue('H'.$i, $row->sesi);
      $sheet->setCellValue('I'.$i, $row->ruangan);
      $i++;
    }

    // $sheet->getStyle($range)->getNumberFormat()
    // ->setFormatCode('@');

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');
  }

  public function templatejadwal()
  {
    $fileName = 'template-jadwal-skd-cpns.xlsx';
    $spreadsheet = new Spreadsheet();

    $start_date = $this->input->post('start_date');
    $nomor_ruang = $this->input->post('nomor_ruang');
    $pc = $this->input->post('jumlah_pc');
    $jumlah_sesi = $this->input->post('jumlah_sesi');
    $jumlah_pc = array_sum($pc);
    $peserta = $this->input->post('jumlah_peserta');

    $range = 'B2:D'.$peserta;
    $sheet = $spreadsheet->getActiveSheet();

    // $sheet->getStyle($range)
    // ->getNumberFormat()
    // ->setFormatCode( \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT );

    $sheet->setCellValue('A1', 'NOMOR PESERTA');
    $sheet->setCellValue('B1', 'NAMA');
    $sheet->setCellValue('C1', 'TANGGAL');
    $sheet->setCellValue('D1', 'HARI');
    $sheet->setCellValue('E1', 'SESI');
    $sheet->setCellValue('F1', 'RUANGAN');
    $sheet->setCellValue('G1', 'NO. URUT');

    // $tanggal = date('d-m-Y', strtotime("-1 day", strtotime($start_date)));
    $tanggal = date('d-m-Y', strtotime($start_date));
    $jd = $jumlah_sesi*$jumlah_pc;
    $sesi = 0;
    $no = 1;
    $ruang = 0;
    $nopcruang = 1;

    $d = $jd;
    $jh = 1;
    $i = 2;

    for ($x=0; $x < $peserta; $x++) {

      if(date('N', strtotime($tanggal)) == 5){
        $jsesi = 2;
        $d = $jumlah_pc*2;
      }else{
        $jsesi = $jumlah_sesi;
        $d = $jd;
      }

      // if($i%$d == 0){
      if($jh > $d){
        $tanggal = date('d-m-Y', strtotime("+1 day", strtotime($tanggal)));
        $sesi = 0;
        $jh = 1;
      }

      if($x%$jumlah_pc == 0){
        $sesi = $sesi+1;
        if($sesi > $jsesi){
          $sesi = 1;
        }

        $no = 1;
        $nopcruang = 1;
        $ruang = 0;
      }


      if($nopcruang > $pc[$ruang]){
        $ruang++;
        $nopcruang = 1;
      }

      $namaruang = $nomor_ruang[$ruang];

        $sheet->setCellValue('A'.$i, '');
        $sheet->setCellValue('B'.$i, '');
        $sheet->setCellValue('C'.$i, $tanggal);
        $sheet->setCellValue('D'.$i, hari($tanggal));
        $sheet->setCellValue('E'.$i, 'Sesi '.$sesi);
        $sheet->setCellValue('F'.$i, 'Ruang '.$namaruang);
        $sheet->setCellValue('G'.$i, $no);

      $i++;
      $no++;
      $jh++;
      $nopcruang++;
    }

    // $sheet->getStyle($range)->getNumberFormat()
    // ->setFormatCode('@');

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');
  }

  public function templatejadwalx()
  {
    $start_date = $this->input->post('start_date');
    $nomor_ruang = $this->input->post('nomor_ruang');
    $pc = $this->input->post('jumlah_pc');
    $jumlah_sesi = $this->input->post('jumlah_sesi');
    $jumlah_pc = array_sum($pc);
    // $peserta = $this->input->post('jumlah_peserta');
    $peserta = $this->input->post('jumlah_peserta');

    ?>
    <table class="table">
      <thead>
        <tr>
          <th>NOMOR PESERTA</th>
          <th>NAMA</th>
          <th>TANGGAL</th>
          <th>HARI</th>
          <th>SESI</th>
          <th>RUANGAN</th>
          <th>NOMOR URUT</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $tanggal = date('d-m-Y', strtotime("-1 day", strtotime($start_date)));
        $jd = $jumlah_sesi*$jumlah_pc;
        $sesi = 0;
        $no = 1;
        $ruang = 0;
        $nopcruang = 1;

        $d = $jd;
        $jh = 1;
        for ($i=0; $i < $peserta; $i++) {

          if(date('N', strtotime($tanggal)) == 5){
            $jsesi = 2;
            $d = $jumlah_pc*2;
          }else{
            $jsesi = $jumlah_sesi;
            $d = $jd;
          }

          // if($i%$d == 0){
          if($jh > $d){
            $tanggal = date('d-m-Y', strtotime("+1 day", strtotime($tanggal)));
            $sesi = 0;
            $jh = 1;
          }

          if($i%$jumlah_pc == 0){
            $sesi = $sesi+1;
            if($sesi > $jsesi){
              $sesi = 1;
            }

            $no = 1;
            $nopcruang = 1;
            $ruang = 0;
          }


          if($nopcruang > $pc[$ruang]){
            $ruang++;
            $nopcruang = 1;
          }

          $namaruang = $nomor_ruang[$ruang];

          // if($i == )
          echo '<tr>
                  <th></th>
                  <th>'.$jh.'</th>
                  <th>'.$tanggal.'</th>
                  <th>'.hari($tanggal).'</th>
                  <th>Sesi '.$sesi.'</th>
                  <th>Ruang '.$namaruang.'</th>
                  <th>'.$no.'</th>
                </tr>';
          $no++;
          $jh++;
          $nopcruang++;
        }

        // for ($i=0; $i < count($jumlah_ruang); $i++) {
        //   for ($j=0; $j < $pc[$i]; $j++) {
        //     echo '<tr>
        //             <th></th>
        //             <th></th>
        //             <th></th>
        //             <th></th>
        //             <th></th>
        //             <th></th>
        //             <th>Ruang '.$jumlah_ruang[$i].'</th>
        //             <th>'.$no.'</th>
        //           </tr>';
        //   }
        // }
        ?>
      </tbody>
    </table>
    <?php

    // echo count($ruang);
    // print_r($ruang);
  }

}

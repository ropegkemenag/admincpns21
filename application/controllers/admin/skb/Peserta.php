<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Peserta extends CI_Controller{

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

    $data['peserta'] = $this->crud->get_array('peserta', array('kode_satker'=>$kodesatker));
    $data['lokasi'] = $this->db->query("SELECT a.lokasi_titik, a.lokasi_kabupaten, a.lokasi_provinsi, b.tilok, b.alamat, b.maps, b.kontak_panitia, COUNT(a.nik) AS jumlah FROM peserta a
                                        LEFT JOIN lokasi_titik b ON b.lokasi_kode=a.lokasi_kode
                                        WHERE a.kode_satker='$kodesatker'
                                        GROUP BY a.lokasi_titik,a.lokasi_kabupaten, a.lokasi_provinsi")->result();

    // $data['jabatans'] = $this->crud->preport_jabatan($satker->kode_satker_bkn_new);
    $this->load->tpl('skb/peserta', $data);
  }

  function nilai()
  {
    $kodesatker = $this->session->userdata('kode_satker');

    $data['peserta'] = $this->crud->get_array('peserta', array('kode_satker'=>$kodesatker));

    $this->load->tpl('skb/nilai', $data);
  }

  public function detail($id)
  {
    $satker = $this->session->userdata('kode_satker');

    $peserta = $this->crud->get_row('peserta',array('nik'=>$id,'kode_satker'=>$satker));

    if(!$peserta){
      echo 'Data peserta tidak ditemukan!';
      exit;
    }
    $pendidikan = $this->crud->get_array('pendidikan',array('nik'=>$id),array('field'=>'tahun','by'=>'ASC'));
    $pekerjaan = $this->crud->get_array('pekerjaan',array('nik'=>$id),array('field'=>'mulai_tahun','by'=>'ASC'));
    $organisasi = $this->crud->get_array('organisasi',array('nik'=>$id),array('field'=>'mulai_tahun','by'=>'ASC'));
    $dokumen = $this->crud->get_array('dokumen_peserta',array('nik'=>$id));
  ?>
    <table class="table table-striped">
      <tbody>
        <tr>
          <th></th>
          <td><img src="https://casn.kemenag.go.id/peserta/uploads/foto/<?php echo $peserta->nopeserta.'.jpg';?>" width="200px"></td>
        </tr>
		      <tr>
          <th>NIK</th>
          <td><?php echo $peserta->nik;?></td>
        </tr>
        <tr>
          <th>Nomor Peserta</th>
          <td><?php echo $peserta->nopeserta;?></td>
        </tr>
        <tr>
          <th>Nama</th>
          <td><?php echo $peserta->nama;?></td>
        </tr>
        <tr>
          <th>Formasi</th>
          <td><?php echo $peserta->formasi;?></td>
        </tr>
        <tr>
          <th>Jenis</th>
          <td><?php echo $peserta->jenis;?></td>
        </tr>
        <tr>
          <th>Jenis Disabilitas</th>
          <td><?php echo $peserta->disabilitas;?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo $peserta->email;?></td>
        </tr>
        <tr>
          <th>No HP</th>
          <td><?php echo $peserta->no_hp;?></td>
        </tr>
        <tr>
          <th>Agama</th>
          <td><?php echo $peserta->agama;?></td>
        </tr>
        <?php if(substr($peserta->kode_formasi,0, 6) == 'JFGURU'){?>
        <tr>
          <th>Sertifikat Pendidik</th>
          <td><?php echo ($peserta->serdik == '')?'(Tidak mengunggah)':'<a href="https://casn.kemenag.go.id/peserta/uploads/serdik/'.$peserta->serdik.'" target="_blank">Lihat</a>';?></td>
        </tr>
        <tr>
          <th>Linier</th>
          <td><?php echo ($peserta->serdik_linier == 1)?'Ya':'Tidak';?></td>
        </tr>
        <?php }?>
        <tr>
          <th>Facebook</th>
          <td><a href="https://www.facebook.com/search/top?q=<?php echo urlencode($peserta->facebook);?>" target="_blank"><?php echo $peserta->facebook;?></td>
        </tr>
        <tr>
          <th>Instagram</th>
          <td><a href="https://www.instagram.com/<?php echo $peserta->instagram;?>" target="_blank"><?php echo $peserta->instagram;?></a></td>
        </tr>
        <tr>
          <th>Twitter</th>
          <td><a href="https://www.twitter.com/<?php echo $peserta->twitter;?>" target="_blank"><?php echo $peserta->twitter;?></a></td>
        </tr>
      </tbody>
    </table>

    <h4>Riwayat Pendidikan</h4>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Jenjang</th>
          <th>Nama Sekolah/PT</th>
          <th>Jurusan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pendidikan as $row) {?>
          <tr>
            <td><?php echo $row->tahun;?></td>
            <td><?php echo $row->jenjang;?></td>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->jurusan;?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <h4>Riwayat Pekerjaan</h4>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Perusahaan/Instansi</th>
          <th>Jabatan</th>
          <th>Lampiran</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pekerjaan as $row) {?>
          <tr>
            <td><?php echo $row->mulai_tahun.' - '.$row->sampai_tahun;?></td>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->jabatan;?></td>
            <td><?php echo ($row->lampiran == '')?'(Tidak mengunggah)':'<a href="https://casn.kemenag.go.id/peserta/uploads/pekerjaan/'.$row->lampiran.'" target="_blank">Lampiran</a>';?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <h4>Riwayat Organisasi</h4>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Organisasi</th>
          <th>Jabatan</th>
          <th>Lokasi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($organisasi as $row) {?>
          <tr>
            <td><?php echo $row->mulai_tahun.' - '.$row->sampai_tahun;?></td>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->jabatan;?></td>
            <td><?php echo $row->lokasi;?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
	<h4>Riwayat Dokumen</h4>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Dokumen</th>
          <th>Keterangan</th>
          <th>Tahun</th>
          <th>Lampiran</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dokumen as $row) {?>
          <tr>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->keterangan;?></td>
            <td><?php echo $row->tahun;?></td>
            <td><a href="<?php echo 'https://casn.kemenag.go.id/peserta/uploads/pekerjaan/'.$row->lampiran;?>" target="_blank">Lampiran</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php
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

  public function printit($id)
  {
	$satker = $this->session->userdata('kode_satker');
    $data['peserta'] = $this->crud->get_row('peserta',array('nik'=>$id,'kode_satker'=>$satker));

    if(!$data['peserta']){
      echo 'Data peserta tidak ditemukan!';
      exit;
    }
    $data['pendidikan'] = $this->crud->get_array('pendidikan',array('nik'=>$id),array('field'=>'tahun','by'=>'ASC'));
    $data['pekerjaan'] = $this->crud->get_array('pekerjaan',array('nik'=>$id),array('field'=>'mulai_tahun','by'=>'ASC'));
    $data['organisasi'] = $this->crud->get_array('organisasi',array('nik'=>$id),array('field'=>'mulai_tahun','by'=>'ASC'));
    $data['dokumen'] = $this->crud->get_array('dokumen_peserta',array('nik'=>$id));

	$this->load->view('embed_peserta',$data);
  }

}

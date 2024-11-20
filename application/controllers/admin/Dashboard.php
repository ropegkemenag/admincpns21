<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Ilovepdf\Ilovepdf;

class Dashboard extends CI_Controller{

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
    $userpppk = $this->session->userdata('userpppk');
    $data['jfcpns'] = $this->crud->get_sum('jumlah','formasi_cpns',array('kode_satker'=>$kodesatker));
    // $data['jfpppk'] = $this->crud->get_count('formasi_pppk',array('kode_satker'=>$userpppk));

    $data['satker'] = $this->crud->get_row('satker', array('kode_satker_bkn' => $kodesatker));
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

}

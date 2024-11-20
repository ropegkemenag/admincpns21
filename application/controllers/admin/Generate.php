<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $satker = $this->db->query("SELECT * FROM satker WHERE kode_satker IS NOT NULL")->result();
    ?>
    <table>
      <tr>
        <td>SATKER</td>
        <td>GENERATE</td>
      </tr>
      <?php
      foreach ($satker as $row) {
        ?>
        <tr>
          <td><?= $row->satker.' - '.$row->kode_satker;?></td>
          <td><a href="<?= site_url('admin/generate/run/'.$row->kode_satker);?>" target="_blank">Generate</a></td>
        </tr>
      <?php
    }
    ?>
    </table>
    <?php
  }

  public function run($kodesatker)
  {
    // $satker = $this->db->query("SELECT * FROM satker WHERE kode_satker IS NOT NULL")->result();
    //
    // foreach ($satker as $sat) {
      $this->session->set_userdata('urut',0);
      $urut=0;

      // for ($j=0; $j < 4 ; $j++) {
      // $jenis = $this->jenis($j);
      // if($j>1){
      //   $this->session->set_userdata('urut',10);
      // }
      // echo 'jenis:'.$j.'<br>';
      // $formasi = $this->crud->get_array('formasi', array('lokasi_formasi_kode'=>$kodesatker,'jenis_formasi_id'=>$j));
      $formasi = $this->db->query("SELECT kelompok, jenis_formasi FROM formasi WHERE lokasi_formasi_kode='$kodesatker' GROUP BY kelompok, jenis_formasi")->result();
      foreach ($formasi as $for) {
        echo 'jabatan:'.$for->kelompok.'<br>';
        $peserta = $this->db->query("SELECT * FROM peserta WHERE kelompok='$for->kelompok' AND kode_satker='$kodesatker' AND jenis='$for->jenis_formasi' AND jadwal_praktik IS NULL ORDER BY formasi ASC")->result();
        // print_r($peserta);
        foreach ($peserta as $row) {
          echo 'peserta:'.$row->nama.'<br>';
          // $cekjadwal = $this->crud->get_row('peserta', array('lokasi_kode'=>$row->lokasi_kode,'jadwal_praktik'=>$waktu[$urut]));
          // $ceklokasi = $this->crud->get_row('lokasi', array('kode_tilok'=>$row->lokasi_kode));
          $ruang = $this->cekruang($row->lokasi_kode,$urut,10);

          if($ruang){
            echo 'waktu:'.$this->waktu($urut).'<br>';
            echo 'ruang:'.$ruang.'<br>';
            $param = array(
              'ruangan_praktik'=>$ruang,
              'jadwal_praktik'=>$this->waktu($urut)
            );
            $update = $this->crud->update('peserta', $param, array('nik'=>$row->nik));
            echo 'update:'.print_r($param).'<br>';
            $urut = $this->session->userdata('urut');
            $urut++;
            echo 'urut:'.$urut.'<br>';
          }
        }
        // $urut = 0;
      }
      // }
      echo 'Done';
      // code...
    // }
    // $this->output->enable_profiler(TRUE);
  }

  public function cekruang($lokasi,$urut,$jruang)
  {
    if($urut >= 24 ){
      return false;
    }

    $jadwal = $this->waktu($urut);

    for ($i=1; $i <= $jruang ; $i++) {
      $lok = $this->crud->get_count('peserta', array('lokasi_kode'=>$lokasi,'jadwal_praktik'=>$jadwal,'ruangan_praktik'=>$i));
      echo 'Cek Lokasi: '.$lokasi.' - '.$lok.'<br>';
      echo 'Ruang: '.$i.'<br>';
      echo 'Jam: '.$urut.'<br>';
      if($lok == 0){
        $this->session->set_userdata('urut',$urut);
        return $i;
        break;
      }
    }

    return false;
  }

  public function jenis($urut)
  {
    $jenis = array('UMUM','PENYANDANG DISABILITAS','PUTRA/PUTRI PAPUA DAN PAPUA BARAT','LULUSAN TERBAIK');
    return $jenis[$urut];
  }

  function waktu($urut)
  {
    $waktu = array(
                  '2021-12-06 07:30:00','2021-12-06 08:15:00','2021-12-06 09:00:00','2021-12-06 09:45:00','2021-12-06 10:30:00','2021-12-06 11:15:00',
                  '2021-12-06 13:00:00','2021-12-06 13:45:00','2021-12-06 14:30:00','2021-12-06 15:45:00','2021-12-06 16:30:00','2021-12-06 17:15:00');
    // $waktu = array('2021-12-05 18:00:00','2021-12-05 19:15:00',
    //                 '2021-12-06 18:00:00');
    return $waktu[$urut];
  }

}

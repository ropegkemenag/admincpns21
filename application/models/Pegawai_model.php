<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model{

  var $simpeg_db;
  var $idsatker;

  public function __construct()
  {
    parent::__construct();
    $this->simpeg_db = $this->load->database('simpeg', true);
  }

  public function get_array($table,$param=null,$order=null,$limit=null)
  {
    $this->simpeg_db->select('*');

    if($param!=null)
    {
      $this->simpeg_db->where($param);
    }

    if(isset($order)){
      $this->simpeg_db->order_by($order['field'], $order['by']);
    }

    if(isset($limit)){
      $this->simpeg_db->limit($limit['limit'], $limit['from']);
    }

    $query  = $this->simpeg_db->get($table);

    return $query->result();
  }

  public function get_row($table,$param)
  {
    $this->simpeg_db->select('*');
    $this->simpeg_db->where($param);
    $query  = $this->simpeg_db->get($table);

    return $query->row();
  }

  public function get_count($table,$param=null)
  {
    if($param){
      $this->simpeg_db->where($param);
    }
    $query  = $this->simpeg_db->from($table);

    return $query->count_all_results();
  }

  public function get_sum($field,$table,$param)
  {
    $this->simpeg_db->select_sum($field);
    $this->simpeg_db->where($param);
    $query = $this->simpeg_db->get($table);

    return $query->row()->$field;
  }

  public function insert($table,$param)
  {
    $this->simpeg_db->insert($table, $param);
    return $this->simpeg_db->insert_id();
  }

  public function update($table,$data,$param)
  {
    $this->simpeg_db->where($param);
    $this->simpeg_db->update($table, $data);
  }

  public function delete($table,$param)
  {
    $this->simpeg_db->where($param);
    $this->simpeg_db->delete($table);
  }

  public function get_cpns($idsatker,$tahun)
  {
    $query = $this->simpeg_db->query("SELECT * FROM V_PEGAWAI_API WHERE KODE_SATKER_4='$idsatker' AND NIP_BARU LIKE '%$tahun%'");
    return $query->result();
  }

  public function get_pegawais_satker($idsatker,$start=0,$limit=50)
  {
    $eselon = $this->get_satker($idsatker)->ESELON;
    $where = false;
    if($eselon == 1){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_4 = '$idsatker'";
    }else if($eselon == 2){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_3 = '$idsatker'";
    }else if($eselon == 3){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_2 = '$idsatker'";
    }else if($eselon == 4){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_1 = '$idsatker'";
    }

    if($where){
      $query = $this->simpeg_db->query("SELECT
                                    dbo.V_PEGAWAI_API.*
                                    FROM
                                    dbo.V_PEGAWAI_API
                                    WHERE
                                    $where
                                    ORDER BY
                                    dbo.V_PEGAWAI_API.NIP_BARU ASC
                                    OFFSET $start ROWS FETCH NEXT $limit ROWS ONLY
                                    ");
      return $query->result();
    }else{
      return false;
    }
  }

  public function get_count_pegawais_satker($idsatker)
  {
    $eselon = $this->get_satker($idsatker)->ESELON;
    if($eselon == 1){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_4 = '$idsatker'";
    }else if($eselon == 2){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_3 = '$idsatker'";
    }else if($eselon == 3){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_2 = '$idsatker'";
    }else if($eselon == 4){
      $where = "dbo.V_PEGAWAI_API.KODE_SATKER_1 = '$idsatker'";
    }

    $query = $this->simpeg_db->query("SELECT COUNT(NIP) AS jumlah
                                  FROM
                                  dbo.V_PEGAWAI_API
                                  WHERE
                                  $where
                                  ");
    return $query->row()->jumlah;
  }

  public function get_satker($id)
  {
    $query = $this->simpeg_db->query("SELECT * FROM TM_SATUAN_KERJA WHERE KODE_SATUAN_KERJA='$id'");
    return $query->row();
  }

  public function get_all_pegawai_satker($page)
  {

	$limit = 100;
	$a = ($page>1) ? ($page * $limit) - $limit : 0;
    $query = $this->simpeg_db->query("SELECT
                                  dbo.V_PEGAWAI_API.*
                                  FROM
                                  dbo.V_PEGAWAI_API
								  LIMIT $a,$limit
                                  ");
    return $query->result();
  }

  public function get_gaji($pangkat,$mk)
  {
    $query = $this->simpeg_db->query("SELECT
                                  dbo.TM_GAJI_POKOK.*
                                  FROM
                                  dbo.TM_GAJI_POKOK
                                  WHERE
                                  dbo.TM_GAJI_POKOK.KODE_PANGKAT = '$pangkat' AND dbo.TM_GAJI_POKOK.MASA_KERJA = '$mk'
                                  AND dbo.TM_GAJI_POKOK.TAHUN='2019'
                                  ");
    return $query->row();
  }

  public function get_pegawaiby_nip($nip)
  {
    $query = $this->simpeg_db->query("SELECT
                                  dbo.V_PEGAWAI_API.*
                                  FROM
                                  dbo.V_PEGAWAI_API
                                  WHERE
                                  dbo.V_PEGAWAI_API.NIP_BARU = '$nip'
                                  ");
    return $query->row();
  }

  public function get_pendidikanby_nip($nip)
  {
    $niplama = $this->getniplama($nip)->NIP;
    $query = $this->simpeg_db->query("SELECT *
                                      FROM vwRIWAYAT_PENDIDIKAN
                                      WHERE NIP='$niplama'
                                      ORDER BY NO_URUT ASC
                                  ");
    return $query->result();
  }

  public function get_pangkatby_nip($nip)
  {
    $niplama = $this->getniplama($nip)->NIP;
    $query = $this->simpeg_db->query("SELECT *
                                      FROM vwRIWAYAT_PANGKAT
                                      WHERE NIP='$niplama'
                                      ORDER BY NO_URUT ASC
                                  ");
    return $query->result();
  }

  public function get_jabatanby_nip($nip)
  {
    $niplama = $this->getniplama($nip)->NIP;
    $query = $this->simpeg_db->query("SELECT *
                                      FROM vwRIWAYAT_JABATAN
                                      WHERE NIP='$niplama'
                                      ORDER BY NO_URUT ASC
                                  ");
    return $query->result();
  }


  public function getniplama($nip)
  {
    $query = $this->simpeg_db->query("SELECT
                                    dbo.V_PEGAWAI_API.NIP
                                    FROM
                                    dbo.V_PEGAWAI_API
                                    WHERE
                                    dbo.V_PEGAWAI_API.NIP_BARU = '$nip'
                                    ");
    return $query->row();
  }

  public function login($identity,$password)
  {
    $query = $this->simpeg_db->query("SELECT
                                      *
                                      FROM
                                      dbo.TS_USER
                                      WHERE
                                      dbo.TS_USER.NIP = '$identity' AND
                                      dbo.TS_USER.PWD = '$password'");
    return $query->row();
  }

  public function sp($stored_pocedure)
  {

	   $result = $this->simpeg_db->query($stored_pocedure);
    return $result;
  }

  public function query($query)
  {
    $result = $this->simpeg_db->query($query);
    return $result;
  }

}

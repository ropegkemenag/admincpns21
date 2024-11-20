<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_array($table,$param=null,$order=null,$limit=null)
  {
    $this->db->select('*');

    if($param!=null)
    {
      $this->db->where($param);
    }

    if(isset($order)){
      $this->db->order_by($order['field'], $order['by']);
    }

    if(isset($limit)){
      $this->db->limit($limit['limit'], $limit['from']);
    }

    $query  = $this->db->get($table);

    return $query->result();
  }

  public function preport_jabatan($kodesatker)
  {
    $query = $this->db->query("SELECT jabatan_nama, COUNT(nik) as jumlah,
                              (SELECT COUNT(nik) FROM peserta_cpns a WHERE a.status_verifikasi='1' AND a.lokasi_kode=peserta_cpns.lokasi_kode AND a.jabatan_nama=peserta_cpns.jabatan_nama) ms
                              FROM peserta_cpns
                              WHERE lokasi_kode='$kodesatker'
                              GROUP BY jabatan_nama");
    return $query->result();
  }

  public function preport_verifikasi($kodesatker)
  {
    $query = $this->db->query("SELECT status_verifikasi, COUNT(nik) as jumlah FROM peserta_cpns
                              WHERE lokasi_kode='$kodesatker'
                              GROUP BY status_verifikasi");
    return $query->result();
  }

  public function get_kabupaten($id)
  {
    $query = $this->db->query("SELECT
                      wilayah.*,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idkabupaten=wilayah.id) AS jumlah,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idkabupaten=wilayah.id AND viewpemilih.status='1') AS memilih
                      FROM
                      wilayah
                      WHERE
                      wilayah.type = 'kabupaten' AND wilayah.parent = '$id'
                      ");
    return $query->result();
  }

  public function get_kecamatan($id)
  {
    $query = $this->db->query("SELECT
                      wilayah.*,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idkecamatan=wilayah.id) AS jumlah,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idkecamatan=wilayah.id AND viewpemilih.status='1') AS memilih
                      FROM
                      wilayah
                      WHERE
                      wilayah.type = 'kecamatan'  AND wilayah.parent = '$id'
                      ");
    return $query->result();
  }

  public function get_kelurahan($id)
  {
    $query = $this->db->query("SELECT
                      wilayah.*,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idkelurahan=wilayah.id) AS jumlah,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idkelurahan=wilayah.id AND viewpemilih.status='1') AS memilih
                      FROM
                      wilayah
                      WHERE
                      wilayah.type = 'kelurahan' AND
                      wilayah.parent = '$id'
                      ");
    return $query->result();
  }

  public function get_tps($id)
  {
    $query = $this->db->query("SELECT
                      wilayah.*,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idtps=wilayah.id) AS jumlah,
                      (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idtps=wilayah.id AND viewpemilih.status='1') AS memilih
                      FROM
                      wilayah
                      WHERE
                      wilayah.type = 'tps' AND
                      wilayah.parent = '$id'
                      ");
    return $query->result();
  }

  public function get_rw()
  {
    $query = $this->db->query("SELECT
                      wilayah.*,
                      (SELECT IFNULL(SUM(jumlah), 0) FROM viewpemilih WHERE viewpemilih.parent=wilayah.id) AS jumlah,
                      (SELECT IFNULL(SUM(jumlah), 0) FROM viewstatus WHERE viewstatus.parent=wilayah.id) AS memilih
                      FROM
                      wilayah
                      WHERE
                      wilayah.type = 'rw'
                      ");
    return $query->result();
  }

  public function get_swipper($id)
  {
    $query = $this->db->query("SELECT
                              wilayah.*,
                              (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idtps=wilayah.id) AS jumlah,
                              (SELECT IFNULL(COUNT(id), 0) FROM viewpemilih WHERE viewpemilih.idtps=wilayah.id AND viewpemilih.status='1') AS memilih
                              FROM
                              wilayah
                              WHERE
                              wilayah.type = 'tps' AND
                              wilayah.parent = '$id'
                              ");
    return $query->result();
  }

  public function get_row($table,$param)
  {
    $this->db->select('*');
    $this->db->where($param);
    $query  = $this->db->get($table);

    return $query->row();
  }

  public function get_count($table,$param=null)
  {
    if($param){
      $this->db->where($param);
    }
    $query  = $this->db->from($table);

    return $query->count_all_results();
  }

  public function get_sum($field,$table,$param)
  {
    $this->db->select_sum($field);
    $this->db->where($param);
    $query = $this->db->get($table);

    return $query->row()->$field;
  }

  public function insert($table,$param)
  {
    $this->db->insert($table, $param);
    return $this->db->insert_id();
  }

  public function update($table,$data,$param)
  {
    $this->db->where($param);
    $this->db->update($table, $data);
  }

  public function delete($table,$param)
  {
    $this->db->where($param);
    $this->db->delete($table);
  }

  function data_satker()
  {
	$periode = get_option('periode');

    $query = $this->db->query("SELECT
              Count(pegawai.id) AS jumlah,
              pegawai.idsatker,
              satker.satker
              FROM
              pegawai
              INNER JOIN satker ON pegawai.idsatker = satker.id
		WHERE pegawai.periode='$periode'
              GROUP BY idsatker
              ORDER BY jumlah DESC
              ");

    return $query->result();
  }

  function get_last($table, $where, $field)
  {
    $query = $this->db->query("SELECT * FROM $table WHERE $where ORDER BY $field DESC LIMIT 0, 1");

    return $query->row();
  }

  public function get_pegawaix($param=null)
  {
    $this->db->select('pegawai.*,pangkat.pangkat');

    if($param!=null)
    {
      $this->db->where($param);
    }

    $this->db->join('pangkat', 'pangkat.id = pegawai.pangkat');

    $this->db->order_by('tingkat', 'DESC');
    $this->db->order_by('idsatker', 'ASC');
    $this->db->order_by('pegawai.pangkat', 'ASC');
    $this->db->order_by('masa_tahun', 'DESC');

    $query  = $this->db->get('pegawai');

    return $query->result();
  }

  public function get_pegawai($param=null)
  {
    $this->db->select('pegawai.*,pangkat.pangkat');

    if($param!=null)
    {
      $this->db->where($param);
    }

    $this->db->join('pangkat', 'pangkat.id = pegawai.pangkat');

    $this->db->order_by('kode', 'ASC');

    $query  = $this->db->get('pegawai');

    return $query->result();
  }

  public function get_periode()
  {
    $query = $this->db->query("SELECT periode.*,
                    (SELECT COUNT(*) FROM pegawai WHERE pegawai.periode=periode.id) AS jumlah,
                    (SELECT COUNT(*) FROM pegawai WHERE pegawai.periode=periode.id AND pegawai.`status`='2') AS tms
                    FROM periode
                    ");
    return $query->result();
  }

  public function get_satker()
  {
    $query = $this->db->query("SELECT
                              satker.id,
                              satker.kode,
                              satker.satker,
                              Count(pegawai.id) AS jumlah,
                              (SELECT COUNT(p3.id) FROM pegawai p3 WHERE p3.idsatker=satker.id AND p3.tingkat='3' AND p3.status='1') AS j3,
                              (SELECT COUNT(p2.id) FROM pegawai p2 WHERE p2.idsatker=satker.id AND p2.tingkat='2' AND p2.status='1') AS j2,
                              (SELECT COUNT(p1.id) FROM pegawai p1 WHERE p1.idsatker=satker.id AND p1.tingkat='1' AND p1.status='1') AS j1
                              FROM
                              satker
                              LEFT JOIN pegawai ON satker.id = pegawai.idsatker
                              GROUP BY
                              satker.id,
                              satker.kode,
                              satker.satker
                    ");
    return $query->result();
  }
}

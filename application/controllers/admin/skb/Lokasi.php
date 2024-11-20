<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller{

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
    $data['jumlah'] = $this->db->query("SELECT sum(lok.jumlah) AS jumlah FROM (SELECT
                                        	lokasi.lokasi_ujian,
                                        	lokasi.kode_tilok,
                                        	COUNT(peserta.nik) AS jumlah
                                        FROM
                                        	lokasi
                                        RIGHT JOIN
                                        	peserta
                                        ON
                                        	lokasi.kode_tilok = peserta.lokasi_kode
                                        WHERE
                                        	lokasi.kode_satker = '$kodesatker') lok")->row();

    if($lokasi){
      $data['peserta'] = $this->crud->get_array('peserta', array('lokasi_kode'=>$lokasi));
      $data['lok'] = $this->crud->get_row('lokasi',array('kode_tilok'=>$lokasi));
    }

    $this->load->tpl('skb/lokasi', $data);
  }

  function panitia()
  {
    $kodesatker = $this->session->userdata('kode_satker');
    $data['lokasi'] = $this->crud->get_array('lokasi', array('kode_satker'=>$kodesatker));

    $this->load->tpl('skb/panitia', $data);
  }

  public function get_detail($kode)
  {
    $satker = $this->session->userdata('kode_satker');
    $lokasis = $this->crud->get_array('lokasi',array('kode_satker'=>$satker));
    $lokasi = $this->crud->get_row('lokasi_titik',array('lokasi_kode'=>$kode));
    ?>
    <form class="" action="<?php echo site_url('admin/skb/lokasi/update');?>" method="post" id="edittilok">
      <div class="form-group">
        <label for="">Lokasi Ujian</label>
        <select class="form-control" name="lokasi_kode">
          <?php
          foreach ($lokasis as $row) {
            $select = ($row->kode_tilok == $kode)?'selected':'';
            ?>
          <option value="<?php echo $row->kode_tilok;?>" <?php echo $select;?>><?php echo $row->lokasi_ujian;?></option>
          <?php }?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Nama Titik Lokasi</label>
        <input type="text" class="form-control" name="tilok" value="<?php echo $lokasi->tilok;?>">
      </div>
      <div class="form-group">
        <label for="">Kontak Untuk Panitia</label>
        <input type="text" class="form-control" name="kontak_panitia" value="<?php echo $lokasi->kontak_panitia;?>">
      </div>
      <div class="form-group">
        <label for="">Kontak Untuk Peserta</label>
        <input type="text" class="form-control" name="kontak" value="<?php echo $lokasi->kontak;?>">
      </div>
      <div class="form-group">
        <label for="">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3"><?php echo $lokasi->alamat;?></textarea>
      </div>
      <div class="form-group">
        <label for="">Link Google Maps (Link Share dari Google Maps)</label>
        <input type="text" class="form-control" name="maps" value="<?php echo $lokasi->maps;?>">
        <input type="hidden" class="form-control" name="lokasi_kode" value="<?php echo $lokasi->lokasi_kode;?>">
      </div>
    </form>
    <?php
  }

  public function add()
  {
    $satker = $this->session->userdata('kode_satker');

    $this->form_validation->set_rules('tilok', 'Titik Lokasi', 'required');
    $this->form_validation->set_rules('lokasi_kode', 'Lokasi', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('maps', 'Share Maps', 'required');
    $this->form_validation->set_rules('kontak', 'Kontak Untuk Peserta', 'required');
    $this->form_validation->set_rules('kontak_panitia', 'Kontak Untuk Panitia', 'required');

    if($this->form_validation->run() === TRUE)
    {
      $param = array(
        'tilok' => $this->input->post('tilok'),
        'lokasi_kode' => $this->input->post('lokasi_kode'),
        'alamat' => $this->input->post('alamat'),
        'maps' => $this->input->post('maps'),
        'kontak' => $this->input->post('kontak'),
        'kontak_panitia' => $this->input->post('kontak_panitia'),
        'kode_satker' => $satker,
      );
      $insert = $this->crud->insert('lokasi_titik',$param);

      $this->session->set_flashdata('message','Titik Lokasi telah ditambahkan');
    }else{
      $this->session->set_flashdata('message',validation_errors());
    }
    redirect('admin/skb/lokasi');
  }

  public function update()
  {
    $satker = $this->session->userdata('kode_satker');

    $this->form_validation->set_rules('tilok', 'Titik Lokasi', 'required');
    $this->form_validation->set_rules('lokasi_kode', 'Lokasi', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('maps', 'Share Maps', 'required');
    $this->form_validation->set_rules('kontak', 'Kontak Untuk Peserta', 'required');
    $this->form_validation->set_rules('kontak_panitia', 'Kontak Untuk Panitia', 'required');

    if($this->form_validation->run() === TRUE)
    {
      $param = array(
        'tilok' => $this->input->post('tilok'),
        'lokasi_kode' => $this->input->post('lokasi_kode'),
        'alamat' => $this->input->post('alamat'),
        'maps' => $this->input->post('maps'),
        'kontak' => $this->input->post('kontak'),
        'kontak_panitia' => $this->input->post('kontak_panitia'),
        'kode_satker' => $satker,
      );
      $update = $this->crud->update('lokasi_titik',$param,array('lokasi_kode'=>$this->input->post('lokasi_kode'),'kode_satker'=>$satker));

      $this->session->set_flashdata('message','Titik Lokasi telah diubah');
    }else{
      $this->session->set_flashdata('message',validation_errors());
    }
    redirect('admin/skb/lokasi');
  }

  public function delete($id)
  {
    $satker = $this->session->userdata('kode_satker');

    $delete = $this->crud->delete('lokasi_titik',array('lokasi_kode'=>$id,'kode_satker'=>$satker));
    $this->session->set_flashdata('message','Titik Lokasi telah dihapus');
    redirect('admin/skb/lokasi');

  }

}

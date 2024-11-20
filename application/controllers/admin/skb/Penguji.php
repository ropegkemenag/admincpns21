<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penguji extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('nip'))
		{
			redirect('admin/auth');
		}
    $this->load->model(array('Pegawai_model'=>'simpeg'));
  }

  public function index($value='')
  {
    $satker = $this->session->userdata('kode_satker');
    $data['penguji'] = $this->crud->get_array('penguji', array('kode_satker'=>$satker));
    $this->load->tpl('skb/penguji',$data);
  }

  public function simpan()
  {
    $satker = $this->session->userdata('kode_satker');
    $this->form_validation->set_rules('nip','NIP','required');
    $this->form_validation->set_rules('nama','Nama','required');
    $this->form_validation->set_rules('jabatan','Jabatan','required');
    $this->form_validation->set_rules('type','Jenis Ujian','required');

    if($this->form_validation->run() === TRUE)
    {

      $config['upload_path']    = './downloads/';
      $config['allowed_types']  = 'pdf';
      $config['file_name']      = $satker.'-'.$this->input->post('nip');
      $config['overwrite']      = TRUE;
      $config['remove_spaces']  = FALSE;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('lampiran')) {
        $this->session->set_flashdata('message',$this->upload->display_errors());
      }
      $param = array(
        'nip'=>$this->input->post('nip'),
        'nip_lama'=>$this->input->post('nip_lama'),
        'nama'=>$this->input->post('nama'),
        'agama'=>$this->input->post('agama'),
        'tpt_lahir'=>$this->input->post('tpt_lahir'),
        'tgl_lahir'=>$this->input->post('tgl_lahir'),
        'satker'=>$this->input->post('satker'),
        'jk'=>$this->input->post('jk'),
        'jabatan'=>$this->input->post('jabatan'),
        'pendidikan'=>$this->input->post('pendidikan'),
        'type'=>$this->input->post('type'),
        'kode_satker'=>$satker,
      );
      $this->crud->insert('penguji', $param);
      $this->session->set_flashdata('message','Data telah disimpan');
    }else{
      $this->session->set_flashdata('message',validation_errors());
    }

    redirect('admin/skb/penguji');
  }

  public function addfile()
  {
    $satker = $this->session->userdata('kode_satker');
    $config['upload_path']    = './downloads/';
    $config['allowed_types']  = 'pdf';
    $config['file_name']      = $satker.'-'.$this->input->post('nip');
    $config['overwrite']      = TRUE;
    $config['remove_spaces']  = FALSE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('lampiran')) {
      $this->session->set_flashdata('message','Dokumen telah diupload');
    }else{
      $this->session->set_flashdata('message',$this->upload->display_errors());
    }

    redirect('admin/skb/penguji');
  }

  public function edit()
  {
	$satker = $this->session->userdata('kode_satker');
    $this->form_validation->set_rules('nip','NIP','required');
    $this->form_validation->set_rules('nama','Nama','required');
    $this->form_validation->set_rules('jabatan','Jabatan','required');
    $this->form_validation->set_rules('type','Jenis Ujian','required');

    if($this->form_validation->run() === TRUE)
    {

      $param = array(
        'nip'=>$this->input->post('nip'),
        'nip_lama'=>$this->input->post('nip_lama'),
        'nama'=>$this->input->post('nama'),
        'agama'=>$this->input->post('agama'),
        'tpt_lahir'=>$this->input->post('tpt_lahir'),
        'tgl_lahir'=>$this->input->post('tgl_lahir'),
        'satker'=>$this->input->post('satker'),
        'jk'=>$this->input->post('jk'),
        'pendidikan'=>$this->input->post('pendidikan'),
        'jabatan'=>$this->input->post('jabatan'),
        'type'=>$this->input->post('type'),
        'kode_satker'=>$satker,
      );
      $this->crud->update('penguji', $param, array('id'=>$this->input->post('id'),'kode_satker'=>$satker));
      $this->session->set_flashdata('message','Data telah disimpan');

    }else{
      $this->session->set_flashdata('message',validation_errors());
    }
	  redirect('admin/skb/penguji');
  }

  public function get_detail($id)
  {
	  $satker = $this->session->userdata('kode_satker');
	  $row = $this->crud->get_row('penguji', array('id'=>$id,'kode_satker'=>$satker));
	  ?>
	  <form class="" action="<?php echo site_url('admin/skb/penguji/edit');?>" method="post" id="updatepenguji" enctype="multipart/form-data">
            <label for="">NIP</label>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" name="nip" id="nipx" value="<?php echo $row->nip;?>">
			  <input type="hidden" name="id" id="idx" value="<?php echo $row->id;?>">
			  <input type="hidden" name="nip_lama" id="nip_lamax" value="<?php echo $row->id;?>">
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" onclick="getpegawaix();">Ambil Ulang Data</button>
              </span>
            </div>
            <div class="form-group">
			  <img src="https://ropeg.kemenag.go.id/webview/avatar/image/<?php echo $row->nip_lama;?>" id="fotox">
			  Jika tidak ada foto, harap update di simpeg
            </div>
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="nama" id="namax" value="<?php echo $row->nama;?>">
            </div>
			<div class="form-group">
              <label for="">Tempat Lahir</label>
              <input type="text" class="form-control" name="tpt_lahir" id="tpt_lahirx" value="<?php echo $row->tpt_lahir;?>">
            </div>
			<div class="form-group">
              <label for="">Tanggal Lahir</label>
              <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahirx" value="<?php echo $row->tgl_lahir;?>">
            </div>
            <div class="form-group">
              <label for="">Jenis Kelamin</label>
              <input type="text" class="form-control" name="jk" id="jkx" value="<?php echo $row->jk;?>">
            </div>
            <div class="form-group">
              <label for="">Agama</label>
              <input type="text" class="form-control" name="agama" id="agamax" value="<?php echo $row->agama;?>">
            </div>
            <div class="form-group">
              <label for="">Satuan Kerja</label>
              <input type="text" class="form-control" name="satker" id="satkerx" value="<?php echo $row->satker;?>">
            </div>
            <div class="form-group">
              <label for="">Pendidikan</label>
              <input type="text" class="form-control" name="pendidikan" id="pendidikanx" value="<?php echo $row->pendidikan;?>">
            </div>
            <div class="form-group">
              <label for="">Jabatan</label>
              <input type="text" class="form-control" name="jabatan" id="jabatanx" value="<?php echo $row->jabatan;?>">
            </div>
            <div class="form-group">
              <label for="">Jenis Ujian</label>
              <select class="form-control" name="type" id="typex">
                <option value="Praktik Kerja" <?php echo ($row->type == 'Praktik Kerja')?'selected':'';?>>Praktik Kerja</option>
                <option value="Wawancara" <?php echo ($row->type == 'Wawancara')?'selected':'';?>>Wawancara</option>
              </select>
            </div>
          </form>

		<script>
		function getpegawaix()
  {
  	$('#infoget').html('Loading...');
  	var nip = $('#nipx').val();
  	$.get('<?php echo site_url('penguji/getpegawai');?>/'+nip, function(result) {

      if(!result.NAMA_LENGKAP){
        $('#infoget').html('Data tidak ditemukan...');
        return false;
      }
      $('#infoget').html('');
      // var obj = jQuery.parseJSON( result );

      $('#namax').val(result.NAMA_LENGKAP);
      $('#nipx').val(result.NIP_BARU);
      $('#nip_lamax').val(result.NIP);
      $('#pendidikanx').val(result.PENDIDIKAN);
      $('#jabatanx').val(result.KETERANGAN);
      $('#agamax').val(result.AGAMA);
      $('#alamatx').val(result.ALAMAT_1+' '+result.ALAMAT_2);
      $('#satkerx').val(result.SATKER_1+' '+result.SATKER_2+' '+result.SATKER_3+' '+result.SATKER_4);
      $('#jkx').val(setjk(result.JENIS_KELAMIN));
      $('#tgl_lahirx').val(result.TANGGAL_LAHIR);
      $('#tpt_lahirx').val(result.TEMPAT_LAHIR);
      $('#fotox').attr('src','https://ropeg.kemenag.go.id/webview/avatar/image/'+result.NIP);

    });
  }
		</script>
	  <?php
  }


  public function getpegawai($nip)
  {
    $pegawai = $this->simpeg->get_pegawaiby_nip($nip);

    $pegawai = (array)$pegawai;
    unset($pegawai['1']);
    $pegawai = (object)$pegawai;

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($pegawai));
  }

  public function delete($id)
  {
    $satker = $this->session->userdata('kode_satker');
    $delete = $this->crud->delete('penguji', array('id'=>$id,'kode_satker'=>$satker));

    redirect('admin/skb/penguji');
  }

}

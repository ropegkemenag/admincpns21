<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Laporan Dokumen </h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
            <form class="" action="" method="post">

            </form>
          <?php } ?>
          <a href="<?= site_url('admin/dokumen/add');?>" class="btn btn-info"><i class="icon-plus"></i> Tambah Dokumen</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped" id="datatable">
        <thead>
          <tr>
            <th>JENIS</th>
            <th>KETERANGAN</th>
            <th>LAMPIRAN</th>
            <th>STATUS</th>
            <th>TANGGAL</th>
            <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
            <th>OPSI</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dokumen as $row) {?>
            <tr>
              <td><?= $row->kategori?></td>
              <td>
                <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
                  <b><?= $row->satker?></b><br>
                <?php } ?>
                <i><?= $row->keterangan?></i>
              </td>
              <td><a href="<?= base_url('uploads/dokumen/'.$row->dokumen)?>" class="btn btn-sm btn-light" target="_blank">Lihat</a></td>
              <td>
                <?php
                if($row->status == 0){
                  echo '<span class="badge badge-secondary">Dikirim</span>';
                }else if($row->status == 1){
                  echo '<span class="badge badge-info">Diterima</span>';
                }else if($row->status == 2){
                  echo '<span class="badge badge-warning">Dikembalikan</span><br>';
                  echo '<i>'.$row->alasan_tolak.'</i>';
                }
                ?>
              </td>
              <td><?= $row->created_date;?></td>
              <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
              <td>
                <a href="<?= site_url('admin/dokumen/setstatus/1/'.$row->id);?>" class="btn btn-sm btn-primary">Terima</a>
                <a href="javascript:;" class="btn btn-sm btn-danger" onclick="tolak(<?= $row->id;?>);">Tolak</a>
              </td>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable();
  });

  <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
  function tolak(iddokumen) {
    swal({
      title: "",
      text: "Alasan Penolakan:",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Info untuk user"
    }, function (inputValue) {
      if (inputValue === false) return false;
      if (inputValue === "") {
        swal.showInputError("You need to write something!");
        return false
      }

      $.post( "<?= site_url('admin/dokumen/tolak');?>", { id: iddokumen, alasan: inputValue })
      .done(function( data ) {
        swal("Nice!", "Data telah diinput", "success");
      });
    });
  }
  <?php } ?>

</script>

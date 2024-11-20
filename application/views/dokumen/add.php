<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Tambah Dokumen Laporan </h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <a href="<?= site_url('admin/dokumen');?>" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <div class="card card-body">
        <form class="" action="<?= site_url('admin/dokumen/save');?>" method="post" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Jenis Dokumen</label>
            <div class="col-sm-5">
              <select class="form-control" name="kategori">
                <option value="Laporan Persiapan SKD">Laporan Persiapan SKD</option>
                <option value="Jadwal Sesi Peserta">Jadwal Sesi Peserta (Excel)</option>
                <option value="Berita Acara Pelaksanaan SKD">Berita Acara Pelaksanaan SKD</option>
                <option value="Berita Acara Pelaksanaan SATKER">Berita Acara Pelaksanaan SKB SATKER</option>
                <option value="Berita Acara Pelaksanaan TILOK">Berita Acara Pelaksanaan SKB TILOK</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Dokumen</label>
            <div class="col-sm-5">
              <input type="file" class="form-control" id="dokumen" name="dokumen">
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-7">
              <textarea name="keterangan" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-7">
              <input type="submit" name="submit" value="Kirim" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable();
  });

</script>

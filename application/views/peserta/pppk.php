<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Peserta PPPK</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <a href="<?= site_url('admin/peserta/export/pppk');?>" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a>
          <a href="<?= site_url('admin/peserta/exporthasilpppk');?>" class="btn btn-danger"><i class="icon-arrow-left-circle"></i> Download Hasil</a>
          <div class="btn-group mb-3">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pencetakan SK</button>
              <div class="dropdown-menu p-0">
                  <a class="dropdown-item" href="<?= site_url('admin/peserta/exportcetakpppk');?>">Download Data</a>
                  <a class="dropdown-item" href="<?= base_url('uploads/templatespmtpppk.docx');?>" target="_blank">Template SPMT</a>
                  <a class="dropdown-item" href="<?= base_url('uploads/templatekontrakkerjapppk.docx');?>" target="_blank">Template Kontrak Kerja</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped" id="datatable">
        <thead>
          <tr>
            <th>NIK</th>
            <th>NAMA</th>
            <th>JABATAN</th>
            <th>LOKASI</th>
            <th>STATUS</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($peserta as $row) {?>
            <tr>
              <td><?= $row->nik;?></td>
              <td><?= $row->nama_ktp;?></td>
              <td><?= $row->jabatan_nama;?></td>
              <td><?= $row->lokasi_nama;?></td>
              <td><?= $row->keterangan;?></td>
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

</script>

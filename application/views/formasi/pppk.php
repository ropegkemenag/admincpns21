<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Formasi PPPK</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <a href="<?= site_url('admin/formasi/exportpppk');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-down-circle"></i> Download XLS</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped" id="datatable">
        <thead>
          <tr>
            <th>ID</th>
            <th>FORMASI</th>
            <th>UNIT PENEMPATAN</th>
            <th>KUALIFIKASI PENDIDIKAN</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pppk as $row) {?>
            <tr>
              <td><?= $row->kode;?></td>
              <td><?= $row->jabatan;?></td>
              <td><?= $row->unit_kerja;?></td>
              <td><?= $row->pendidikan;?></td>
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

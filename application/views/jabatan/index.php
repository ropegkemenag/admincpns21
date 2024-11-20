<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Data Master Satuan Kerja</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <a href="<?= site_url('jabatan/index/'.$parent->KODE_ATASAN)?>" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped" id="datatable">
        <thead>
          <tr>
            <th>KODE</th>
            <th>SATUAN KERJA</th>
            <th>JABATAN</th>
            <th>OPSI</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($satker as $row) {?>
            <tr>
              <td><?= $row->KODE_SATUAN_KERJA?></td>
              <td><?= $row->SATUAN_KERJA?></td>
              <td><?= $row->PIMPINAN?></td>
              <td>
                <a href="<?= site_url('jabatan/index/'.$row->KODE_SATUAN_KERJA)?>" class="btn btn-sm btn-info">SUB</a>
                <a href="<?= site_url('jabatan/detail/'.$row->KODE_SATUAN_KERJA)?>" class="btn btn-sm btn-warning">DETAIL</a>
              </td>
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

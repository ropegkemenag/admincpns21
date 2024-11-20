<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Peserta CPNS LULUS</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <a href="<?= site_url('admin/peserta/export/cpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped" id="datatable">
        <thead>
          <tr>
            <th>NOMOR PESERTA</th>
            <th>NAMA</th>
            <th>JABATAN</th>
            <th>NO PERTEK</th>
            <th>NIP</th>
            <th>PERTEK</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($peserta as $row) {?>
            <tr>
              <td><?= $row->nopeserta;?></td>
              <td><?= $row->nama;?></td>
              <td><?= $row->formasi;?></td>
              <td><?= $row->no_pertek;?></td>
              <td><?= $row->nip;?></td>
              <td><a href="<?= base_url('downloads/pertek/PENETAPAN_NIP_'.$row->nip.$row->nama.'.pdf')?>">Download</a></td>
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

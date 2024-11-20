<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Formasi CPNS</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
            <form class="" action="" method="post">
              <select class="form-control" name="" id="satker">
                <?php foreach ($satker as $row) {
                  $select = ($kodesatker == $row->kode_satker_bkn)?'selected':'';
                  echo '<option value="'.$row->kode_satker_bkn.'" '.$select.'>'.strtoupper($row->satker).'</option>';
                } ?>
              </select>
            </form>
          <?php } ?>
          <a href="<?= site_url('admin/formasi/exportcpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a>
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
            <th>JUMLAH</th>
            <th>PENEMPATAN</th>
            <!-- <th>UNIT PENEMPATAN</th> -->
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($cpns as $row) {?>
            <tr>
              <td><?= $row->id;?></td>
              <td><?= $row->jabatan;?></td>
              <td><?= $row->jumlah;?></td>
              <td><?= $row->penempatan;?></td>
              <!-- <td><?= $row->unit_kerja;?></td> -->
            </tr>
          <?php $no++;}?>
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

    <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
      $('#satker').on('change', function(event) {
        window.location.replace("<?= site_url('formasi/cpns');?>/"+$('#satker').val());
      });
    <?php }?>
  });

</script>

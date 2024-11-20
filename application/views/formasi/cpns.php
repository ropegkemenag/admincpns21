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
          <!-- <a href="<?= site_url('admin/formasi/exportcpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped datatable">
        <thead>
          <tr>
            <!-- <th>ID</th> -->
            <th>FORMASI</th>
            <th>UMUM</th>
            <th>CUMLAUDE</th>
            <th>PPB</th>
            <th>DISABILITAS</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $kodesatker = $this->session->userdata('kode_satker');
          $no=1; foreach ($cpns as $row) {?>
            <tr>
              <!-- <td><?= $row->id;?></td> -->
              <td>
                <b><?= $row->jabatan;?></b>
                <br><br>Penempatan:
                <?php
                $unit = $this->db->query("SELECT * FROM formasi_cpns WHERE kode_satker='$kodesatker' AND jabatan='$row->jabatan'")->result();
                foreach ($unit as $u) {
                  echo '<br>';
                  echo '- '.$u->unit_kerja.' ('.$u->jumlah.')';
                }
                ?>
              </td>
              <td><?= $row->umum;?></td>
              <td><?= $row->cumlaude;?></td>
              <td><?= $row->ppb;?></td>
              <td><?= $row->disabilitas;?></td>
            </tr>
          <?php $no++;}?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/jszip/jszip.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.print.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.datatable').DataTable({
    dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
     responsive: true
 });

    <?php if($this->session->userdata('kode_satker') == '30120001'){ ?>
      $('#satker').on('change', function(event) {
        window.location.replace("<?= site_url('admin/formasi/cpns');?>/"+$('#satker').val());
      });
    <?php }?>
  });

</script>

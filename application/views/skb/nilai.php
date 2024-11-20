<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Nilai Peserta CPNS</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <!-- <a href="<?= site_url('admin/peserta/export/cpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <div class="card">
        <div class="card-header  justify-content-between align-items-center">
          <h6 class="card-title">Nilai SKD + SKB</h6>
        </div>
        <div class="card-body table-responsive">
        <table class="table table-bordered table-striped datatable" id="datatable">
          <thead>
            <tr>
              <th rowspan="2">NO PESERTA</th>
              <th rowspan="2">NAMA</th>
              <th rowspan="2">NO HP</th>
              <th rowspan="2">FORMASI</th>
              <th rowspan="2">JENIS</th>
              <th rowspan="2">SKD 40%</th>
              <th colspan="4">SKB</th>
              <th rowspan="2">SKB 60%</th>
              <th rowspan="2">TOTAL</th>
              <th rowspan="2">STATUS</th>
            </tr>
            <tr>
              <th>PRAKTEK KERJA</th>
              <th>WAWANCARA</th>
              <th>PSIKOTEST</th>
              <th>JUMLAH</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($peserta as $row) {?>
              <tr>
                <td>'<?= $row->nopeserta;?></td>
                <td><?= $row->nama;?></td>
                <td><?= $row->no_hp;?></td>
                <td><?= $row->formasi;?></td>
                <td><?= $row->jenis;?></td>
                <td><?= $row->skd;?></td>
                <td><?= $row->praker;?></td>
                <td><?= $row->wawancara;?></td>
                <td><?= $row->psikotest;?></td>
                <td><?= $row->jumlah;?></td>
                <td><?= $row->skb;?></td>
                <td><?= ($row->skd+$row->skb);?></td>
                <td><?= $row->status_akhir;?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="detailmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Data Peserta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" id="detail">

      </div>
      <div class="modal-footer">
          <input type="hidden" name="idprint" id="idprint" value="">
          <button type="button" class="btn btn-danger" onclick="printit()">Print DRH</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
      </div>
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
  });

  function detail(nik) {
    $('#detail').load('<?= site_url('admin/skb/peserta/detail');?>/'+nik);
    $('#idprint').val(nik);
    $('#detailmodal').modal('show');
  }

  function printit()
  {
    window.open("https://casn.kemenag.go.id/admin/skb/peserta/printit/"+$('#idprint').val(), "myWindow", 'width=800,height=600');
  }

</script>

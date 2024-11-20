<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dashboard SKB</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <!-- <a href="<?= site_url('admin/peserta/export/cpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6 col-lg-6 mt-3">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-striped" id="">
            <thead>
              <tr>
                <th>FORMASI</th>
                <th>JENIS</th>
                <th>JUMLAH</th>
                <th>JUMLAH PESERTA</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($formasi as $row) {?>
                <tr>
                  <td><?= $row->jabatan;?></td>
                  <td><?= $row->jenis_formasi;?></td>
                  <td><?= $row->jumlah;?></td>
                  <td><?= $row->jumlah_skb;?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-6 mt-3">
      <div class="card border h-100 notes-list-section">
          <a href="#" class="d-inline-block d-lg-none flip-menu-toggle border-0"><i class="icon-menu"></i></a>
          <div class="row notes">
              <div class="col-12 col-md-12 col-lg-12 my-3 note business-note all starred" data-type="business-note">
                  <div class="card">
                      <div class="card-content">
                          <div class="card-body p-4">
                              <h6 class="mb-3 font-w-600">Format Berita Acara SKB</h6>
                              <!-- <p class="font-w-500 tx-s-12"><i class="icon-calendar"></i> <span class="note-date">June 14th, 2020</span></p> -->
                              <div class="note-content mb-4"><a href="<?= base_url();?>assets/BERITA ACARA SKB.docx" class="btn btn-danger">Download Format</a></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12  col-md-12 col-lg-12 my-3 note personal-note all important" data-type="personal-note">
                  <div class="card">
                      <div class="card-content">
                          <div class="card-body p-4">
                              <h6 class="mb-3 font-w-600">Akses Akun Satker SKB CPNS</h6>
                              <!-- <p class="font-w-500 tx-s-12"><i class="icon-calendar"></i> <span class="note-date">June 4th, 2020</span></p> -->
                              <div class="note-content mb-4">
                                <ul>
                                  <li>Training: <a href="http://skbcpns.kemenag.go.id/training" target="_blank">http://skbcpns.kemenag.go.id/training</a></li>
                                  <li>Live: <a href="http://skbcpns.kemenag.go.id/" target="_blank">http://skbcpns.kemenag.go.id/</a></li>
                                  <li>Username: <?php echo $this->session->userdata('kode_satker');?></li>
                                  <li>Password: <?php echo $this->session->userdata('kode_satker');?></li>
                                </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
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

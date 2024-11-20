<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Lokasi SKD CPNS</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <!-- <a href="<?= site_url('admin/peserta/export/cpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>LOKASI</th>
            <th>JUMLAH</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($lokasi as $row) {?>
            <tr>
              <td><?= $no;?></td>
              <td><?= $row->lokasi_ujian_nama;?></td>
              <td><?= $row->jumlah;?></td>
            </tr>
          <?php $no++;} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

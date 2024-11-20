<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Lokasi Ujian pada Wilayah</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <div class="card bg-primary text-white h-100">
                            <div class="card-body text-center p-3 d-flex">
                                <div class="align-self-center text-center w-100">
                                    <h2 class="card-title font-weight-bold"><?= $jumlah->jumlah;?></h2>
                                    <span class="h4">Peserta</span>
                                </div>

                            </div>
                        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <div class="card">
        <div class="card-header">
            <h5>Lokasi Ujian</h5>
            <span class="text-muted">Panitia Lokasi Ujian diharuskan menyediakan ruangan sesuai dengan Jumlah Ruangan yang tertera di masing-masing titik lokasi.</span>
            <p>Link data peserta dapat dishare ke Panitia Lokasi</p>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <!-- <li><button type="button" class="btn btn-success float-right" onclick="addtilok()"><i class="zmdi zmdi-plus"></i>Tambah Titik Lokasi</button></li> -->
                </ul>
            </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Lokasi</th>
                <th>Username SIAP</th>
                <th>Password SIAP</th>
                <th>Link Data</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lokasi as $row) {?>
                <tr>
                  <td><?= $row->lokasi_ujian;?></td>
                  <td><?= $row->kode_satker.'.'.$row->id;?></td>
                  <td><?= $row->kode_satker;?></td>
                  <td><a href="<?= site_url('tilok/index/'.$row->kode_tilok);?>" target="_blank"><?= $row->kode_tilok;?></a></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

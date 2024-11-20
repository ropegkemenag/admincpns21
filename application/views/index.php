<div class="container-fluid site-width">
  <!-- START: Breadcrumbs-->
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dashboard</h4></div>

        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <li class="breadcrumb-item">Last Update: <?= get_option('last_update')?></li>
        </ol>
      </div>
    </div>
  </div>
  <!-- END: Breadcrumbs-->

  <!-- START: Card Data-->
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <div class="card border">
        <div class="card-content">
          <div class="card-body p-4">
            <div class="d-md-flex">
              <div class="my-auto">
                <img src="https://docudigital.bkn.go.id/dist/img/logo_docu_sidebar.png" alt="author" width="200" class="my-auto">
              </div>
              <div class="content px-md-3 my-3 my-md-0">
                <span class="mb-0 font-w-600 h5">Pengunaan Docudigital</span><br>
                <ul>
                  <li>Login:
                    <ul>
                      <li>User: pengadaan2019</li>
                      <!-- <li>Password: ropeg123</li> -->
                      <li>Password: 197507082002121002</li>
                    </ul>
                  </li>
                  <li>Klik Menu Dokumen CASN > CPNS</li>
                  <li>Pada Tab Dokumen CPNS, pilih tahun formasi 2021 dan masukan nomor peserta.</li>
                  <li>Pada daftar dokumen yang diunggah, klik <b>valid</b> jika sudah benar.</li>
                  <li>Jika perlu ada perbaikan, silahkan hubungi peserta ybs untuk mengirimkan file ke Admin Satker.</li>
                  <li>Perubahan dokumen dilakukan oleh admin satker melalui docudigital pada tab "unggah dokumen"</li>
                  <li>Untuk mengunggah dokumen pastikan nama file yang akan diunggah sama dengan nama file pada dokumen peserta yang akan diubah.</li>
                  <li>Contoh: DRH_nomorpeserta.pdf > DRH_2130122110004945.pdf jika ingin merubah DRH. dst</li>
                  <li>Selamat bekerja dan semoga sehat selalu.</li>
                  <li>Semoga bisa makan duren bareng di Lampung.</li>
                </ul>
              </div>
              <div class="my-auto">
                <a href="https://docudigital.bkn.go.id/" target="_blank" class="btn btn-outline-primary font-w-600 my-auto text-nowrap">Docu Digital</a>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="card border">
                          <div class="card-content">
                              <div class="card-body p-4">
                                  <div class="d-md-flex">
                                      <div class="my-auto">
                                          <img src="https://tte.kemenag.go.id/assets/img/logo-bsre.png" alt="author" width="200" class="my-auto">
                                      </div>
                                      <div class="content px-md-3 my-3 my-md-0">
                                          <span class="mb-0 font-w-600 h5">Pengunaan TTE Kemenag</span><br>
                                          <ul>
                                            <li>Login:
                                              <ul>
                                                <li>User: septiansaputra@kemenag.go.id</li>
                                                <li>Password: Tte-2021</li>
                                              </ul>
                                            </li>
                                            <li>Klik Menu Dokumen > Unggah Dokumen  </li>
                                            <li>Jenis Dokumen: Usul Pengadaan</li>
                                            <li>Perihal Dokumen: Nota Usul a.n Nama Peserta</li>
                                            <li>Pejabat Penandatangan: Dr. Nurudin, S.Pd.I, M.Si</li>
                                            <li>Tipe Kertas: Potrait</li>
                                            <li>Dokumen: PDF</li>
                                            <li>Pastikan Nota Usul pada bagian tanda tangan sudah diberi tanda ^</li>
                                            <li>Agar lebih mudah, Nama file PDF direname menjadi NOTANIP_NOMORPESERTA.pdf</li>
                                          </ul>
                                      </div>
                                      <div class="my-auto">
                                          <a href="https://tte.kemenag.go.id/login" target="_blank" class="btn btn-outline-primary font-w-600 my-auto text-nowrap">TTE Kemenag</a>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>
    </div>

          <div class="col-12 col-lg-4">
              <div class="row">
                  <div class="col-12 mt-3">
                      <div class="card bg-primary">
                          <div class="card-body">
                              <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                  <i class="icon-bag icons card-liner-icon mt-2 text-white"></i>
                                  <div class='card-liner-content'>
                                      <h2 class="card-liner-title text-white"><?= $jfcpns;?></h2>
                                      <h6 class="card-liner-subtitle text-white">Formasi CPNS</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- <div class="card mt-3 bg-success">
                          <div class="card-body">
                              <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                  <i class="icon-bag icons card-liner-icon mt-2"></i>
                                  <div class='card-liner-content'>
                                      <h2 class="card-liner-title"><?= $jfpppk;?></h2>
                                      <h6 class="card-liner-subtitle">Formasi PPPK</h6>
                                  </div>
                              </div>
                          </div>
                      </div> -->
                      <div class="card mt-3 bg-warning">
                          <div class="card-body">
                              <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                  <i class="icon-user icons card-liner-icon mt-2"></i>
                                  <div class='card-liner-content'>
                                      <h2 class="card-liner-title"><?= $pelamar_cpns;?></h2>
                                      <h6 class="card-liner-subtitle">Pelamar CPNS</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card mt-3">
                          <div class="card-body">
                              <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                  <i class="icon-user icons card-liner-icon mt-2"></i>
                                  <div class='card-liner-content'>
                                      <h2 class="card-liner-title">0</h2>
                                      <h6 class="card-liner-subtitle">Pelamar PPPK</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-lg-8 mt-3">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">

                          <div id="apex_bar_chart" class="height-400"></div>
                      </div>
                  </div>
              </div>
          </div>
    <div class="col-md-6 col-xs-12 mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Data Pelamar CPNS Jabatan</h4>
        </div>
        <table class="table table-bordered table-striped" id="datatable">
          <thead>
            <tr>
              <th>JABATAN</th>
              <th>PELAMAR</th>
              <th>MS</th>
              <th>TMS</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($jabatans as $row) {?>
              <tr>
                <td><?= $row->jabatan_nama;?></td>
                <td><?= $row->jumlah;?></td>
                <td><?= $row->ms;?></td>
                <td><?= ($row->jumlah-$row->ms);?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6 col-xs-12 mt-3">
      <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h6 class="card-title">Status Verifikasi CPNS</h6>
          </div>
          <div class="card-body text-center">
              <div id="apex_pie_chart" class="height-300"></div>
          </div>
      </div>
    </div>
    <div class="col-12  mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Download</h4>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Download</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Surat Penyampaian Formasi</td>
                <td><a href="<?= site_url('admin/dashboard/surat'); ?>" class="btn btn-primary">Download</a></td>
              </tr>
              <tr>
                <td>Data Sanggah</td>
                <td><a href="<?= site_url('admin/download/sanggah'); ?>" class="btn btn-primary">Download</a></td>
              </tr>
              <?php if(!empty($satker->lokasi)){ ?>
              <tr>
                <td>Data Peserta SKD</td>
                <td><a href="<?= site_url('admin/download/jadwalskd'); ?>" class="btn btn-primary">Download</a></td>
              </tr>
              <?php } ?>
              <tr>
                <td>Generate Template</td>
                <td><a href="javascript:;" class="btn btn-warning" onclick="opengenerate()">Mulai</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Card DATA-->
</div>

<div class="modal fade generate" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel10">Generate Template Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="<?= site_url('admin/download/templatejadwal');?>" method="post" id="generatejadwal">
          <div class="form-group row">
              <label for="jumlah_sesi" class="col-sm-2 col-form-label">Mulai Tanggal</label>
              <div class="col-sm-10">
                  <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Jumlah Sesi Per Hari">
              </div>
          </div>
          <div class="dynamic">
            <div class="form-group row">
              <label for="nomor_ruang" class="col-sm-2 col-form-label">Jumlah PC / Ruang</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" name="nomor_ruang[]" placeholder="Nomor Ruang (Hanya Angka)">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="jumlah_pc[]" placeholder="Jumlah PC dalam ruangan">
              </div>
              <div class="col-sm-2">
                <button type="button" name="add" class="btn btn-success" onclick="addruang(1)">Tambah Ruang</button>
              </div>
            </div>
          </div>
          <div class="form-group row">
              <label for="jumlah_sesi" class="col-sm-2 col-form-label">Jumlah Sesi Per Hari</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah_sesi" name="jumlah_sesi" placeholder="Jumlah Sesi Per Hari">
              </div>
          </div>
          <div class="form-group row">
              <label for="jumlah_peserta" class="col-sm-2 col-form-label">Jumlah Peserta</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah_peserta" name="jumlah_peserta" placeholder="Jumlah Semua Peserta">
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="$('#generatejadwal').submit();">Generate</button>
      </div>
    </div>
  </div>
</div>
<script src="<?= asset_url();?>vendors/apexcharts/apexcharts.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    options = {
            theme: {
                mode: 'light'
            },
            grid: {

                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            chart: {
                height: 318,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: '10',
                }
            },
            dataLabels: {
                enabled: true
            },
            colors: ['#1e3d73'],
            series: [{
                    data: [
                      <?php $no=1; foreach ($jabatans as $row) {
                        echo ($no > 1)?',':'';
                        echo $row->jumlah;
                        $no++;
                      } ?>
                    ]
                }],
            xaxis: {
                labels: {
                  rotate: -45
                },
                categories: [
                  <?php $no=1; foreach ($jabatans as $row) {
                    echo ($no > 1)?',':'';
                    echo "'$row->jabatan_nama'";
                    $no++;
                  } ?>
                ]

            }
        }

        var chart = new ApexCharts(
                document.querySelector("#apex_bar_chart"),
                options
                );
        chart.render();

      pieoptions = {
        theme: {
            mode: 'light'
        },
        chart: {
            width: 490,
            type: 'pie',
        },
        labels: [
          <?php $no=1; foreach ($verifikasi as $row) {
            if($row->status_verifikasi == 1){
              $status = 'MS';
            }else if($row->status_verifikasi == 0){
              $status = 'TMS';
            }else{
              $status = 'Belum Verifikasi';
            }

            echo ($no > 1)?',':'';
            echo "'$status'";
            $no++;
          } ?>
        ],
        series: [
          <?php $no=1; foreach ($verifikasi as $row) {
            echo ($no > 1)?',':'';
            echo $row->jumlah;
            $no++;
          } ?>
        ],
        responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 350
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
    }

    var chart = new ApexCharts(
            document.querySelector("#apex_pie_chart"),
            pieoptions
            );

    chart.render();

    $('.removeit').on('click', function(event) {
      console.log('asdasd');
      $(this).parents('div').remove();
    });

  });

  function opengenerate() {
    $('.generate').modal('show');
  }

  function removeit(id) {
    $('#row'+id).remove();
    console.log('removed');
  }

  function addruang(id) {
    var id = id+1;
    $(".dynamic").append('<div class="form-group row" id="row'+id+'">'+
      '<label for="nomor_ruang" class="col-sm-2 col-form-label">Jumlah PC / Ruang</label>'+
      '<div class="col-sm-4">'+
        '<input type="number" class="form-control" name="nomor_ruang[]" placeholder="Nomor Ruang (Hanya Angka)">'+
      '</div>'+
      '<div class="col-sm-4">'+
        '<input type="text" class="form-control" name="jumlah_pc[]" placeholder="Jumlah PC dalam ruangan">'+
      '</div>'+
      '<div class="col-sm-2">'+
        '<button type="button" name="add" class="btn btn-danger" onclick="removeit('+id+')">Hapus</button>'+
      '</div>'+
    '</div>');
  }

</script>

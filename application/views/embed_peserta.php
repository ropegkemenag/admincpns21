<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>CPNS 2021 Kementerian Agama</title>
        <link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?= base_url();?>assets/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url();?>assets/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?= base_url();?>assets/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?= base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?= base_url();?>assets/vendors/flags-icon/css/flag-icon.min.css">

        <!-- END Template CSS-->

        <!-- START: Custom CSS-->
        <!-- <link rel="stylesheet" href="<?= base_url();?>assets/css/main.css"> -->
        <style media="screen">
          body {
            background: #FFFFFF !important;
          }
        </style>
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="wrapper">
                      <h3>DAFTAR RIWAYAT HIDUP PESERTA</h3>
                      <table class="table table-striped">
                            <tbody>
                              <tr>
                                <th></th>
                                <td><img src="https://casn.kemenag.go.id/peserta/uploads/foto/<?php echo $peserta->nopeserta.'.jpg';?>" width="200px"></td>
                              </tr>
                      		<tr>
                                <th>NIK</th>
                                <td><?php echo $peserta->nik;?></td>
                              </tr>
                              <tr>
                                <th>Nomor Peserta</th>
                                <td><?php echo $peserta->nopeserta;?></td>
                              </tr>
                              <tr>
                                <th>Nama</th>
                                <td><?php echo $peserta->nama;?></td>
                              </tr>
                              <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td><?php echo $pesertax->tempat_lahir_ktp.', '.$pesertax->tgl_lahir_ijazah;?></td>
                              </tr>
                              <tr>
                                <th>Formasi</th>
                                <td><?php echo $peserta->formasi;?></td>
                              </tr>
                              <tr>
                                <th>Jenis</th>
                                <td><?php echo $peserta->jenis;?></td>
                              </tr>
                              <tr>
                                <th>Jenis Disabilitas</th>
                                <td><?php echo $peserta->disabilitas;?></td>
                              </tr>
                              <!-- <tr>
                                <th>Email</th>
                                <td><?php echo $peserta->email;?></td>
                              </tr>
                              <tr>
                                <th>No HP</th>
                                <td><?php echo $peserta->no_hp;?></td>
                              </tr> -->
                              <tr>
                                <th>Agama</th>
                                <td><?php echo $peserta->agama;?></td>
                              </tr>
                              <?php if(substr($peserta->kode_formasi,0, 6) == 'JFGURU'){?>
                              <tr>
                                <th>Sertifikat Pendidik</th>
                                <td><?php echo ($peserta->serdik == '')?'(Tidak mengunggah)':'<a href="https://casn.kemenag.go.id/peserta/uploads/serdik/'.$peserta->serdik.'" target="_blank">Lihat</a>';?></td>
                              </tr>
                              <tr>
                                <th>Linier</th>
                                <td><?php echo ($peserta->serdik_linier == 1)?'Ya':'Tidak';?></td>
                              </tr>
                              <?php }?>
                              <tr>
                                <th>Facebook</th>
                                <td><?php echo $peserta->facebook;?></td>
                              </tr>
                              <tr>
                                <th>Instagram</th>
                                <td><?php echo $peserta->instagram;?></td>
                              </tr>
                              <tr>
                                <th>Twitter</th>
                                <td><?php echo $peserta->twitter;?></td>
                              </tr>
                            </tbody>
                          </table>

                          <h4>Riwayat Pendidikan</h4>
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Tahun</th>
                                <th>Jenjang</th>
                                <th>Nama Sekolah/PT</th>
                                <th>Jurusan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($pendidikan as $row) {?>
                                <tr>
                                  <td><?php echo $row->tahun;?></td>
                                  <td><?php echo $row->jenjang;?></td>
                                  <td><?php echo $row->nama;?></td>
                                  <td><?php echo $row->jurusan;?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                          <h4>Riwayat Pekerjaan</h4>
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Tahun</th>
                                <th>Perusahaan/Instansi</th>
                                <th>Jabatan</th>
                                <th>Lampiran</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($pekerjaan as $row) {?>
                                <tr>
                                  <td><?php echo $row->mulai_tahun.' - '.$row->sampai_tahun;?></td>
                                  <td><?php echo $row->nama;?></td>
                                  <td><?php echo $row->jabatan;?></td>
                                  <td><?php echo ($row->lampiran == '')?'(Tidak mengunggah)':'<a href="https://casn.kemenag.go.id/peserta/uploads/pekerjaan/'.$row->lampiran.'" target="_blank">Lampiran</a>';?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                          <h4>Riwayat Organisasi</h4>
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Tahun</th>
                                <th>Organisasi</th>
                                <th>Jabatan</th>
                                <th>Lampiran</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($organisasi as $row) {?>
                                <tr>
                                  <td><?php echo $row->mulai_tahun.' - '.$row->sampai_tahun;?></td>
                                  <td><?php echo $row->nama;?></td>
                                  <td><?php echo $row->jabatan;?></td>
                                  <td><?php echo ($row->lampiran == '')?'(Tidak mengunggah)':'<a href="https://casn.kemenag.go.id/peserta/uploads/pekerjaan/'.$row->lampiran.'" target="_blank">Lampiran</a>';?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                      	<h4>Riwayat Dokumen</h4>
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Dokumen</th>
                                <th>Keterangan</th>
                                <th>Tahun</th>
                                <th>Lampiran</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($dokumen as $row) {?>
                                <tr>
                                  <td><?php echo $row->nama;?></td>
                                  <td><?php echo $row->keterangan;?></td>
                                  <td><?php echo $row->tahun;?></td>
                                  <td><a href="<?php echo 'https://casn.kemenag.go.id/peserta/uploads/pekerjaan/'.$row->lampiran;?>" target="_blank">Lampiran</a></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>
        <!-- END: Content-->

        <!-- START: Template JS-->
        <script src="<?= base_url();?>assets/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url();?>assets/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url();?>assets/vendors/moment/moment.js"></script>
        <script src="<?= base_url();?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url();?>assets/vendors/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- END: Template JS-->
    </body>
    <!-- END: Body-->
</html>

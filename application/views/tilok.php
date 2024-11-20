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
        <link rel="stylesheet" href="<?= base_url();?>assets/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default bg-primary">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                  <div class="card mt-3">
                    <div class="card-header  justify-content-between align-items-center">
                      <h6 class="card-title">Data Peserta Lokasi</h6>
                      <h6 class="card-title"><?= $lokasi->lokasi_ujian;?></h6>
                      <h6 class="card-title"><?= $lokasi->provinsi;?></h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable">
                          <thead class="text-center">
                            <tr>
                              <th>Nomor Peserta</th>
                              <th>Nama</th>
                              <th>Formasi</th>
                              <th>No HP</th>
                              <th>Satuan Kerja</th>
                              <th>Praktik Kerja (WIB)</th>
                              <th>Ruangan</th>
                              <th>Wawancara (WIB)</th>
                              <th>Ruangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($peserta as $row) {
                              ?>
                              <tr>
                                <td>'<?php echo $row->nopeserta;?></td>
                                <td><?php echo $row->nama;?></td>
                                <td><?php echo $row->formasi;?></td>
                                <td><?php echo $row->no_hp;?></td>
                                <td><?php echo $row->satker;?></td>
                                <td><?php echo $row->jadwal_praktik;?></td>
                                <td><?php echo $row->ruangan_praktik;?></td>
                                <td><?php echo $row->jadwal_wawancara;?></td>
                                <td><?php echo $row->ruangan_wawancara;?></td>
                              </tr>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
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

        </script>

        <!-- END: Template JS-->
    </body>
    <!-- END: Body-->
</html>

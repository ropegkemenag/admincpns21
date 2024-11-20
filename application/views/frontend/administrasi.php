<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  <!-- Author -->
  <meta name="author" content="Biro Kepegawaian">
  <!-- description -->
  <meta name="description" content="Sistem Penerimaan Calon Aparatur Sipil Negara. CPNS dan PPPPK Kementerian Agama RI.">
  <!-- keywords -->
  <meta name="keywords" content="casn, cpns, cpppk, ASN, PPPK, PNS, CPNS Kemenag, CASN kemenag, kementerian agama">
  <!-- Page Title -->
  <title>Penerimaan CASN 2021 | Kementerian Agama RI</title>
  <!-- Favicon -->
  <link href="<?= asset_url();?>frontend/agency/img/favicon.ico" rel="icon">
  <!-- Bundle -->
  <link href="<?= asset_url();?>frontend/vendor/css/bundle.min.css" rel="stylesheet">
  <link href="<?= asset_url();?>frontend/vendor/css/revolution-settings.min.css" rel="stylesheet">
  <!-- Plugin Css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Style Sheet -->
  <link href="<?= asset_url();?>frontend/agency/css/style.css" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-J99EEB9TG6"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-J99EEB9TG6');
  </script>
</head>

<body data-offset="90" data-spy="scroll" data-target=".navbar">

  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom shadow-sm" style="background-color: #1976d2;">
  <h5 class="my-0 mr-md-auto text-light font-weight-normal">CASN Kemenag</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-light" href="<?= site_url();?>">Home</a>
    <a class="p-2 text-light" href="<?= site_url('dashboard/administrasi');?>">Pendaftaran</a>
  </nav>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Statistik Pelamar Formasi</h1>
</div>

<div class="container">
  <div class="card-deck mb-3">
    <div class="card mb-4 shadow-sm">
      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped formasi">
          <thead>
            <tr>
              <th>Jabatan</th>
              <th>Lokasi</th>
              <th>Jenis</th>
              <th>Kebutuhan</th>
              <th>Pelamar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($peserta as $row) {?>
              <tr>
                <td><?= $row->jabatan;?></td>
                <td><?= $row->lokasi_formasi;?></td>
                <td><?= $row->jenis_formasi;?></td>
                <td><?= $row->jumlah;?></td>
                <td><?= $row->peserta;?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
  <!--Scroll Top Start-->
  <span class="scroll-top-arrow"><i class="fas fa-angle-up"></i></span>
  <!--Scroll Top End-->

  <!-- JavaScript -->
  <script src="<?= asset_url();?>frontend/vendor/js/bundle.min.js"></script>
  <!-- Plugin Js -->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <!-- custom script -->
  <script src="<?= asset_url();?>frontend/vendor/js/contact_us.js"></script>
  <script src="<?= asset_url();?>frontend/agency/js/script.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('.formasi').DataTable({
      responsive: true
    });
  } );
  </script>
</body>
</html>

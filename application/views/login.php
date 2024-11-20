<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Form Biodata CPNS Kemenag 2019">
    <meta name="author" content="@danualbantani">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset_url();?>img/favicon.png">

    <title>CPNS Kemenag 2019</title>

    <!-- vendor css -->
    <link href="<?php echo asset_url();?>lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo asset_url();?>css/dashforge.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/dashforge.auth.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150069845-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-150069845-3');
</script>

  </head>
  <body>

    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          <div class="media-body align-items-center d-none d-lg-flex">
            <div class="mx-wd-600">
              <img src="<?php echo asset_url();?>img/signin.svg" class="img-fluid" alt="">
            </div>
          </div><!-- media-body -->
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
            <div class="wd-100p">
              <form class="" action="" method="post">

              <h3 class="tx-color-01 mg-b-5">Sign In</h3>
              <p class="tx-color-03 tx-16 mg-b-40"><?php echo $message;?></p>
              <?php
              $tanggal = date('d');
              if($tanggal < 0)
              {
                echo 'Layanan ditutup sementara. Sampai ada pengumuman selanjutnya.';
              }else{
              ?>
              <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan (KTP)">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Nomor Peserta</label>
                </div>
                <input type="text" name="noreg" class="form-control" placeholder="Nomor Peserta pada Kartu Ujian">
              </div>
              <input class="btn btn-brand-02 btn-block" type="submit" name="submit" value="Sign In">
              <!-- <div class="tx-13 mg-t-20 tx-center">Tidak bisa login? <a href="https://ropegkemenag.freshdesk.com/support/tickets/new" target="_blank">Hubungi Admin</a></div> -->
              <?php //echo $recaptcha;?>
              <?php //echo $recaptchascript;?>
              <?php  }?>
            </form>
            </div>
          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; CPNS 2019 Kemenag RI</span>
        <span>Created by <a href="https://ropeg.kemenag.go.id">Biro Kepegawaian</a></span>
      </div>
      <div>
      </div>
    </footer>

    <script src="<?php echo asset_url();?>lib/jquery/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo asset_url();?>lib/feather-icons/feather.min.js"></script>
    <script src="<?php echo asset_url();?>lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo asset_url();?>js/dashforge.js"></script>
    <script src="<?php echo asset_url();?>lib/js-cookie/js.cookie.js"></script>
  </body>
</html>

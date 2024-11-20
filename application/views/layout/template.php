<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin CPNS 2021 - Kementerian Agama</title>
  <link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico" />
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/jquery-ui/jquery-ui.theme.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/flags-icon/css/flag-icon.min.css">
  <link href="<?= base_url();?>assets/vendors/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="<?= base_url();?>assets/css/main.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/sweetalert/sweetalert.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/datatable/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?= base_url();?>assets/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>

  <script src="<?= base_url();?>assets/vendors/jquery/jquery-3.3.1.min.js"></script>
</head>
<body id="main-container" class="default semi-dark horizontal-menu">
  <!-- START: Pre Loader-->
  <div class="se-pre-con">
    <div class="loader"></div>
  </div>
  <!-- END: Pre Loader-->

  <!-- START: Header-->
  <div id="header-fix" class="header fixed-top">
    <div class="site-width">
      <nav class="navbar navbar-expand-lg  p-0">
        <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
          <a href="index.html" class="horizontal-logo text-left">
            <svg height="20pt" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512" width="20pt" xmlns="http://www.w3.org/2000/svg">
              <g transform="matrix(.1 0 0 -.1 0 512)" fill="#1e3d73">
                <path d="m1450 4481-1105-638v-1283-1283l1106-638c1033-597 1139-654 1139-619 0 4-385 674-855 1489-470 814-855 1484-855 1488 0 8 1303 763 1418 822 175 89 413 166 585 190 114 16 299 13 408-5 100-17 231-60 314-102 310-156 569-509 651-887 23-105 23-331 0-432-53-240-177-460-366-651-174-175-277-247-738-512-177-102-322-189-322-193s104-188 231-407l231-400 46 28c26 15 360 207 742 428l695 402v1282 1282l-1105 639c-608 351-1107 638-1110 638s-502-287-1110-638z"/><path d="m2833 3300c-82-12-190-48-282-95-73-36-637-358-648-369-3-3 580-1022 592-1034 5-5 596 338 673 391 100 69 220 197 260 280 82 167 76 324-19 507-95 184-233 291-411 320-70 11-89 11-165 0z"/>
              </g>
            </svg> <span class="h4 font-weight-bold align-self-center mb-0 ml-auto">PICK</span>
          </a>
        </div>
        <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
          <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
        </div>


        <div class="navbar-right ml-auto h-100">
          <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
            <li class="d-inline-block align-self-center  d-block d-lg-none">
              <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>
              </a>
            </li>
            <li class="dropdown user-profile align-self-center d-inline-block">
              <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                <div class="media">
                  <img src="<?= base_url();?>assets/images/author.jpg" alt="" class="d-flex img-fluid rounded-circle" width="29">
                </div>
              </a>

              <div class="dropdown-menu border dropdown-menu-right p-0">
                          <a href="<?= site_url('admin/auth/logout')?>" class="dropdown-item px-2 text-danger align-self-center d-flex">
                            <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                          </div>

                        </li>

                      </ul>
                    </div>
                  </nav>
                </div>
              </div>
              <!-- END: Header-->

              <!-- START: Main Menu-->
              <div class="sidebar">
                <div class="site-width">

                  <!-- START: Menu-->
                  <ul id="side-menu" class="sidebar-menu">
                    <li id="menudashboard"><a href="<?= site_url('admin')?>"><i class="icon-home mr-1"></i> Beranda</a></li>
                    <li class="dropdown" id="menuformasi">
                      <a href="<?= site_url('admin/formasi');?>"><i class="icon-organization mr-1"></i> Formasi</a>
                      <ul>
                        <li><a href="<?= site_url('admin/formasi/cpns');?>"><i class="icon-calendar"></i> CPNS</a></li>
                        <!-- <li><a href="<?= site_url('admin/formasi/pppk');?>"><i class="icon-speech"></i> PPPK</a></li> -->
                      </ul>
                    </li>
                    <li class="dropdown" id="menupeserta">
                      <a href="<?= site_url('admin/peserta');?>"><i class="icon-people mr-1"></i> Peserta</a>
                      <ul>
                        <li class="dropdown"><a href="javascript:;"><i class="icon-calendar"></i> CPNS</a>
                          <ul class="sub-menu">
                            <li><a href="<?= site_url('admin/peserta/cpns');?>"><i class="icon-disc"></i> Semua Pelamar</a></li>
                            <li><a href="<?= site_url('admin/peserta/cpns/0');?>"><i class="icon-disc"></i> TMS</a></li>
                            <li><a href="<?= site_url('admin/peserta/cpns/1');?>"><i class="icon-disc"></i> MS (Ikut SKD)</a></li>
                            <li><a href="<?= site_url('admin/peserta/cpnslulus');?>"><i class="icon-disc"></i> LULUS</a></li>
                          </ul>
                        </li>
                        <li><a href="<?= site_url('admin/peserta/pppk');?>"><i class="icon-speech"></i> PPPK</a></li>
                      </ul>
                    </li>
                    <li class="dropdown" id="menulokasi">
                      <a href="<?= site_url('admin/lokasi');?>"><i class="icon-cursor mr-1"></i> Lokasi Ujian</a>
                      <ul>
                        <li><a href="<?= site_url('admin/lokasi/cpns');?>"><i class="icon-calendar"></i> CPNS</a></li>
                        <!-- <li><a href="<?= site_url('admin/lokasi/pppk');?>"><i class="icon-speech"></i> PPPK</a></li> -->
                      </ul>
                    </li>
                    <li class="dropdown" id="menupeserta">
                      <a href="<?= site_url('admin/peserta');?>"><i class="icon-people mr-1"></i> SKB</a>
                      <ul>
                        <?php if($this->session->userdata('group') == 3){ ?>
                        <li class="dropdown"><a href="javascript:;"><i class="icon-calendar"></i> Panitia Kanwil</a>
                          <ul class="sub-menu">
                            <li><a href="<?= site_url('admin/skb/lokasi');?>"><i class="icon-disc"></i> Lokasi Ujian</a></li>
                            <li><a href="<?= site_url('admin/skb/lokasi/panitia');?>"><i class="icon-disc"></i> Panitia Lokasi</a></li>
                          </ul>
                        </li>
                        <?php } ?>
                        <li><a href="<?= site_url('admin/skb/dashboard');?>"><i class="icon-speech"></i> Dashboard</a></li>
                        <li><a href="<?= site_url('admin/skb/peserta');?>"><i class="icon-speech"></i> Peserta</a></li>
                        <li><a href="<?= site_url('admin/skb/penguji');?>"><i class="icon-speech"></i> Penguji</a></li>
                        <li><a href="<?= site_url('admin/skb/jadwal');?>"><i class="icon-speech"></i> Jadwal Zoom</a></li>
                        <li><a href="<?= site_url('admin/skb/info');?>"><i class="icon-speech"></i> Info Satker</a></li>
                        <li><a href="<?= site_url('admin/skb/peserta/nilai');?>"><i class="icon-speech"></i> Nilai Peserta</a></li>
                      </ul>
                    </li>
                    <li id="menudokumen">
                      <a href="<?= site_url('admin/dokumen');?>"><i class="icon-doc mr-1"></i> Dokumen</a>
                    </li>
                    <!-- <li>
                      <a href="<?= site_url('admin/setting');?>"><i class="icon-doc mr-1"></i> Pengaturan</a>
                    </li> -->
                  </ul>
                  <!-- END: Menu-->
                  <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                    <li class="breadcrumb-item active"><?= $this->session->userdata('nama_satker');?></li>
                  </ol>
                </div>
              </div>
              <!-- END: Main Menu-->

              <!-- START: Main Content-->
              <main>
                <?php $this->load->view($view); ?>
              </main>
              <!-- END: Content-->



              <!-- START: Footer-->
              <footer class="site-footer">
                2021 © BIRO KEPEGAWAIAN
              </footer>
              <!-- END: Footer-->


              <!-- START: Back to top-->
              <a href="#" class="scrollup text-center">
                <i class="icon-arrow-up"></i>
              </a>
              <!-- END: Back to top-->

              <!-- START: Template JS-->

              <script src="<?= base_url();?>assets/vendors/jquery-ui/jquery-ui.min.js"></script>
              <script src="<?= base_url();?>assets/vendors/moment/moment.js"></script>
              <script src="<?= base_url();?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
              <script src="<?= base_url();?>assets/vendors/slimscroll/jquery.slimscroll.min.js"></script>
              <script src="<?= base_url();?>assets/vendors/sweetalert/sweetalert.min.js"></script>

              <!-- END: Template JS-->

              <!-- START: APP JS-->
              <script src="<?= base_url();?>assets/js/app.js"></script>
              <script type="text/javascript">
                $(document).ready(function() {
                  <?php if($this->session->flashdata('message')){ ?>
                  // Swal.fire({html:"<?= $this->session->flashdata('message')?>",confirmButtonColor:"#5b73e8"})
                  swal("","<?= $this->session->flashdata('message')?>");
                  <?php } ?>

                  var current = location.pathname.split('/')[2];

                  if(typeof(current) === 'undefined'){
                    current = 'dashboard';
                  }

                  $('#menu'+current).addClass('active');
                });

              </script>
              <!-- END: APP JS-->
            </body>
            <!-- END: Body-->
            </html>

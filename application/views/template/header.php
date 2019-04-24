<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-absensi | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- Pace -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/pace/pace.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
  <!-- Bootstrap datetimePicker -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
  <!-- Select 2 -->
  <link href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.css" rel="stylesheet" />

  <link href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2-bootstrap.css" rel="stylesheet" />
  <!-- autocomplete -->
  <link href="<?php echo base_url(); ?>assets/plugins/EasyAutocomplete/easy-autocomplete.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/plugins/EasyAutocomplete/easy-autocomplete.themes.css" rel="stylesheet" />
  </style>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.1/css/colReorder.dataTables.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/skin-green-light.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js" type="text/javascript">

  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
  <!-- Pace -->
  <script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.min.js"></script>
  <!-- bootstrap datetimepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" type="text/javascript">
  </script>
  <!-- InputMask -->
  <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- autocomplete-->
  <script src="<?php echo base_url(); ?>assets/plugins/EasyAutocomplete/jquery.easy-autocomplete.js"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green-light fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>A</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E</b>-Absensi</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url(); ?>assets/dist/img/user.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?=$this->session->userdata('username');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/dist/img/user.jpg" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->userdata('nama');?>
                  <small><?=$this->session->userdata('nip');?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('User/rubahPassword');?>" class="btn btn-default btn-flat">Rubah Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('keluar');?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu " data-widget="tree">
        <li class="header">Menu Utama</li>
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard text-green"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database text-red"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
              $level = $this->session->userdata('id_level');
              $url = base_url('User');

              if ($level == 3) {
                echo "<li><a href='".$url."'><i class='fa fa-user text-blue'></i> <span>User</span></a></li>";
              }
            ?>
            <li><a href="<?php echo base_url('Divisi'); ?>"><i class="fa fa-institution text-red"></i> <span>Divisi</span></a></li>
            <li><a href="<?php echo base_url('Jabatan'); ?>"><i class="fa fa-suitcase text-orange"></i> <span>Jabatan</span></a></li>
            <li><a href="<?php echo base_url('Pegawai'); ?>"><i class="fa fa-group text-aqua"></i> <span>Pegawai</span></a></li>
          </ul>
        </li>
        <!-- Optionally, you can add icons to the links -->
        <li class="header">Menu Absensi</li>
        <li><a href="<?php echo base_url('Formabsensi'); ?>"><i class="fa fa-barcode"></i> <span>Absensi</span></a></li>
        <li><a href="<?php echo base_url('Formcuti'); ?>"><i class="fa fa-calendar-plus-o"></i> <span>Cuti</span></a></li>
        <li><a href="<?php echo base_url('Formdinas'); ?>"><i class="fa fa-automobile "></i> <span>Dinas Luar</span></a></li>
        <li><a href="<?php echo base_url('Harilibur'); ?>"><i class="fa fa-calendar-times-o "></i> Hari Libur</a></li>
        <li class="header">Lainnya</li>
    <!--     <li><a href="#" data-toggle="modal" data-target="#ModalReport"><i class="fa fa-bar-chart"></i> <span>Laporan</span></a></li> -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?php echo base_url('Laporanabsensi/laporan_absensi'); ?>">laporan Absensi</a></li>
<!--             <li><a href="#">laporan Cuti</a></li>
            <li><a href="#">laporan Dinas Luar Kota</a></li> -->
            <li><a href="<?php echo base_url('Laporanabsensi/laporan_summary_absensi'); ?>">laporan Summary Absensi</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('Cpengaturan'); ?>"><i class="fa fa-gear"></i> Pengaturan</a></li>
      </ul>
      <!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->
  </aside>

      <!--Modal Report-->
<!--         <div class="modal modal-default fade" id="ModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-green color-palette">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Laporan</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                        <table class="table table-hover display responsive nowrap" style="width:100%">
                          <thead>
                            <tr class="bg-green color-palette">
                              <th>No</th>
                              <th>Daftar Laporan</th>
                              <th>Opsi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Laporan Divisi</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Laporan Jabatan</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Laporan Pegawai</td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Laporan Absensi</td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>Laporan Cuti Pegawai</td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>Laporan Dinas Luar Kota</td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>Laporan Detail Kehadiran</td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    <!--END MODAL HAPUS-->

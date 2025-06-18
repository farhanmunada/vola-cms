<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vola Dev</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
            </li>
        </ul>

        <!-- User header Dropdown Menu -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar2.png" class="user-image" alt="User Image">
                Hak Akses : <b><?php echo $this->session->userdata('level') ?></b>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url().'dashboard/profil' ?>" class="dropdown-item">
                <i class="fas fa-user mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url().'dashboard/keluar' ?>" class="dropdown-item">
                <i class="fas fa-share mr-2"></i> Keluar
                </a>
            </div>
            </li>
        </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="website CMS" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">WEBSITE CMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php
                $id_user = $this->session->userdata('id');
                $user = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id='$id_user'")->row();
                ?>
                <a href="#" class="d-block"><?php echo $user->pengguna_nama; ?></a>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menu Dashboard -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard' ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i> 
                        <p>DASHBOARD</p> 
                    </a>
                </li>

                <?php if ($this->session->userdata('level') == "admin") { ?>
                <!-- Menu Kategori -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/kategori' ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i> <p>KATEGORI</p> 
                    </a>
                </li>
                <?php } ?>

                <!-- Menu Artikel -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/artikel' ?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i> <p>ARTIKEL</p> 
                    </a>
                </li>

                <?php if ($this->session->userdata('level') == "admin") { ?>
                <!-- Menu Kategori -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/kategori_layanan' ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i> <p>KATEGORI LAYANAN</p> 
                    </a>
                </li>
                <?php } ?>

                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/layanan' ?>" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i> <p>LAYANAN</p> 
                    </a>
                </li>

                <?php if ($this->session->userdata('level') == "admin") { ?>
                <!-- Menu Pages -->
                <li class="nav-item">
                <a href="<?php echo base_url().'dashboard/pages' ?>" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i> <p>PAGES</p>
                </a>
                </li>
                <!-- Menu Pengguna -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/pengguna' ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i> <p>PENGGUNA</p>
                    </a>
                </li>
                <!-- Menu Pengaturan Website -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/pengaturan' ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i> <p>PENGATURAN WEBSITE</p>
                    </a>
                </li>
                <?php } ?>

                <!-- Menu Profil -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/profil' ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i> <p>PROFIL</p>
                    </a>
                </li>

                <!-- Menu Ganti Password -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/ganti_password' ?>" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i> <p>GANTI PASSWORD</p>
                    </a>
                </li>

                <!-- Menu Keluar -->
                <li class="nav-item">
                    <a href="<?php echo base_url().'dashboard/keluar' ?>" class="nav-link">
                        <i class="nav-icon fas fa-share"></i> <p>KELUAR</p>
                    </a>
                </li>
            </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
        </aside>
</body>
</html>
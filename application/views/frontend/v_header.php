<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <title><?php echo $pengaturan->nama;?> - <?php echo $pengaturan->deskripsi;?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo $meta_keyword;?>" name="keywords">
    <meta content="<?php echo $meta_description;?>" name="description">

    <!-- Favicons -->
    <link href="<?php echo base_url().'/gambar/website/'.$pengaturan->logo;?>" rel="icon">
    <link href="<?php echo base_url();?>assets_frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS File -->
    <link href="<?php echo base_url();?>assets_frontend/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?php echo base_url();?>assets_frontend/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_frontend/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_frontend/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_frontend/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="<?php echo base_url();?>assets_frontend\css\style-green.css" rel="stylesheet">
    </head>
    <body id="page-top">

    <!--/ Nav Start /-->
    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
        <div class="container">
        <img src="<?php echo base_url().'/gambar/website/'.$pengaturan->logo;?>" width="30" class="mr-2" alt="Logo">
        <a class="navbar-brand js-scroll" href="#page-top"><?php echo $pengaturan->nama;?></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link js-scroll <?php echo ($this->uri->segment(1) == '' ? 'active' : ''); ?>" href="<?php echo base_url();?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll <?php echo ($this->uri->segment(1) == 'page' && $this->uri->segment(2) == 'tentang-kami' ? 'active' : ''); ?>" href="<?php echo base_url('page/tentang-kami');?>">Tentang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll <?php echo ($this->uri->segment(1) == 'layanan' ? 'active' : ''); ?>" href="<?php echo base_url('layanan'); ?>">Layanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll <?php echo ($this->uri->segment(1) == 'page' && $this->uri->segment(2) == 'kontak-kami' ? 'active' : ''); ?>" href="<?php echo base_url('page/kontak-kami');?>">Kontak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll <?php echo ($this->uri->segment(1) == 'blog' ? 'active' : ''); ?>" href="<?php echo base_url('blog');?>">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll <?php echo ($this->uri->segment(1) == 'login' ? 'active' : ''); ?>" href="<?php echo base_url('login');?>">Login</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <!--/ Nav End /-->

<!--/ Intro Skew Start /-->
    <div id="home" class="intro route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
        <div class="container">
            <p class="display-6 color-d">Selamat Datang</p>
            <h1 class="intro-title mb-4"><?php echo $pengaturan->nama; ?></h1>
            <p class="intro-subtitle">
            <span class="text-slider-items">
                Web Developer, Web Designer, Graphic Designer
            </span>
            <strong class="text-slider"></strong>
            </p>
        </div>
        </div>
    </div>
    </div>
    <!--/ Intro Skew End /-->

    <!--/ Section Services Start /-->
    <section id="layanan" class="blog-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">LAYANAN</h3>
                            <p class="subtitle-a">Layanan yang Kami Sediakan</p>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php foreach ($layanan as $l) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-blog">
                        <div class="card-img">
                            <a href="<?php echo base_url('layanan/kategori/' . $l->kategori_slug); ?>">
                                <?php if ($l->layanan_gambar != '') { ?>
                                    <img src="<?php echo base_url('gambar/layanan/' . $l->layanan_gambar); ?>"
                                    alt="<?php echo $l->layanan_judul ?>"
                                    class="img-fluid w-100"
                                    style="height: 300px; object-fit: cover;">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="card-category-box">
                                <div class="card-category">
                                    <a href="<?php echo base_url('layanan/kategori/' . $l->kategori_slug); ?>">
                                        <h6 class="category"><?php echo $l->kategori_nama ?></h6>
                                    </a>
                                </div>
                            </div>
                            <h3 class="card-title">
                            <a href="<?php echo base_url('layanan/' . $l->layanan_slug); ?>"><?php echo $l->layanan_judul; ?></a>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="post-author">
                                <span class="author"><?php echo $l->pengguna_nama; ?></span>
                            </div>
                            <div class="post-date">
                                <span class="ion-ios-clock-outline"></span> <?php echo date('D-M-Y', strtotime($l->layanan_tanggal)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="text-center mb-5">
                <a href="<?php echo base_url('layanan'); ?>" class="btn btn-primary" style="background-color: #24b67e; border-color: #24b67e;">Lihat Semua Layanan</a>
            </div>

            </div>
        </div>
    </section>
    <!--/ Section Services end /-->
    
    <!--/ Section Counter Start /-->
    <div class="section-counter paralax-mf bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
        <div class="overlay-mf"></div>
        <div class="container">
            <div class="row">
            <?php foreach ($counter as $c) { ?>
                <div class="col-sm-3 col-lg-3">
                    <div class="counter-box pt-4 pt-md-0">
                        <div class="counter-ico">
                            <span class="ico-circle"><i class="<?php echo $c->icon; ?>"></i></span>
                        </div>
                        <div class="counter-num">
                            <p class="counter"><?php echo $c->number; ?></p>
                            <span class="counter-text"><?php echo strtoupper($c->label); ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <!--/ Section Counter End /-->

    <!--/ Section Portfolio Start /-->
    <section id="work" class="portfolio-mf sect-pt4 route">
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
                <div class="title-box text-center">
                <h3 class="title-a">Portfolio</h3>
                <p class="subtitle-a">Portfolio Terbaru kami </p>
                <div class="line-mf"></div>
                </div>
            </div>
            </div>
            
            <div class="row">
            <?php foreach ($portfolio as $p) { ?>
                <div class="col-md-4">
                <div class="work-box">
                    <div class="work-img">
                    <a href="<?php echo base_url('gambar/portfolio/' . $p->portfolio_gambar); ?>" data-lightbox="gallery-mf">
                        <img src="<?php echo base_url('gambar/portfolio/' . $p->portfolio_gambar); ?>" 
                            alt="<?php echo $p->portfolio_judul ?>" 
                            class="img-fluid"
                            style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px;">
                    </a>
                    </div>
                    <div class="work-content">
                    <div class="row">
                        <div class="col-sm-8">
                        <h2 class="w-title">
                            <a href="<?= base_url('portfolio/' . $p->portfolio_slug); ?>">
                            <?php echo $p->portfolio_judul; ?>
                            </a>
                        </h2>
                        <div class="w-more">
                            <span class="w-ctegory"><?php echo $p->kategori_portfolio_nama; ?></span> /
                            <span class="w-date"><?php echo date('d M Y', strtotime($p->portfolio_tanggal)); ?></span>
                        </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    </div>
                </div>
                </div>
            <?php } ?>
            </div>

            <div class="row">
            <div class="col-12 text-center mt-4 mb-5">
                <a href="<?= base_url('portfolio'); ?>" class="btn btn-primary" style="background-color: #24b67e; border-color: #24b67e;">
                Lihat Semua Portfolio
                </a>
            </div>
            </div>
        </div>
    </section>
    <!--/ Section Portfolio End /-->

    <!-- Client Logo Animation -->
    <style>
    .logo-track {
        display: flex;
        width: max-content;
        animation: scroll-left 20s linear infinite;
    }
    .logo-track.reverse {
        animation: scroll-right 20s linear infinite;
    }
    .logo-wrapper {
        overflow: hidden;
        white-space: nowrap;
        width: 100%;
        padding: 10px 0;
        background: #F5F5F5;
    }
    .logo-track img {
        height: 80px;
        margin: 0 40px;
        filter: grayscale(100%);
        transition: 0.3s;
    }
    .logo-track img:hover {
        filter: none;
        transform: scale(1.1);
    }
    @keyframes scroll-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    @keyframes scroll-right {
        0% { transform: translateX(-50%); }
        100% { transform: translateX(0); }
    }
    </style>

    <!-- Section Logo Client -->
    <div class="container text-center mb-5">
        <?php
        $logo_chunks = array_chunk($logo_client, 8); // 3 baris × 8 logo
        $anim_class = ['','reverse',''];
        foreach ($logo_chunks as $i => $chunk): ?>
            <div class="logo-wrapper">
                <div class="logo-track <?= $anim_class[$i % 3]; ?>">
                    <?php foreach ($chunk as $logo): ?>
                        <img src="<?= base_url('gambar/client/' . $logo->gambar); ?>" alt="<?= htmlspecialchars($logo->nama); ?>">
                    <?php endforeach; ?>
                    <!-- Duplikasi untuk looping seamless -->
                    <?php foreach ($chunk as $logo): ?>
                        <img src="<?= base_url('gambar/client/' . $logo->gambar); ?>" alt="<?= htmlspecialchars($logo->nama); ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!--/ Section Testimonials Start /-->
    <div class="testimonials paralax-mf bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
        <div class="overlay-mf"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="testimonial-mf" class="owl-carousel owl-theme">
                        <?php foreach ($testimonial as $testi) { ?>
                            <div class="testimonial-box">
                                <div class="author-test">
                                    <img src="<?php echo base_url('gambar/testimoni/' . $testi->gambar); ?>"
                                        alt=""
                                        class="rounded-circle b-shadow-a"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                    <span class="author"><?php echo $testi->nama; ?></span>
                                    <div class="mb-2">
                                        <?php
                                        $stars = $testi->rating ?? 5; // default 5 jika null
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $stars) {
                                                echo '<i class="fa fa-star text-warning"></i>'; // Bintang terisi
                                            } else {
                                                echo '<i class="fa fa-star-o text-warning"></i>'; // Bintang kosong
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="content-test">
                                    <p class="description lead"><?php echo $testi->deskripsi; ?></p>
                                    <span class="comit"><i class="fa fa-quote-right"></i></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Tambahkan tombol di bawah carousel -->
            <div class="text-center mt-4" style="position: relative; z-index: 2;">
                <a href="<?= base_url('testimonial'); ?>" class="btn btn-outline-light" style="padding: 8px 20px; font-size: 16px;">
                    Lihat Semua Testimonial
                </a>
            </div>
        </div>
    </div>
    <!--/ Section Testimonials End /-->

    <!--/ Section Blog Start /-->
    <section id="blog" class="blog-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">BERITA</h3>
                        <p class="subtitle-a">Artikel terbaru Dari Kami</p>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($artikel as $a) { ?>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-img">
                            <a href="<?php echo base_url() . $a->artikel_slug; ?>">
                                <?php if ($a->artikel_sampul != '') { ?>
                                    <img src="<?php echo base_url(); ?>gambar/artikel/<?php echo $a->artikel_sampul ?>"
                                    alt="<?php echo $a->artikel_judul ?>"
                                    class="img-fluid w-100"
                                    style="height: 300px; object-fit: cover;">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="card-category-box">
                                <div class="card-category">
                                    <a href="<?php echo base_url() . 'kategori/' . $a->kategori_slug; ?>">
                                        <h6 class="category"><?php echo $a->kategori_nama ?></h6>
                                    </a>
                                </div>
                            </div>
                            <h3 class="card-title">
                                <a href="<?php echo base_url() . $a->artikel_slug; ?>"><?php echo $a->artikel_judul; ?></a>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="post-author">
                                <span class="author"><?php echo $a->pengguna_nama; ?></span>
                            </div>
                            <div class="post-date">
                                <span class="ion-ios-clock-outline"></span> <?php echo date('D-M-Y', strtotime($a->artikel_tanggal)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <!--/ Section Blog End /--> 

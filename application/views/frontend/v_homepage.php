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
    <div class="section-counter paralax-mf bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/counters-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="container">
        <div class="row">
        <?php
        $counters = [
            ['icon' => 'ion-checkmark-round', 'number' => 450, 'label' => 'WORKS COMPLETED'],
            ['icon' => 'ion-ios-calendar-outline', 'number' => 15, 'label' => 'YEARS OF EXPERIENCE'],
            ['icon' => 'ion-ios-people', 'number' => 550, 'label' => 'TOTAL CLIENTS'],
            ['icon' => 'ion-ribbon-a', 'number' => 36, 'label' => 'AWARD WON'],
        ];
        foreach ($counters as $counter) {
        ?>
        <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
                <span class="ico-circle"><i class="<?php echo $counter['icon']; ?>"></i></span>
            </div>
            <div class="counter-num">
                <p class="counter"><?php echo $counter['number']; ?></p>
                <span class="counter-text"><?php echo $counter['label']; ?></span>
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
            <p class="subtitle-a">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            <div class="line-mf"></div>
            </div>
        </div>
        </div>
        <div class="row">
        <?php for ($i = 1; $i <= 6; $i++) { ?>
        <div class="col-md-4">
            <div class="work-box">
                <a href="<?php echo base_url(); ?>assets_frontend/img/web-<?php echo $i; ?>.jpg" data-lightbox="gallery-mf">
                    <div class="work-img">
                        <img src="<?php echo base_url(); ?>assets_frontend/img/web-<?php echo $i; ?>.jpg"
                        alt="" class="img-fluid">
                    </div>
                    <div class="work-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2 class="w-title">Project <?php echo $i; ?></h2>
                                <div class="w-more">
                                    <span class="w-ctegory">Web Design</span> / <span class="w-date">1 Januari 2025</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="w-like">
                                    <span class="ion-ios-plus-outline"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php } ?>
        </div>
    </div>
    </section>
    <!--/ Section Portfolio End /-->

    <!--/ Section Testimonials Start /-->
    <div class="testimonials paralax-mf bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="testimonial-mf" class="owl-carousel owl-theme">
                    <?php
                    $testimonials = [
                        ['img' => 'testimonial-2.jpg', 'name' => 'Arya Penangsang', 'desc' => 'Website yang menarik, dibangun dengan framework CodeIgniter, menggunakan template adminLTE untuk backend dan devfolio untuk frontend'],
                        ['img' => 'testimonial-4.jpg', 'name' => 'Sawunggaling', 'desc' => 'Website yang responsive, menggunakan tampilan yang responsive untuk setiap device interface yang digunakan.']
                    ];
                    foreach ($testimonials as $testi) {
                    ?>
                        <div class="testimonial-box">
                            <div class="author-test">
                                <img src="<?php echo base_url(); ?>assets_frontend/img/<?php echo $testi['img']; ?>" alt="" class="rounded-circle b-shadow-a">
                                <span class="author"><?php echo $testi['name']; ?></span>
                            </div>
                            <div class="content-test">
                                <p class="description lead"><?php echo $testi['desc']; ?></p>
                                <span class="comit"><i class="fa fa-quote-right"></i></span>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
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

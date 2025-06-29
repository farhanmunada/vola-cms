<!--/ Intro Skew Start /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
    <div class="overlay-mf"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">Daftar Layanan</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Layanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!--/ Intro Skew End /-->

<!--/ Section Layanan Start /-->
<section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
        <div class="row">
            <?php if (isset($kategori_nama)) { ?>
                <h2 class="text-center mb-4">Layanan Kategori: <?php echo $kategori_nama; ?></h2>
            <?php } ?>
            <div class="col-md-8">
                <?php if (count($layanan) == 0) { ?>
                    <center class="mt-5">Belum ada layanan yang tersedia</center>
                <?php } ?>

                <?php foreach ($layanan as $l) { ?>
                    <div class="post-box">
                        <div class="post-thumb">
                            <?php if ($l->layanan_gambar != "") { ?>
                                <img src="<?php echo base_url('gambar/layanan/' . $l->layanan_gambar); ?>" class="img-fluid" alt="<?php echo $l->layanan_judul; ?>">
                            <?php } ?>
                        </div>
                        <div class="post-meta">
                            <a href="<?php echo base_url('layanan/' . $l->layanan_slug); ?>">
                                <h1 class="article-title"><?php echo $l->layanan_judul; ?></h1>
                            </a>
                            <ul>
                                <li>
                                    <span class="ion-ios-person"></span>
                                    <a href="#"><?php echo $l->pengguna_nama; ?></a>
                                </li>
                                <li>
                                    <span class="ion-pricetag"></span>
                                    <a href="#"><?php echo $l->kategori_layanan_nama; ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="article-content">
                            <p><?php echo word_limiter(strip_tags($l->layanan_deskripsi), 30); ?></p>
                        </div>
                    </div>
                <?php } ?>

                <nav aria-label="Page navigation">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>
            </div>

            <div class="col-md-4">
                <?php $this->load->view('frontend/v_sidebar_layanan'); ?>
            </div>
        </div>
    </div>
</section>
<!--/ Section Layanan End /-->

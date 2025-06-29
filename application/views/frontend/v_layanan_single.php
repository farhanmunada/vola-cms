<!--/ Intro Skew Start /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Detail Layanan</h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url('layanan'); ?>">Layanan</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Layanan-Single Start /-->
<section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if (count($layanan) == 0) { ?>
                    <center class="mt-5">Layanan Tidak Ditemukan</center>
                <?php } ?>

                <?php foreach ($layanan as $l) { ?>
                    <div class="post-box">
                        <div class="post-thumb">
                            <?php if ($l->layanan_gambar != "") { ?>
                                <img src="<?php echo base_url('gambar/layanan/' . $l->layanan_gambar); ?>" class="img-fluid" alt="<?php echo $l->layanan_judul; ?>">
                            <?php } ?>
                        </div>
                        <div class="post-meta">
                            <h1 class="article-title"><?php echo $l->layanan_judul; ?></h1>
                            <ul>
                                <li>
                                    <span class="ion-ios-person"></span>
                                    <a href="#"><?php echo $l->pengguna_nama; ?></a>
                                </li>
                                <li>
                                    <span class="ion-pricetag"></span>
                                    <a href="#"><?php echo $l->kategori_nama; ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="article-content">
                            <p><?php echo $l->layanan_deskripsi; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-4">
                <?php $this->load->view('frontend/v_sidebar_layanan'); ?>
            </div>
        </div>
    </div>
</section>
<!--/ Section Layanan-Single End /-->

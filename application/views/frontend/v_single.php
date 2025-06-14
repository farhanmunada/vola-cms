<!--/ Intro Skew Start /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Detail Artikel</h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url('blog'); ?>">Berita</a>
                    </li>
                    <li class="breadcrumb-item active">Artikel</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Blog-Single Start /-->
<section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if (count($artikel) == 0) { ?>
                    <center class="mt-5">Artikel Tidak Ditemukan</center>
                <?php } ?>

                <?php foreach ($artikel as $a) { ?>
                    <div class="post-box">
                        <div class="post-thumb">
                            <?php if ($a->artikel_sampul != "") { ?>
                                <img src="<?php echo base_url() . 'gambar/artikel/' . $a->artikel_sampul; ?>" class="img-fluid" alt="<?php echo $a->artikel_judul; ?>">
                            <?php } ?>
                        </div>
                        <div class="post-meta">
                            <h1 class="article-title"><?php echo $a->artikel_judul; ?></h1>
                            <ul>
                                <li>
                                    <span class="ion-ios-person"></span>
                                    <a href="#"><?php echo $a->pengguna_nama; ?></a>
                                </li>
                                <li>
                                    <span class="ion-pricetag"></span>
                                    <a href="#"><?php echo $a->kategori_nama; ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="article-content">
                            <p><?php echo $a->artikel_konten; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
    </div>
</section>
<!--/ Section Blog-Single End /-->

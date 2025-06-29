<!--/ Intro Skew Start /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Daftar Portfolio</h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Portfolio</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Portfolio Start /-->
<section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
        <div class="row">
            <?php if (isset($kategori_nama)) { ?>
                <h2 class="text-center mb-4">Portfolio Kategori: <?php echo $kategori_nama; ?></h2>
            <?php } ?>
            <div class="col-md-8">
                <?php if (count($portfolio) == 0) { ?>
                    <center class="mt-5">Belum ada portfolio yang tersedia</center>
                <?php } ?>

                <?php foreach ($portfolio as $p) { ?>
                    <div class="post-box">
                        <div class="post-thumb">
                            <?php if ($p->portfolio_gambar != "") { ?>
                                <img src="<?php echo base_url('gambar/portfolio/' . $p->portfolio_gambar); ?>" class="img-fluid" alt="<?php echo $p->portfolio_judul; ?>">
                            <?php } ?>
                        </div>
                        <div class="post-meta">
                            <a href="<?php echo base_url('portfolio/' . $p->portfolio_slug); ?>">
                                <h1 class="article-title"><?php echo $p->portfolio_judul; ?></h1>
                            </a>
                            <ul>
                                <li>
                                    <span class="ion-ios-person"></span>
                                    <a href="#"><?php echo $p->pengguna_nama; ?></a>
                                </li>
                                <li>
                                    <span class="ion-pricetag"></span>
                                    <a href="#"><?php echo $p->kategori_portfolio_nama; ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="article-content">
                            <p><?php echo word_limiter(strip_tags($p->portfolio_deskripsi), 30); ?></p>
                        </div>
                    </div>
                <?php } ?>

                <nav aria-label="Page navigation">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>
            </div>

            <div class="col-md-4">
                <?php $this->load->view('frontend/v_sidebar_portfolio'); ?>
            </div>
        </div>
    </div>
</section>
<!--/ Section Portfolio End /-->

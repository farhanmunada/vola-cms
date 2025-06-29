    <!--/ Intro Skew Start /-->
    <div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url();?>assets_frontend/img/hero3.jpg)">
        <div class="overlay-mf"></div>
            <div class="intro-content display-table">
                <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">Halaman</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url();?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Halaman</li>
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
        <div class="col-md-12">
            <?php if (count($halaman) == 0) { ?>
            <center>
                <h3 class="mt-5 mb-5">Halaman tidak Ditemukan</h3>
            </center>
            <?php } ?>
            <?php foreach ($halaman as $h) { ?>
            <div class="post-box">
                <div class="post-meta">
                <center>
                    <h1 class="article-title"><?php echo $h->halaman_judul;?></h1>
                    <hr>
                </center>
                <br><br>
                </div>
                <div class="article-content">
                <?php echo $h->halaman_konten;?>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
    </div>
    </section>
    <!--/ Section Blog-Single End /-->

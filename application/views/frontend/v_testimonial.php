<!--/ Intro Skew Start /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/hero3.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Semua Testimonial</h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Testimonial</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Testimonial Start /-->
<section class="blog-wrapper sect-pt4">
    <div class="container">
        <div class="row">

            <!-- Kolom Utama -->
            <div class="col-md-8">
                <div class="row">
                    <?php if (count($testimonial) == 0) { ?>
                        <div class="col-12 text-center mb-4">
                            <p>Belum ada testimonial yang tersedia.</p>
                        </div>
                    <?php } ?>

                    <?php foreach ($testimonial as $t) { ?>
                        <div class="col-sm-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <img src="<?= base_url('gambar/testimoni/' . $t->gambar); ?>" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="<?= $t->nama; ?>">
                                    <h6 class="card-title font-weight-bold mb-1"><?= $t->nama; ?></h6>
                                    <div class="mb-2" style="color: #ffc107; font-size: 16px;">
                                        <?php for ($i = 1; $i <= 5; $i++) echo ($i <= $t->rating) ? '★' : '☆'; ?>
                                    </div>
                                    <p class="card-text small text-muted"><em><?= character_limiter(strip_tags($t->deskripsi), 120); ?></em></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Sidebar Filter -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Cari Testimonial</h5>
                        <form action="<?= base_url('testimonial'); ?>" method="get">
                            <div class="form-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari nama atau deskripsi..." value="<?= $this->input->get('q'); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Cari</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filter Rating</h5>
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <a href="<?= base_url('testimonial?rating=' . $i); ?>" class="btn btn-outline-secondary btn-sm mb-1 w-100">
                                <?php for ($j = 1; $j <= $i; $j++) echo '★'; ?>
                                <?php for ($j = $i + 1; $j <= 5; $j++) echo '☆'; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--/ Section Testimonial End /-->

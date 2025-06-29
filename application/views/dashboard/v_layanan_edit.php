<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Edit Layanan</b></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo base_url('dashboard/layanan'); ?>">
                    <button class="btn btn-sm btn-success">Kembali</button>
                </a>
                <br><br>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-concierge-bell"></i> Data Layanan <small>Edit Layanan</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <?php foreach ($layanan as $l) { ?>
                        <form method="post" action="<?php echo base_url('dashboard/layanan_update'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-9">
                                    <input type="hidden" name="id" value="<?php echo $l->layanan_id; ?>">

                                    <div class="form-group">
                                        <label>Judul Layanan</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Layanan..." value="<?php echo $l->layanan_judul; ?>">
                                        <br>
                                        <?php echo form_error('judul'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi Layanan</label>
                                        <?php echo form_error('konten'); ?>
                                        <textarea class="form-control" name="konten" id="summernote"><?php echo $l->layanan_deskripsi; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori">
                                            <option value="">-- Pilih Kategori --</option>
                                                <?php foreach ($kategori_layanan as $k) { ?>
                                                    <option <?php if ($l->layanan_kategori == $k->kategori_layanan_id) { echo "selected='selected'"; } ?> value="<?php echo $k->kategori_layanan_id; ?>">
                                                        <?php echo $k->kategori_layanan_nama; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>
                                        <br>
                                        <?php echo form_error('kategori'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="sampul" class="form-control">
                                        <small class="text-muted">Gambar sekarang: <?php echo $l->layanan_gambar; ?></small>
                                        <br>
                                        <?php
                                        if (isset($gambar_error)) {
                                            echo $gambar_error;
                                        }
                                        echo form_error('sampul');
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="status" value="Draft" class="btn btn-sm btn-warning btn-block">
                                        <input type="submit" name="status" value="Publish" class="btn btn-sm btn-success btn-block">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </div>
    </section>
</div>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Tambah Portfolio</b></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo base_url('dashboard/portfolio'); ?>">
                    <button class="btn btn-sm btn-success">Kembali</button>
                </a>
                <br><br>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-concierge-bell"></i> Data Portfolio
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo base_url('dashboard/portfolio_aksi'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label>Judul Portfolio</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Portfolio . . ." value="<?php echo set_value('judul'); ?>">
                                        <br>
                                        <?php echo form_error('judul'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi Portfolio</label>
                                        <?php echo form_error('konten'); ?>
                                        <textarea class="form-control" name="konten" id="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Kategori Portfolio</label>
                                        <select class="form-control" name="kategori_portfolio">
                                            <option value="">-- Pilih Kategori Portfolio --</option>
                                            <?php foreach ($kategori_portfolio as $kp) { ?>
                                                <option <?php if (set_value('kategori_portfolio') == $kp->kategori_portfolio_id) { echo "selected='selected'"; } ?> value="<?php echo $kp->kategori_portfolio_id; ?>">
                                                    <?php echo $kp->kategori_portfolio_nama; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <br>
                                        <?php echo form_error('kategori_portfolio'); ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="sampul" class="form-control">
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
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </div>
    </section>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vola Dev</title>
</head>

<body>
    <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1><b>Tambah Halaman</b></h1>
            </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('dashboard/pages'); ?>">
            <button class="btn btn-sm btn-success">Kembali</button>
            </a>
            <br><br>

            <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                <i class="nav-icon fas fa-copy"></i> Data Halaman <small>Tambah Halaman Baru</small>
                </h3>
            </div>

            <div class="card-body">
                <form method="post" action="<?php echo base_url('dashboard/pages_aksi'); ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label>Judul Halaman</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Halaman . . ." value="<?php echo set_value('judul'); ?>">
                        <br>
                        <?php echo form_error('judul'); ?>
                    </div>

                    <div class="form-group">
                        <label>Konten Halaman</label>
                        <?php echo form_error('konten'); ?>
                        <textarea class="form-control" name="konten" id="summernote"><?php echo set_value('konten'); ?></textarea>
                    </div>
                    </div>

                    <div class="col-lg-12">
                    <div class="form-group">
                        <input type="submit" value="Publish" class="btn btn-sm btn-success btn-block">
                    </div>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
    </div>

</body>
</html>

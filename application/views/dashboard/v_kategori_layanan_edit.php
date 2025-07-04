<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kategori Layanan</title>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>Edit Kategori Layanan</b></h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 connectedSortable">
                    
                        <!-- Tombol Kembali -->
                        <a href="<?= base_url('dashboard/kategori_layanan'); ?>">
                            <button class="btn btn-sm btn-success mb-3">Kembali</button>
                        </a>

                        <!-- Card Edit Kategori -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-th"></i> Kategori Layanan
                                    <small>Update Kategori</small>
                                </h3>
                            </div>

                            <div class="card-body">
                                <?php foreach ($kategori as $k): ?>
                                    <form method="post" action="<?= base_url('dashboard/kategori_layanan_update'); ?>">
                                        <div class="form-group">
                                            <label>Nama Kategori</label>
                                            <input type="hidden" name="id" value="<?= $k->kategori_layanan_id; ?>">
                                            <input type="text" name="kategori" class="form-control" 
                                                placeholder="Masukkan Nama Kategori Layanan..." 
                                                value="<?= $k->kategori_layanan_nama; ?>" required>
                                            <?= form_error('kategori'); ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="Update" class="btn btn-sm btn-primary">
                                        </div>
                                    </form>
                                <?php endforeach; ?>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->

                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

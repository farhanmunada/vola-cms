    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>Tambah Kategori Portfolio</b></h1>
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
                        <a href="<?= base_url('dashboard/kategori_portfolio'); ?>">
                            <button class="btn btn-sm btn-success mb-3">Kembali</button>
                        </a>

                        <!-- Form Tambah Kategori Portfolio -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-th"></i> Kategori Portfolio
                                    <small>Tambah Kategori Baru</small>
                                </h3>
                            </div>

                            <div class="card-body">
                                <form method="post" action="<?= base_url('dashboard/kategori_portfolio_tambah_aksi'); ?>">
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="kategori" class="form-control" placeholder="Masukkan Nama Kategori Portfolio..." required>
                                        <?= form_error('kategori'); ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                                    </div>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->

                    </div>
                </div>
            </div>
        </section>
    </div>

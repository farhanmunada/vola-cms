    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>Data Kategori Portfolio</b></h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- Card Header -->
                            <div class="card-header">
                                <a href="<?= base_url('dashboard/kategori_portfolio_tambah'); ?>">
                                    <button class="btn btn-sm btn-success">
                                        Buat Kategori Portfolio Baru <i class="fas fa-plus"></i>
                                    </button>
                                </a>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Kategori</th>
                                            <th>Slug Kategori</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $no = 1; foreach ($kategori as $k) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $k->kategori_portfolio_nama; ?></td>
                                            <td><?= $k->kategori_portfolio_slug; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('dashboard/kategori_portfolio_edit/' . $k->kategori_portfolio_id); ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <a href="<?= base_url('dashboard/kategori_portfolio_hapus/' . $k->kategori_portfolio_id); ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> <!-- /.card-body -->

                        </div> <!-- /.card -->
                    </div> <!-- /.col-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container-fluid -->
        </section>
    </div>

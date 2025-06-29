<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Data Portfolio</b></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-file"></i> Data Portfolio
                            </h3>
                        </div>

                        <div class="card-body">
                            <a href="<?= base_url('dashboard/portfolio_tambah'); ?>">
                                <button class="btn btn-sm btn-success mb-3">
                                    Tambah Portfolio Baru <i class="fas fa-plus"></i>
                                </button>
                            </a>

                            <table class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Tanggal</th>
                                        <th>Judul Portfolio</th>
                                        <th>Penulis</th>
                                        <th>Kategori</th>
                                        <th width="10%">Gambar</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($portfolio as $a) :
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= date('d/m/y H:i', strtotime($a->portfolio_tanggal)); ?></td>
                                        <td>
                                            <?= $a->portfolio_judul; ?><br>
                                            <small class="text-muted"><?= base_url($a->portfolio_slug); ?></small>
                                        </td>
                                        <td><?= $a->pengguna_nama; ?></td>
                                        <td><?= $a->kategori_portfolio_nama; ?></td>
                                        <td>
                                            <?php if (!empty($a->portfolio_gambar)) : ?>
                                                <img width="100%" class="img-responsive" src="<?= base_url('gambar/portfolio/' . $a->portfolio_gambar); ?>" alt="Gambar Portfolio">
                                            <?php else : ?>
                                                <span class="text-muted">Tidak ada gambar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($a->portfolio_status == "publish") : ?>
                                                <span class="badge badge-success">Publish</span>
                                            <?php else : ?>
                                                <span class="badge badge-secondary">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a target="_blank" href="<?= base_url('portfolio/' .$a->portfolio_slug); ?>" class="btn btn-sm btn-success">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <?php if ($this->session->userdata('level') == 'penulis') : ?>
                                                <?php if ($this->session->userdata('id') == $a->portfolio_author) : ?>
                                                    <a href="<?= base_url('dashboard/portfolio_edit/' . $a->portfolio_id); ?>" class="btn btn-sm btn-warning">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('dashboard/portfolio_hapus/' . $a->portfolio_id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus Data Ini?')">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <a href="<?= base_url('dashboard/portfolio_edit/' . $a->portfolio_id); ?>" class="btn btn-sm btn-warning">
                                                    <i class="nav-icon fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('dashboard/portfolio_hapus/' . $a->portfolio_id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus Data Ini?')">
                                                    <i class="nav-icon fas fa-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div><!-- /.content-wrapper -->

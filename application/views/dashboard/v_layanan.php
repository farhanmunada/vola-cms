<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Data Layanan</b></h1>
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
                                <i class="fas fa-concierge-bell"></i> Data Layanan
                            </h3>
                        </div>

                        <div class="card-body">
                            <a href="<?php echo base_url('dashboard/layanan_tambah'); ?>">
                                <button class="btn btn-sm btn-success">
                                    Tambah Layanan Baru <i class="fas fa-plus"></i>
                                </button>
                            </a>
                            <hr>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Tanggal</th>
                                        <th>Judul Layanan</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th width="10%">Gambar</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($layanan as $l) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($l->layanan_tanggal)); ?></td>
                                        <td>
                                            <?php echo $l->layanan_judul; ?>
                                            <br>
                                            <small class="hidden"><?php echo base_url() . $l->layanan_slug; ?></small>
                                        </td>
                                        <td><?php echo word_limiter(strip_tags($l->layanan_deskripsi), 15); ?></td>
                                        <td><?php echo $l->kategori_layanan_nama; ?></td>
                                        <td>
                                            <img width="100%" class="img-responsive" src="<?php echo base_url('gambar/layanan/' . $l->layanan_gambar); ?>" alt="Gambar Layanan">
                                        </td>
                                        <td>
                                            <?php
                                            if ($l->layanan_status == "publish") {
                                                echo "<span class='label label-success'>Publish</span>";
                                            } else {
                                                echo "<span class='label label-danger'>Draft</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a target="_blank" href="<?php echo base_url() . $l->layanan_slug; ?>">
                                                <button class="btn btn-sm btn-success">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>

                                            <?php if ($this->session->userdata('level') == 'penulis') {
                                                if ($this->session->userdata('id') == $l->layanan_author) {
                                            ?>
                                                    <a href="<?php echo base_url('dashboard/layanan_edit/' . $l->layanan_id); ?>">
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="<?php echo base_url('dashboard/layanan_hapus/' . $l->layanan_id); ?>">
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus Data Ini ?')">
                                                            <i class="nav-icon fas fa-trash"></i>
                                                        </button>
                                                    </a>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <a href="<?php echo base_url('dashboard/layanan_edit/' . $l->layanan_id); ?>">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="<?php echo base_url('dashboard/layanan_hapus/' . $l->layanan_id); ?>">
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus Data Ini ?')">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

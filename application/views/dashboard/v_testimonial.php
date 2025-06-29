<div class="content-wrapper">
    <section class="content-header">
        <h1><b>Data Testimonial</b></h1>
    </section>

    <section class="content">
        <a href="<?php echo base_url('dashboard/testimonial_tambah'); ?>" class="btn btn-success mb-3">Tambah Testimonial</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Rating</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($testimonial as $t) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $t->nama; ?></td>
                    <td><?= word_limiter($t->deskripsi, 20); ?></td>
                    <td>
                        <?php if ($t->gambar) { ?>
                            <img src="<?= base_url('gambar/testimoni/' . $t->gambar); ?>" width="100">
                        <?php } else { echo 'Tidak ada'; } ?>
                    </td>
                    <td>
                        <?php for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $t->rating ? '<i class="fa fa-star text-warning"></i>' : '<i class="fa fa-star-o text-muted"></i>';
                        } ?>
                    </td>
                    <td>
                        <a href="<?= base_url('dashboard/testimonial_edit/' . $t->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('dashboard/testimonial_hapus/' . $t->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</div>

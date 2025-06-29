<div class="content-wrapper">
    <section class="content-header">
        <h1><b>Edit Testimonial</b></h1>
    </section>

    <section class="content">
        <!-- Tombol kembali di atas -->
        <a href="<?= base_url('dashboard/testimonial'); ?>" class="btn btn-secondary mb-3">Kembali ke Testimonial</a>

        <div class="card card-primary">
            <div class="card-body">
                <form method="post" action="<?= base_url('dashboard/testimonial_update'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $t->id; ?>">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $t->nama; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="5" required><?= $t->deskripsi; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Saat Ini</label><br>
                        <?php if ($t->gambar) { ?>
                            <img src="<?= base_url('gambar/testimoni/' . $t->gambar); ?>" width="100">
                        <?php } else { echo 'Tidak ada gambar'; } ?>
                    </div>

                    <div class="form-group">
                        <label>Ganti Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Rating</label>
                        <select name="rating" class="form-control" required>
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <option value="<?= $i; ?>" <?= (isset($t) && $t->rating == $i) ? 'selected' : ''; ?>>
                                    <?= $i; ?> Bintang
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('dashboard/testimonial'); ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>

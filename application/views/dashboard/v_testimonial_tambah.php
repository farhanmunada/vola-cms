<div class="content-wrapper">
    <section class="content-header">
        <h1><b>Tambah Testimonial</b></h1>
    </section>

    <section class="content">
        <!-- Tombol kembali di atas -->
        <a href="<?= base_url('dashboard/testimonial'); ?>" class="btn btn-secondary mb-3">Kembali ke Testimonial</a>

        <form method="post" action="<?= base_url('dashboard/testimonial_simpan'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label>Gambar</label>
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
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('dashboard/testimonial'); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </section>
</div>

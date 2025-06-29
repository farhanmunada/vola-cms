<div class="content-wrapper">
    <section class="content-header">
        <h1><b>Tambah Logo Client</b></h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('dashboard/client_logo_aksi'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Client</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Logo</label>
                        <input type="file" name="gambar" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('dashboard/client_logo'); ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>

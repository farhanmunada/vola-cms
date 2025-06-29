<div class="content-wrapper">
    <section class="content-header">
        <h1><b>Logo Client</b></h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <a href="<?= base_url('dashboard/client_logo_tambah'); ?>" class="btn btn-success mb-3">Tambah Logo</a>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($client_logo as $logo): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($logo->nama); ?></td>
                            <td>
                                <img src="<?= base_url('gambar/client/'.$logo->gambar); ?>" width="100">
                            </td>
                            <td>
                                <a href="<?= base_url('dashboard/client_logo_hapus/'.$logo->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus logo ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($client_logo)) echo '<tr><td colspan="4" class="text-center">Belum ada logo</td></tr>'; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="content-wrapper">
    <section class="content-header">
        <h1><b>Data Kontak</b></h1>
    </section>

    <section class="content">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-envelope"></i> Pesan Masuk
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kontak as $k): ?>
                            <tr>
                                <td><?= htmlspecialchars($k->nama); ?></td>
                                <td><?= htmlspecialchars($k->email); ?></td>
                                <td><?= htmlspecialchars($k->subjek); ?></td>
                                <td><?= nl2br(htmlspecialchars($k->pesan)); ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($k->tanggal)); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

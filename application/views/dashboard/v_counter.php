<!-- Awal konten utama -->
<div class="content-wrapper">
    <?php if ($this->session->flashdata('update_success')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: '<?php echo $this->session->flashdata('update_success'); ?>',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>
    <section class="content-header">
        <div class="container-fluid">
            <h3><b>Manajemen Data Counter Statistik</b></h3>
            <p class="text-muted">Silakan update angka atau icon sesuai kebutuhan. Label bersifat tetap.</p>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($counter as $c) { ?>
                <div class="col-md-6 col-lg-4">
                    <form action="<?php echo base_url('dashboard/update_counter'); ?>" method="post" class="border p-3 rounded mb-4 shadow-sm bg-white">
                        <input type="hidden" name="id" value="<?php echo $c->id; ?>">

                        <div class="form-group mb-2">
                            <label>Label</label>
                            <input type="text" class="form-control" name="label" value="<?php echo $c->label; ?>" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label>Icon (class Ionicons)</label>
                            <input type="text" class="form-control" name="icon" value="<?php echo $c->icon; ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label>Number</label>
                            <input type="number" class="form-control" name="number" value="<?php echo $c->number; ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>
<!-- Akhir konten utama -->

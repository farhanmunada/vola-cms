<!-- Sidebar: Search Layanan -->
<div class="widget-sidebar sidebar-search">
    <h5 class="sidebar-title">Search Layanan</h5>
    <div class="sidebar-content">
        <?php echo form_open(base_url('layanan/search')); ?>
            <div class="input-group">
                <input type="text" name="cari" class="form-control" placeholder="Cari layanan..." aria-label="Cari layanan...">
                <span class="input-group-btn">
                    <button class="btn btn-secondary btn-search" type="submit">
                        <span class="ion-android-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>

<!-- Sidebar: Kategori Layanan -->
<div class="widget-sidebar widget-tags">
    <h5 class="sidebar-title">Kategori Layanan</h5>
    <div class="sidebar-content">
        <ul class="list-inline">
            <?php
            $kategori = $this->db->query("SELECT * FROM kategori_layanan ORDER BY kategori_layanan_nama ASC")->result();
            foreach ($kategori as $k) {
            ?>
                <li class="list-inline-item" style="margin-bottom:5px;">
                    <a href="<?php echo base_url('layanan/kategori/' . $k->kategori_layanan_slug); ?>" class="btn btn-sm btn-outline-green kategori-btn">
                        <?= htmlspecialchars($k->kategori_layanan_nama); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<!-- Sidebar: Layanan Terbaru -->
<div class="widget-sidebar">
    <h5 class="sidebar-title">Layanan Terbaru</h5>
    <div class="sidebar-content">
        <ul class="list-sidebar">
            <?php
            $layanan = $this->db->query("SELECT * FROM layanan ORDER BY layanan_id DESC LIMIT 5")->result();
            foreach ($layanan as $l) {
            ?>
                <li>
                    <a href="<?php echo base_url('layanan/' . $l->layanan_slug); ?>">
                        <?= word_limiter(htmlspecialchars($l->layanan_judul), 6); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

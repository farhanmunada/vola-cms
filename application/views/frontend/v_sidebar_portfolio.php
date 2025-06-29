<!-- Sidebar: Search Portfolio -->
<div class="widget-sidebar sidebar-search">
    <h5 class="sidebar-title">Search Portfolio</h5>
    <div class="sidebar-content">
        <?php echo form_open(base_url('portfolio/search')); ?>
            <div class="input-group">
                <input type="text" name="cari" class="form-control" placeholder="Cari portfolio..." aria-label="Cari portfolio...">
                <span class="input-group-btn">
                    <button class="btn btn-secondary btn-search" type="submit">
                        <span class="ion-android-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>

<!-- Sidebar: Kategori Portfolio -->
<div class="widget-sidebar widget-tags">
    <h5 class="sidebar-title">Kategori Portfolio</h5>
    <div class="sidebar-content">
        <ul class="list-inline">
            <?php
            $kategori = $this->db->query("SELECT * FROM kategori_portfolio ORDER BY kategori_portfolio_nama ASC")->result();
            foreach ($kategori as $k) {
            ?>
                <li class="list-inline-item" style="margin-bottom:5px;">
                    <a href="<?php echo base_url('portfolio/kategori/' . $k->kategori_portfolio_slug); ?>" class="btn btn-sm btn-outline-green kategori-btn">
                        <?= htmlspecialchars($k->kategori_portfolio_nama); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<!-- Sidebar: Portfolio Terbaru -->
<div class="widget-sidebar">
    <h5 class="sidebar-title">Portfolio Terbaru</h5>
    <div class="sidebar-content">
        <ul class="list-sidebar">
            <?php
            $portfolio = $this->db->query("SELECT * FROM portfolio WHERE portfolio_status = 'publish' ORDER BY portfolio_id DESC LIMIT 5")->result();
            foreach ($portfolio as $p) {
            ?>
                <li>
                    <a href="<?php echo base_url('portfolio/' . $p->portfolio_slug); ?>">
                        <?= word_limiter(htmlspecialchars($p->portfolio_judul), 6); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

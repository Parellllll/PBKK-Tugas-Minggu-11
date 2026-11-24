<?= $this->extend('layouts/storefront') ?>

<?= $this->section('content') ?>
<section class="hero-storefront p-4 p-lg-5 mb-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 mb-3">ShopEase Online Store · Modul Autentikasi CI 4</span>
            <h1 class="display-6 fw-bold mb-3">
                <?php if (session()->get('isLoggedIn')): ?>
                    Halo, <?= esc(session()->get('name')) ?>! Selamat berbelanja di ShopEase.
                <?php else: ?>
                    Toko Online Modern dengan Proteksi Akses Berbasis Role.
                <?php endif; ?>
            </h1>
            <p class="opacity-75 mb-4">
                Coba akses halaman terproteksi <code>/keranjang</code> sebagai tamu untuk menguji fitur <strong>intended redirect</strong>, atau masuk sebagai Admin/Operator untuk membuka panel manajemen ber-sidebar.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('keranjang') ?>" class="btn btn-light text-se-purple fw-bold px-4 py-2 rounded-3">Buka Keranjang (/keranjang)</a>
                <?php if (!session()->get('isLoggedIn')): ?>
                    <a href="<?= base_url('register') ?>" class="btn btn-outline-light fw-semibold px-4 py-2 rounded-3">Daftar Akun</a>
                <?php else: ?>
                    <a href="<?= base_url('profil') ?>" class="btn btn-outline-light fw-semibold px-4 py-2 rounded-3">Kelola Profil Saya</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="p-4 rounded-4" style="background:rgba(15,23,42,.35); border:1px solid rgba(255,255,255,.16);">
                <div class="small fw-bold text-uppercase mb-2" style="color:#ddd6fe;">Status Sesi Aktif</div>
                <?php if (session()->get('isLoggedIn')): ?>
                    <ul class="list-unstyled small mb-0 d-grid gap-1">
                        <li><strong>Status:</strong> Terautentikasi (<code>isLoggedIn = true</code>)</li>
                        <li><strong>ID User:</strong> #<?= (int) session()->get('id_user') ?></li>
                        <li><strong>Email:</strong> <?= esc(session()->get('email')) ?></li>
                        <li><strong>Role:</strong> <span class="badge bg-light text-dark"><?= esc(session()->get('role')) ?></span></li>
                    </ul>
                <?php else: ?>
                    <p class="small opacity-75 mb-2">Anda sedang menjelajah sebagai <strong>Tamu (Guest)</strong>.</p>
                    <p class="small mb-0">Halaman <code>/profil</code>, <code>/keranjang</code>, <code>/admin</code>, dan <code>/operator</code> dilindungi <code>AuthFilter</code>.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<h2 class="h4 fw-bold mb-3">Produk Unggulan ShopEase</h2>
<div class="row g-4">
    <?php foreach ($products as $p): ?>
        <div class="col-md-6 col-lg-3">
            <div class="se-card h-100 overflow-hidden d-flex flex-column">
                <div class="p-4 text-white" style="background:linear-gradient(135deg, <?= esc($p['accent']) ?>, #1e1b4b); min-height:110px;">
                    <span class="badge bg-white bg-opacity-25"><?= esc($p['cat']) ?></span>
                    <div class="small opacity-75 mt-3">Stok: <?= (int) $p['stock'] ?> unit</div>
                </div>
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <h3 class="h6 fw-bold mb-1"><?= esc($p['name']) ?></h3>
                    <div class="fw-bold text-se-purple mb-3">Rp <?= number_format($p['price'], 0, ',', '.') ?></div>
                    <a href="<?= base_url('keranjang') ?>" class="btn btn-se-primary btn-sm mt-auto">Tambah ke Keranjang</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>


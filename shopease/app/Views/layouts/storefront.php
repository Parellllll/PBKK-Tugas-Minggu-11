<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'ShopEase Online Store') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/shopease.css') ?>" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="<?= base_url('/') ?>">
            <span class="se-brand-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </span>
            <span>ShopEase</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storeNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="storeNav">
            <ul class="navbar-nav me-auto ms-lg-4 gap-1">
                <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url('keranjang') ?>">Keranjang</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url('pesanan') ?>">Pesanan</a></li>
                <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link fw-semibold text-se-purple" href="<?= base_url('admin') ?>">Panel Admin</a></li>
                <?php endif; ?>
                <?php if (in_array(session()->get('role'), ['admin', 'operator'], true)): ?>
                    <li class="nav-item"><a class="nav-link fw-semibold text-se-purple" href="<?= base_url('operator') ?>">Panel Operator</a></li>
                <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <?php if (session()->get('isLoggedIn')): ?>
                    <a href="<?= base_url('profil') ?>" class="btn btn-light border rounded-3 btn-sm px-3 fw-semibold">
                        <?= esc(session()->get('name')) ?>
                        <span class="badge ms-1 role-badge-<?= esc(session()->get('role')) ?>"><?= esc(session()->get('role')) ?></span>
                    </a>
                    <form method="post" action="<?= base_url('logout') ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3 fw-semibold">Keluar</button>
                    </form>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary btn-sm rounded-3 px-3 fw-semibold">Masuk</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-se-primary btn-sm px-3">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<main class="py-4 py-md-5 flex-grow-1">
    <div class="container">
        <?= $this->include('partials/alerts') ?>
        <?= $this->renderSection('content') ?>
    </div>
</main>

<footer class="bg-dark text-secondary py-4 mt-auto small">
    <div class="container d-flex flex-wrap justify-content-between gap-2">
        <div><strong class="text-white">ShopEase Online Store</strong> — Tugas Minggu 11 PBKK (Authentication System CI 4.7.6)</div>
        <div>Farrel Prastita Ramadhan (5025241219) · Teknik Informatika ITS</div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


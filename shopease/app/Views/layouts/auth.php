<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Autentikasi — ShopEase') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/shopease.css') ?>" rel="stylesheet">
</head>
<body>
<div class="auth-wrapper">
    <section class="auth-brand-panel">
        <div>
            <a href="<?= base_url('/') ?>" class="d-inline-flex align-items-center gap-2 text-white text-decoration-none mb-5">
                <span class="se-brand-icon" style="background:rgba(255,255,255,.18); box-shadow:none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </span>
                <span class="fs-4 fw-bold">ShopEase</span>
            </a>
            <span class="badge rounded-pill bg-white bg-opacity-25 px-3 py-2 mb-3">Authentication System · CodeIgniter 4.7.6</span>
            <h1 class="display-6 fw-bold mb-3">Belanja aman dengan autentikasi modern berbasis peran.</h1>
            <p class="opacity-75 mb-4">Modul autentikasi lengkap: password hashing bcrypt, session regeneration, AuthFilter &amp; GuestFilter, anti brute force Throttler, serta Remember Me 30 hari dengan rotasi token SHA-256.</p>
        </div>

        <div class="d-grid gap-3">
            <div class="auth-feature-pill">
                <div class="fw-bold small">Role-Based Access Control (RBAC)</div>
                <div class="small opacity-75">Pemisahan hak akses Customer, Operator Toko, dan Administrator melalui <code>AuthFilter</code>.</div>
            </div>
            <div class="auth-feature-pill">
                <div class="fw-bold small">Keamanan Kredensial &amp; CSRF</div>
                <div class="small opacity-75">Seluruh form dilindungi token CSRF dan batas 5 percobaan login/menit.</div>
            </div>
            <div class="small opacity-50 pt-2">
                PBKK Minggu 11 · Farrel Prastita Ramadhan (5025241219) · Teknik Informatika ITS
            </div>
        </div>
    </section>

    <section class="auth-form-panel">
        <div class="auth-form-box">
            <?= $this->include('partials/alerts') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


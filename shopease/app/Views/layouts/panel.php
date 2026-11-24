<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Panel ShopEase') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/shopease.css') ?>" rel="stylesheet">
</head>
<body>
<div class="panel-shell">
    <aside class="panel-sidebar">
        <a href="<?= base_url('/') ?>" class="d-flex align-items-center gap-2 text-white text-decoration-none mb-4 px-2">
            <span class="se-brand-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </span>
            <div>
                <div class="fw-bold lh-1">ShopEase</div>
                <small class="text-secondary" style="font-size:11px;">Role: <?= esc(strtoupper((string) session()->get('role'))) ?></small>
            </div>
        </a>

        <nav class="panel-nav flex-grow-1">
            <?php if (session()->get('role') === 'admin'): ?>
                <div class="text-uppercase text-secondary fw-bold px-2 mb-2" style="font-size:11px;">Administrator</div>
                <a href="<?= base_url('admin') ?>" class="<?= ($activeNav ?? '') === 'dashboard' ? 'active' : '' ?>">Dashboard Admin</a>
                <a href="<?= base_url('admin/users') ?>" class="<?= ($activeNav ?? '') === 'users' ? 'active' : '' ?>">Kelola User &amp; Role</a>
            <?php endif; ?>

            <div class="text-uppercase text-secondary fw-bold px-2 mt-3 mb-2" style="font-size:11px;">Operasional</div>
            <a href="<?= base_url('operator') ?>" class="<?= ($activeNav ?? '') === 'operator' ? 'active' : '' ?>">Dashboard Operator</a>

            <div class="text-uppercase text-secondary fw-bold px-2 mt-3 mb-2" style="font-size:11px;">Akun &amp; Toko</div>
            <a href="<?= base_url('profil') ?>">Profil Saya</a>
            <a href="<?= base_url('/') ?>">Lihat Storefront</a>
        </nav>

        <div class="border-top border-secondary border-opacity-25 pt-3 mt-3">
            <div class="small text-white fw-semibold px-2"><?= esc(session()->get('name')) ?></div>
            <div class="small text-secondary px-2 mb-3 text-truncate"><?= esc(session()->get('email')) ?></div>
            <form method="post" action="<?= base_url('logout') ?>">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline-light btn-sm w-100 rounded-3">Keluar</button>
            </form>
        </div>
    </aside>

    <main class="panel-main">
        <?= $this->include('partials/alerts') ?>
        <?= $this->renderSection('content') ?>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>


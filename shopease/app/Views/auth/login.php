<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h2 class="h3 fw-bold mb-1">Masuk ke ShopEase</h2>
    <p class="text-muted small mb-0">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-se-purple fw-semibold text-decoration-none">Daftar sebagai Customer</a></p>
</div>

<form method="post" action="<?= base_url('login') ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label class="form-label fw-semibold small" for="email">Alamat Email</label>
        <input type="email" class="form-control form-control-lg fs-6 rounded-3" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="nama@shopease.local" required autofocus>
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold small" for="password">Kata Sandi</label>
        <input type="password" class="form-control form-control-lg fs-6 rounded-3" id="password" name="password" placeholder="Masukkan kata sandi" required>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
            <label class="form-check-label small text-secondary" for="remember">Ingat saya selama 30 hari</label>
        </div>
        <span class="small text-muted">Maks. 5 percobaan/menit</span>
    </div>
    <button type="submit" class="btn btn-se-primary w-100 py-2 fs-6">Masuk</button>
</form>

<div class="mt-4 p-3 rounded-3 bg-light border small">
    <div class="fw-bold text-dark mb-2">Akun Demo Siap Uji (Seeder):</div>
    <div class="d-grid gap-1 text-secondary">
        <div><strong>Admin:</strong> <code>admin@shopease.local</code> / <code>Admin123!</code></div>
        <div><strong>Operator:</strong> <code>operator@shopease.local</code> / <code>Operator123!</code></div>
        <div><strong>Customer:</strong> <code>customer@shopease.local</code> / <code>Customer123!</code></div>
    </div>
</div>
<?= $this->endSection() ?>


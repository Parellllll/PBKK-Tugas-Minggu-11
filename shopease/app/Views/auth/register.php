<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h2 class="h3 fw-bold mb-1">Buat Akun Customer</h2>
    <p class="text-muted small mb-0">Sudah terdaftar? <a href="<?= base_url('login') ?>" class="text-se-purple fw-semibold text-decoration-none">Masuk di sini</a></p>
</div>

<form method="post" action="<?= base_url('register') ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label class="form-label fw-semibold small" for="name">Nama Lengkap</label>
        <input type="text" class="form-control rounded-3" id="name" name="name" value="<?= esc(old('name')) ?>" placeholder="Contoh: Farrel Prastita Ramadhan" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold small" for="email">Alamat Email</label>
        <input type="email" class="form-control rounded-3" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="farrel.baru@shopease.local" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold small" for="phone">Nomor Telepon (Opsional)</label>
        <input type="text" class="form-control rounded-3" id="phone" name="phone" value="<?= esc(old('phone')) ?>" placeholder="0812-xxxx-xxxx">
    </div>
    <div class="row g-2 mb-4">
        <div class="col-md-6">
            <label class="form-label fw-semibold small" for="password">Kata Sandi</label>
            <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="Min. 8 karakter" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold small" for="password_confirm">Ulangi Kata Sandi</label>
            <input type="password" class="form-control rounded-3" id="password_confirm" name="password_confirm" placeholder="Konfirmasi sandi" required>
        </div>
    </div>
    <button type="submit" class="btn btn-se-primary w-100 py-2 fs-6">Daftar Sekarang</button>
</form>

<p class="text-muted small mt-3 mb-0">
    Akun baru otomatis diberi peran <code>customer</code> dan kata sandi disimpan dalam bentuk hash <code>PASSWORD_BCRYPT</code>.
</p>
<?= $this->endSection() ?>


<?= $this->extend('layouts/storefront') ?>

<?= $this->section('content') ?>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="se-card p-4 h-100">
            <span class="badge role-badge-<?= esc($user['role']) ?> mb-2">Role: <?= esc(strtoupper($user['role'])) ?></span>
            <h1 class="h4 fw-bold mb-1">Profil Saya</h1>
            <p class="text-muted small mb-4">Perbarui nama lengkap, nomor telepon, dan alamat pengiriman Anda.</p>

            <form method="post" action="<?= base_url('profil/update') ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email (Terkunci)</label>
                    <input type="email" class="form-control bg-light" value="<?= esc($user['email']) ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold" for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= esc(old('name', $user['name'])) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold" for="phone">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= esc(old('phone', $user['phone'] ?? '')) ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold" for="address">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3"><?= esc(old('address', $user['address'] ?? '')) ?></textarea>
                </div>
                <button type="submit" class="btn btn-se-primary px-4">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="se-card p-4 h-100">
            <h2 class="h4 fw-bold mb-1">Ganti Kata Sandi</h2>
            <p class="text-muted small mb-4">Wajib memasukkan kata sandi lama. Mengganti kata sandi otomatis mencabut seluruh token Remember Me aktif.</p>

            <form method="post" action="<?= base_url('profil/password') ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label small fw-semibold" for="current_password">Kata Sandi Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold" for="new_password">Kata Sandi Baru (Min. 8 karakter)</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold" for="confirm_password">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-dark rounded-3 px-4 fw-semibold">Perbarui Kata Sandi</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


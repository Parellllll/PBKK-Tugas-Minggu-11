<?= $this->extend('layouts/panel') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Kelola User &amp; Role</h1>
        <p class="text-muted small mb-0">Cari pengguna, tambah akun staf/customer, ubah peran, atau hapus akun. Admin tidak dapat mengubah/menghapus akunnya sendiri.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="se-card p-4">
            <form method="get" action="<?= base_url('admin/users') ?>" class="row g-2 mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-sm" name="q" value="<?= esc($q) ?>" placeholder="Cari nama atau email...">
                </div>
                <div class="col-md-4">
                    <select name="role" class="form-select form-select-sm">
                        <option value="">Semua Role</option>
                        <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="operator" <?= $role === 'operator' ? 'selected' : '' ?>>Operator</option>
                        <option value="customer" <?= $role === 'customer' ? 'selected' : '' ?>>Customer</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-se-primary btn-sm w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Pengguna</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): $isSelf = ((int) $u['id_user'] === (int) $selfId); ?>
                            <tr>
                                <td class="text-muted small">#<?= (int) $u['id_user'] ?></td>
                                <td>
                                    <div class="fw-semibold small"><?= esc($u['name']) ?> <?= $isSelf ? '<span class="badge bg-dark">Anda</span>' : '' ?></div>
                                    <div class="text-muted" style="font-size:12px;"><?= esc($u['email']) ?></div>
                                </td>
                                <td>
                                    <?php if ($isSelf): ?>
                                        <span class="badge role-badge-<?= esc($u['role']) ?>"><?= esc($u['role']) ?></span>
                                    <?php else: ?>
                                        <form method="post" action="<?= base_url('admin/users/' . $u['id_user'] . '/role') ?>" class="d-flex gap-1">
                                            <?= csrf_field() ?>
                                            <select name="role" class="form-select form-select-sm" style="width:110px;">
                                                <?php foreach (['customer', 'operator', 'admin'] as $r): ?>
                                                    <option value="<?= $r ?>" <?= $u['role'] === $r ? 'selected' : '' ?>><?= $r ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Ubah</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge <?= (int) $u['is_active'] === 1 ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' ?>">
                                        <?= (int) $u['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <?php if ($isSelf): ?>
                                        <span class="text-muted small">Dilindungi</span>
                                    <?php else: ?>
                                        <form method="post" action="<?= base_url('admin/users/' . $u['id_user'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="se-card p-4">
            <h2 class="h6 fw-bold mb-3">Tambah Akun Baru</h2>
            <form method="post" action="<?= base_url('admin/users/store') ?>">
                <?= csrf_field() ?>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control form-control-sm" required placeholder="Contoh: Hendra Operator">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" required placeholder="hendra@shopease.local">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Kata Sandi</label>
                    <input type="password" name="password" class="form-control form-control-sm" required placeholder="Min. 8 karakter">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Telepon</label>
                    <input type="text" name="phone" class="form-control form-control-sm" placeholder="0812-xxxx-xxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Peran (Role)</label>
                    <select name="role" class="form-select form-select-sm" required>
                        <option value="operator">Operator</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-se-primary btn-sm w-100 py-2">Simpan Akun</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


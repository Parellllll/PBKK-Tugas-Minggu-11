<?= $this->extend('layouts/panel') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <span class="badge role-badge-operator mb-2">Filter Akses: auth:operator,admin</span>
    <h1 class="h3 fw-bold mb-1">Dashboard Operator Toko</h1>
    <p class="text-muted small mb-0">Ruang kerja pemenuhan pesanan dan pengiriman untuk peran Operator dan Administrator.</p>
</div>

<div class="se-card p-4">
    <h2 class="h6 fw-bold mb-3">Antrean Pemenuhan Pesanan (Siap Terintegrasi Modul M4)</h2>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr><th>No. Pesanan</th><th>Pelanggan</th><th>Jumlah Item</th><th>Kurir</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php foreach ($queue as $q): ?>
                    <tr>
                        <td><code><?= esc($q['order']) ?></code></td>
                        <td class="fw-semibold"><?= esc($q['customer']) ?></td>
                        <td><?= (int) $q['items'] ?> item</td>
                        <td><?= esc($q['courier']) ?></td>
                        <td><span class="badge bg-warning-subtle text-warning-emphasis"><?= esc($q['status']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>


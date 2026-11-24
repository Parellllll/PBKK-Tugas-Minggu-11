<?= $this->extend('layouts/storefront') ?>

<?= $this->section('content') ?>
<div class="se-card p-4">
    <h1 class="h4 fw-bold mb-3">Riwayat Pesanan Saya</h1>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr><th>No. Order</th><th>Tanggal</th><th>Total</th><th>Pembayaran</th><th>Status Pesanan</th></tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): ?>
                    <tr>
                        <td><code><?= esc($o['no']) ?></code></td>
                        <td><?= esc($o['date']) ?></td>
                        <td class="fw-semibold">Rp <?= number_format($o['total'], 0, ',', '.') ?></td>
                        <td><span class="badge bg-success-subtle text-success"><?= esc($o['payment']) ?></span></td>
                        <td><span class="badge bg-primary-subtle text-primary"><?= esc($o['status']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>


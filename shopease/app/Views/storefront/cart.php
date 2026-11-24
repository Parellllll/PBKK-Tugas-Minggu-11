<?= $this->extend('layouts/storefront') ?>

<?= $this->section('content') ?>
<div class="se-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div>
            <span class="badge bg-primary-subtle text-primary mb-1">Route Terproteksi: AuthFilter</span>
            <h1 class="h4 fw-bold mb-0">Keranjang Belanja — <?= esc(session()->get('name')) ?></h1>
        </div>
        <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary btn-sm rounded-3">&larr; Lanjut Belanja</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr><th>Produk</th><th>Harga Satuan</th><th>Qty</th><th class="text-end">Subtotal</th></tr>
            </thead>
            <tbody>
                <?php $total = 0; foreach ($items as $it): $sub = $it['price'] * $it['qty']; $total += $sub; ?>
                    <tr>
                        <td class="fw-semibold"><?= esc($it['name']) ?></td>
                        <td>Rp <?= number_format($it['price'], 0, ',', '.') ?></td>
                        <td><?= (int) $it['qty'] ?></td>
                        <td class="text-end fw-semibold">Rp <?= number_format($sub, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">TOTAL</th>
                    <th class="text-end text-se-purple fs-5">Rp <?= number_format($total, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?= $this->endSection() ?>


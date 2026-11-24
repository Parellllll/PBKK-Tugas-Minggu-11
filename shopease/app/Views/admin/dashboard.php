<?= $this->extend('layouts/panel') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Dashboard Administrator</h1>
        <p class="text-muted small mb-0">Ringkasan pengguna, distribusi peran (RBAC), dan tren registrasi 7 hari terakhir.</p>
    </div>
    <a href="<?= base_url('admin/users') ?>" class="btn btn-se-primary px-3 py-2">+ Kelola Pengguna</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="small text-muted fw-semibold">Total Pengguna</div>
            <div class="fs-2 fw-bold mt-1"><?= (int) $totalUsers ?></div>
            <div class="small text-se-purple fw-semibold">Terdaftar di database</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="small text-muted fw-semibold">Customer</div>
            <div class="fs-2 fw-bold mt-1 text-success"><?= (int) $counts['customer'] ?></div>
            <div class="small text-muted">Akun pelanggan aktif</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="small text-muted fw-semibold">Admin &amp; Operator</div>
            <div class="fs-2 fw-bold mt-1 text-se-purple"><?= (int) $counts['admin'] ?> / <?= (int) $counts['operator'] ?></div>
            <div class="small text-muted">Staf internal toko</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="small text-muted fw-semibold">Token Remember Me</div>
            <div class="fs-2 fw-bold mt-1"><?= (int) $activeTokens ?></div>
            <div class="small text-muted">Sesi aktif 30 hari (SHA-256)</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="se-card p-4 h-100">
            <h2 class="h6 fw-bold mb-3">Grafik Registrasi 7 Hari Terakhir (Chart.js)</h2>
            <canvas id="regChart" height="140"></canvas>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="se-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 fw-bold mb-0">Pengguna Terbaru</h2>
                <a href="<?= base_url('admin/users') ?>" class="small text-se-purple fw-semibold text-decoration-none">Semua &rarr;</a>
            </div>
            <div class="list-group list-group-flush">
                <?php foreach ($recentUsers as $u): ?>
                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="text-truncate me-2">
                            <div class="fw-semibold small"><?= esc($u['name']) ?></div>
                            <div class="text-muted" style="font-size:12px;"><?= esc($u['email']) ?></div>
                        </div>
                        <span class="badge role-badge-<?= esc($u['role']) ?>"><?= esc($u['role']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('regChart');
if (ctx && typeof Chart !== 'undefined') {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartData['labels']) ?>,
            datasets: [{
                label: 'Registrasi Baru',
                data: <?= json_encode($chartData['counts']) ?>,
                backgroundColor: 'rgba(109, 40, 217, 0.78)',
                borderRadius: 8,
                maxBarThickness: 38
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
}
</script>
<?= $this->endSection() ?>


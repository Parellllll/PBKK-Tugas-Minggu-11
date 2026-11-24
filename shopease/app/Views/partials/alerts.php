<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm small" role="alert">
        <strong>Berhasil:</strong> <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm small" role="alert">
        <strong>Gagal:</strong> <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show rounded-3 border-0 shadow-sm small" role="alert">
        <strong>Perhatian:</strong> <?= esc(session()->getFlashdata('warning')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('info')): ?>
    <div class="alert alert-info alert-dismissible fade show rounded-3 border-0 shadow-sm small" role="alert">
        <?= esc(session()->getFlashdata('info')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php $errors = session()->getFlashdata('errors'); ?>
<?php if (!empty($errors) && is_array($errors)): ?>
    <div class="alert alert-danger rounded-3 border-0 shadow-sm small">
        <strong class="d-block mb-1">Periksa kembali data yang dimasukkan:</strong>
        <ul class="mb-0 ps-3">
            <?php foreach ($errors as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


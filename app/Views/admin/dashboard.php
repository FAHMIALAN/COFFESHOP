<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
    <h3 class="mb-3">Dashboard</h3>
    <div class="alert alert-info">
        Selamat Datang, <strong><?= esc(session()->get('username')) ?></strong>! Anda telah berhasil login ke Panel Admin.
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-3 fw-bold"><?= $total_produk ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Berhasil</h5>
                    <p class="card-text fs-3 fw-bold"><?= $pesanan_berhasil ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Pending</h5>
                    <p class="card-text fs-3 fw-bold"><?= $pesanan_pending ?></p>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
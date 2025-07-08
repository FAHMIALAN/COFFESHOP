<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4">Koleksi Kopi Pilihan</h1>
            <p class="lead">Temukan cita rasa kopi terbaik dari seluruh nusantara.</p>
        </div>
    </div>

    <?php if (session()->get('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($produk as $p): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <img src="<?= base_url('assets/images/' . esc($p['gambar'])) ?>" class="card-img-top" alt="<?= esc($p['nama_produk']) ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= esc($p['nama_produk']) ?></h5>
                    <p class="card-text text-muted small"><?= esc($p['kategori']) ?></p>
                    <h6 class="card-subtitle mt-auto mb-2 fw-bold">Rp <?= number_format($p['harga'], 0, ',', '.') ?></h6>
                    <a href="<?= site_url('produk/' . $p['id']) ?>" class="btn btn-dark w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
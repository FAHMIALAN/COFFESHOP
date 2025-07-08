<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url('assets/images/' . esc($produk['gambar'])) ?>" class="img-fluid rounded shadow-lg" alt="<?= esc($produk['nama_produk']) ?>">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold"><?= esc($produk['nama_produk']) ?></h1>
            <span class="badge bg-secondary mb-3"><?= esc($produk['kategori']) ?></span>
            <h2 class="text-danger fw-light">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h2>
            <p class="lead mt-3"><?= esc($produk['deskripsi']) ?></p>
            <hr>
            
            <form action="<?= site_url('cart/add') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                <input type="hidden" name="price" value="<?= $produk['harga'] ?>">
                <input type="hidden" name="name" value="<?= esc($produk['nama_produk']) ?>">
                
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <label for="qty" class="form-label">Jumlah:</label>
                        <input type="number" name="qty" class="form-control" value="1" min="1" max="<?= $produk['stok'] ?>">
                    </div>
                    <div class="col-md-8 mt-3">
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
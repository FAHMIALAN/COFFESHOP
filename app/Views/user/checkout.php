<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Formulir Checkout</h3>
    <hr>
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Data Pengiriman</h5>
                    
                    <?php if (session()->get('errors')): ?>
                        <div class="alert alert-danger mt-3">
                            <p class="fw-bold">Gagal memproses, periksa kembali isian Anda:</p>
                            <ul>
                            <?php foreach (session()->get('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('checkout/process') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_pembeli" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_pembeli" class="form-control" value="<?= old('nama_pembeli') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP (WhatsApp)</label>
                            <input type="tel" name="no_hp" class="form-control" value="<?= old('no_hp') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?= old('alamat') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lanjutkan ke Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Pesanan</h5>
                    <ul class="list-group list-group-flush">
                        <?php $total = 0; ?>
                        <?php foreach ($cart as $item): ?>
                        <?php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($item['name']) ?> (x<?= esc($item['qty']) ?>)
                            <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                        </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            Total
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
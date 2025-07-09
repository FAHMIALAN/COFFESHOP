<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-white">
                    <h3 class="mt-2">Selesaikan Pembayaran</h3>
                    <p class="mb-0 text-muted">Order ID: <strong><?= esc($pesanan['order_id']) ?></strong></p>
                </div>
                <div class="card-body">
                    <h5 class="text-center">Total Tagihan: <span class="text-danger fw-bold">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></span></h5>
                    <hr>
                    
                    <h6 class="text-center">Transfer Bank</h6>

                    <div class="text-center">
                        <ul class="list-unstyled d-inline-block text-start">
                            <li class="mb-2 d-flex align-items-center">
                                <img src="<?= base_url('assets/images/bca.png') ?>" alt="BCA" style="width: 60px; margin-right: 15px;">
                                <strong>1234567890</strong> (a.n. Coffee Shop)
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <img src="<?= base_url('assets/images/mandiri.png') ?>" alt="Mandiri" style="width: 60px; margin-right: 15px;">
                                <strong>1122334455</strong> (a.n. Coffee Shop)
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <img src="<?= base_url('assets/images/bni.png') ?>" alt="BNI" style="width: 60px; margin-right: 15px;">
                                <strong>0987654321</strong> (a.n. Coffee Shop)
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="<?= base_url('assets/images/bri.png') ?>" alt="BRI" style="width: 65px; margin-right: 15px;">
                                <strong>34051122334455</strong> (a.n. Coffee Shop)
                            </li>
                        </ul>
                    </div>

                    <h6 class="mt-4">QRIS</h6>
                    <p>Scan kode QR di bawah ini menggunakan aplikasi pembayaran favoritmu.</p>
                    <div class="text-center">
                        <img src="<?= base_url('assets/images/qris.png') ?>" alt="QRIS Code" class="img-fluid" style="max-width: 350px;">
                    </div>
                    <hr>

                    <h5 class="mt-4">Konfirmasi Pembayaran</h5>
                    <p>Setelah melakukan pembayaran, silakan upload bukti transfer di sini.</p>
                    
                    <?php if (session()->get('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach (session()->get('errors') as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('pembayaran/upload') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="order_id" value="<?= esc($pesanan['order_id']) ?>">
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Upload Bukti (JPG, PNG)</label>
                            <input type="file" class="form-control" name="bukti_pembayaran" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-white">
                    <h3 class="mt-2">Selesaikan Pembayaran</h3>
                    <p class="mb-0 text-muted">Order ID: <strong><?= esc($pesanan['order_id']) ?></strong></p>
                </div>
                <div class="card-body p-4">
                    <h5 class="text-center mb-4">Total Tagihan: <span class="text-danger fw-bold">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></span></h5>
                    
                    <div class="row border-top border-bottom py-3">
                        <div class="col-md-6 border-end px-4">
                            <h5 class="text-center">Transfer Bank</h5>
                            <p class="text-center text-muted small mb-4">Silakan transfer ke salah satu rekening di bawah ini:</p>
                            
                            <div class="text-center">
                                <ul class="list-unstyled d-inline-block text-start">
                                    <li class="mb-3 d-flex align-items-center">
                                        <img src="<?= base_url('assets/images/bca.png') ?>" alt="BCA" style="width: 100px; margin-right: 15px;"> 
                                        <div>
                                            <strong style="font-size: 1.2rem;">1234567890</strong><br>
                                            <span class="text-muted">(a.n. Coffee Shop)</span>
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <img src="<?= base_url('assets/images/mandiri.png') ?>" alt="Mandiri" style="width: 100px; margin-right: 15px;"> 
                                        <div>
                                            <strong style="font-size: 1.2rem;">1122334455</strong><br>
                                            <span class="text-muted">(a.n. Coffee Shop)</span>
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <img src="<?= base_url('assets/images/bni.png') ?>" alt="BNI" style="width: 100px; margin-right: 15px;">
                                        <div>
                                            <strong style="font-size: 1.2rem;">0987654321</strong><br>
                                            <span class="text-muted">(a.n. Coffee Shop)</span>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <img src="<?= base_url('assets/images/bri.png') ?>" alt="BRI" style="width: 100px; margin-right: 15px;">
                                        <div>
                                            <strong style="font-size: 1.2rem;">34051122334455</strong><br>
                                            <span class="text-muted">(a.n. Coffee Shop)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                             <h5 class="text-center">QRIS</h5>
                             <p class="text-center text-muted small">Scan kode QR menggunakan aplikasi pembayaran favoritmu.</p>
                            <img src="<?= base_url('assets/images/qris.png') ?>" alt="QRIS Code" class="img-fluid" style="max-width: 300px;">
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-center">Konfirmasi Pembayaran</h5>
                        <p class="text-center text-muted small">Setelah melakukan pembayaran, silakan upload bukti transfer di sini.</p>
                        
                        <?php if (session()->get('errors')): ?>
                            <div class="alert alert-danger">
                                <?php foreach (session()->get('errors') as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('pembayaran/upload') ?>" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
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
</div>
<?= $this->endSection() ?>
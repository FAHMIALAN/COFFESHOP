<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3><i class="bi bi-cart3"></i> Keranjang Belanja Anda</h3>
    <hr>
    
    <?php if (session()->get('success')): ?>
        <div class="alert alert-success"><?= session()->get('success') ?></div>
    <?php endif; ?>
    <?php if (session()->get('error')): ?>
        <div class="alert alert-danger"><?= session()->get('error') ?></div>
    <?php endif; ?>

    <?php if (empty($cart)): ?>
        <div class="alert alert-warning text-center">
            Keranjang belanja Anda masih kosong. <a href="<?= site_url('/') ?>">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $id => $item): ?>
                    <?php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td><?= esc($item['qty']) ?></td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= site_url('cart/remove/' . $id) ?>" class="btn btn-danger btn-sm" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="3" class="text-end">Total</td>
                        <td colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= site_url('cart/clear') ?>" class="btn btn-outline-danger" onclick="return confirm('Anda yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</a>
            <a href="<?= site_url('checkout') ?>" class="btn btn-primary btn-lg">Lanjutkan ke Checkout</a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
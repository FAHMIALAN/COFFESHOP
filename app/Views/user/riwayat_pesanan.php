<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Riwayat Pesanan Anda</h3>
    <p>Masukkan nomor HP yang Anda gunakan saat memesan untuk melihat riwayat.</p>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= site_url('history/search') ?>" method="post">
                <?= csrf_field() ?>
                <div class="input-group">
                    <input type="tel" name="no_hp" class="form-control" placeholder="Contoh: 081234567890" value="<?= esc($no_hp_searched ?? '') ?>" required>
                    <button class="btn btn-primary" type="submit">Cari Pesanan</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($pesanan)): ?>
        <h4 class="mb-3">Ditemukan <?= count($pesanan) ?> pesanan:</h4>
        <?php foreach($pesanan as $p): ?>
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <strong>Order ID: <?= esc($p['order_id']) ?></strong>
                    <span><?= date('d M Y, H:i', strtotime($p['waktu_pesan'])) ?></span>
                </div>
                <div class="card-body">
                    <p><strong>Total:</strong> Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></p>
                    <p class="mb-0">
                        <strong>Status Pembayaran:</strong> 
                        <?php
                            // Logika baru untuk warna badge status yang lebih lengkap
                            $status = $p['status_pembayaran'];
                            $badge_class = 'bg-secondary'; // Default
                            if ($status == 'pending') $badge_class = 'bg-warning text-dark';
                            if ($status == 'menunggu konfirmasi') $badge_class = 'bg-info text-dark';
                            if ($status == 'diproses') $badge_class = 'bg-primary';
                            if ($status == 'dikirim') $badge_class = 'bg-primary';
                            if ($status == 'selesai') $badge_class = 'bg-success';
                            if ($status == 'dibatalkan') $badge_class = 'bg-danger';
                        ?>
                        <span class="badge <?= $badge_class ?>"><?= esc(ucwords(str_replace('_', ' ', $status))) ?></span>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php elseif(isset($no_hp_searched)): ?>
        <div class="alert alert-info text-center">
            Tidak ditemukan riwayat pesanan untuk nomor HP <strong><?= esc($no_hp_searched) ?></strong>.
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
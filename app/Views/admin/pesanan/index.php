<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<h3>Manajemen Pesanan</h3>
<hr>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Nama Pembeli</th>
                        <th>No. HP</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Waktu Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanan)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada pesanan masuk.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td><?= esc($p['order_id']) ?></td>
                            <td><?= esc($p['nama_pembeli']) ?></td>
                            <td><?= esc($p['no_hp']) ?></td>
                            <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <?php if ($p['status_pembayaran'] == 'success'): ?>
                                    <span class="badge bg-success">Berhasil</span>
                                <?php elseif ($p['status_pembayaran'] == 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Gagal</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y, H:i', strtotime($p['waktu_pesan'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
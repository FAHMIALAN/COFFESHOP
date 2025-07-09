<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<h3>Laporan Penjualan</h3>
<hr>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        Filter Laporan
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/laporan') ?>" method="get" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tanggal_mulai" value="<?= esc($tanggal_mulai ?? '') ?>" required>
            </div>
            <div class="col-md-5">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tanggal_akhir" value="<?= esc($tanggal_akhir ?? '') ?>" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($tanggal_mulai) && !empty($tanggal_akhir)): ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hasil Laporan Periode <?= date('d M Y', strtotime($tanggal_mulai)) ?> s/d <?= date('d M Y', strtotime($tanggal_akhir)) ?></h5>
        
        <a href="<?= site_url('admin/laporan/export_csv?tanggal_mulai=' . $tanggal_mulai . '&tanggal_akhir=' . $tanggal_akhir) ?>" class="btn btn-success btn-sm">
            <i class="bi bi-download"></i> Download CSV
        </a>
    </div>
    <div class="card-body">
        <div class="alert alert-success">
            <strong>Total Pendapatan: Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></strong>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Nama Pembeli</th>
                        <th>Total Harga</th>
                        <th>Waktu Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanan)): ?>
                        <tr><td colspan="4" class="text-center">Tidak ada data penjualan pada periode ini.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td><strong><?= esc($p['order_id']) ?></strong></td>
                            <td><?= esc($p['nama_pembeli']) ?></td>
                            <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td><?= date('d M Y, H:i', strtotime($p['waktu_pesan'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-info">
    Silakan pilih rentang tanggal untuk menampilkan laporan penjualan.
</div>
<?php endif; ?>

<?= $this->endSection() ?>
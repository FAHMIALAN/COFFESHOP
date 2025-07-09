<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<h3>Manajemen Pesanan</h3>
<hr>
    
<?php if (session()->get('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->get('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Nama Pembeli</th>
                        <th>No. HP</th>
                        <th>Total Harga</th>
                        <th class="text-center">Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Waktu Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanan)): ?>
                        <tr><td colspan="8" class="text-center">Belum ada pesanan masuk.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td><strong><?= esc($p['order_id']) ?></strong></td>
                            <td><?= esc($p['nama_pembeli']) ?></td>
                            <td><?= esc($p['no_hp']) ?></td>
                            <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            
                            <td class="text-center">
                                <?php if ($p['bukti_pembayaran']): ?>
                                    <a href="<?= base_url('assets/bukti_pembayaran/' . $p['bukti_pembayaran']) ?>" target="_blank" class="btn btn-info btn-sm">Lihat Bukti</a>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                    $status_class = 'bg-secondary';
                                    if ($p['status_pembayaran'] == 'pending') $status_class = 'bg-warning text-dark';
                                    if ($p['status_pembayaran'] == 'menunggu konfirmasi') $status_class = 'bg-info text-dark';
                                    if ($p['status_pembayaran'] == 'diproses') $status_class = 'bg-primary';
                                    if ($p['status_pembayaran'] == 'dikirim') $status_class = 'bg-primary';
                                    if ($p['status_pembayaran'] == 'selesai') $status_class = 'bg-success';
                                    if ($p['status_pembayaran'] == 'dibatalkan') $status_class = 'bg-danger';
                                ?>
                                <span class="badge <?= $status_class ?> p-2"><?= esc(ucwords(str_replace('_', ' ', $p['status_pembayaran']))) ?></span>
                            </td>
                            <td><?= date('d M Y, H:i', strtotime($p['waktu_pesan'])) ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ubah Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="<?= site_url('admin/pesanan/update_status') ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                <input type="hidden" name="status" value="diproses">
                                                <button type="submit" class="dropdown-item">Diproses</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="<?= site_url('admin/pesanan/update_status') ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                <input type="hidden" name="status" value="dikirim">
                                                <button type="submit" class="dropdown-item">Dikirim</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="<?= site_url('admin/pesanan/update_status') ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" class="dropdown-item">Selesai</button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="<?= site_url('admin/pesanan/update_status') ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                <input type="hidden" name="status" value="dibatalkan">
                                                <button type="submit" class="dropdown-item text-danger">Dibatalkan</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
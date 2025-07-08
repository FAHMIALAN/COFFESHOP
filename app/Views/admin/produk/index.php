<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Produk</h3>
    <a href="<?= site_url('admin/produk/create') ?>" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<?php if (session()->get('success')): ?>
    <div class="alert alert-success" role="alert"><?= session()->get('success') ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produk)): ?>
                        <tr><td colspan="7" class="text-center">Belum ada data produk.</td></tr>
                    <?php else: ?>
                        <?php $i = 1; foreach ($produk as $p): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><img src="<?= base_url('assets/images/' . esc($p['gambar'])) ?>" width="80"></td>
                            <td><?= esc($p['nama_produk']) ?></td>
                            <td><?= esc($p['kategori']) ?></td>
                            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            <td><?= esc($p['stok']) ?></td>
                            <td>
                                <a href="<?= site_url('admin/produk/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <a href="<?= site_url('admin/produk/delete/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk ini?')" title="Hapus"><i class="bi bi-trash-fill"></i></a>
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
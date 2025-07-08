<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<h3>Tambah Produk Baru</h3>
<hr>

<div class="card">
    <div class="card-body">
        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->get('errors') as $error): ?><p class="mb-0"><?= esc($error) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/produk/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3"><label for="nama_produk" class="form-label">Nama Produk</label><input type="text" class="form-control" name="nama_produk" value="<?= old('nama_produk') ?>" required></div>
            <div class="mb-3"><label for="deskripsi" class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="3"><?= old('deskripsi') ?></textarea></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label for="harga" class="form-label">Harga</label><input type="number" class="form-control" name="harga" value="<?= old('harga') ?>" required></div>
                <div class="col-md-6 mb-3"><label for="stok" class="form-label">Stok</label><input type="number" class="form-control" name="stok" value="<?= old('stok') ?>" required></div>
            </div>
            <div class="mb-3"><label for="kategori" class="form-label">Kategori</label><input type="text" class="form-control" name="kategori" value="<?= old('kategori') ?>" placeholder="Contoh: Arabica, Robusta"></div>
            <div class="mb-3"><label for="gambar" class="form-label">Gambar Produk</label><input class="form-control" type="file" name="gambar" required></div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('admin/produk') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
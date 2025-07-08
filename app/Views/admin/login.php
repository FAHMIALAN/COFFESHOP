<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h4>Admin Login</h4>
            </div>
            <div class="card-body">
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger" role="alert"><?= session()->get('error') ?></div>
                <?php endif; ?>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert"><?= session()->get('success') ?></div>
                <?php endif; ?>
                
                <form action="<?= site_url('admin/login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="<?= site_url('admin/register') ?>">Daftar di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
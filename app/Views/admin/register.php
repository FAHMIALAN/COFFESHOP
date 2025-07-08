<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h4>Registrasi Admin Baru</h4>
            </div>
            <div class="card-body">
                <?php if (session()->get('errors')): ?>
                    <div class="alert alert-danger">
                        <?php foreach (session()->get('errors') as $error): ?><p class="mb-0"><?= esc($error) ?></p><?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('admin/register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <small class="form-text text-muted">Minimal 8 karakter.</small>
                    </div>
                     <div class="mb-3">
                        <label for="pass_confirm" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="pass_confirm" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Daftar</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="<?= site_url('admin/login') ?>">Login di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
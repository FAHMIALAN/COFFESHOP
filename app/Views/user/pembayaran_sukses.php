<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container text-center">
    <div class="py-5">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        <h1 class="mt-3">Terima Kasih!</h1>
        <p class="lead">Pesanan Anda telah kami terima dan akan segera diproses.</p>
        <hr>
        <p>Anda bisa memeriksa status pesanan Anda di halaman riwayat.</p>
        <a href="<?= site_url('history') ?>" class="btn btn-primary">Lihat Riwayat Pesanan</a>
        <a href="<?= site_url('/') ?>" class="btn btn-outline-secondary">Kembali ke Home</a>
    </div>
</div>
<?= $this->endSection() ?>
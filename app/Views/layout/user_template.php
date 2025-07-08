<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Selamat Datang') ?> | Matakopian.id</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Kustom Kita -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <!-- Midtrans Snap.js -->
    <script type="text/javascript"
      src="<?= (getenv('MIDTRANS_IS_PRODUCTION') == 'true') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' ?>"
      data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('/') ?>">☕ Matakopian.id</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="userNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('history') ?>">Riwayat Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('cart') ?>">
                            <i class="bi bi-cart-fill"></i> Keranjang
                            <?php
                                $cart_items = session('cart') ? count(session('cart')) : 0;
                            ?>
                            <span class="badge rounded-pill bg-danger"><?= $cart_items ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-light text-center py-4 mt-5">
        <p class="mb-0">&copy; <?= date('Y') ?> Matakopian.id. Semua Hak Dilindungi.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Kustom Kita -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>
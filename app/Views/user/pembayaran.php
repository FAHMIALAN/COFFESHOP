<?= $this->extend('layout/user_template') ?>

<?= $this->section('content') ?>
<div class="container text-center">
    <div class="card mx-auto shadow-sm" style="max-width: 500px;">
        <div class="card-body py-4">
            <h3 class="card-title">Selesaikan Pembayaran Anda</h3>
            <p class="card-text text-muted">Pesanan Anda telah kami catat. Klik tombol di bawah untuk membuka jendela pembayaran yang aman dari Midtrans.</p>
            
            <button id="pay-button" class="btn btn-success btn-lg w-100 mt-3">
                <i class="bi bi-shield-lock-fill"></i> Bayar Sekarang
            </button>
        </div>
    </div>
</div>

<script type="text/javascript">
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    snap.pay('<?= $snapToken ?>', {
      onSuccess: function(result){
        console.log(result);
        alert("Pembayaran Anda berhasil!"); 
        window.location.href = "<?= site_url('checkout/success') ?>";
      },
      onPending: function(result){
        console.log(result);
        alert("Menunggu pembayaran Anda!");
      },
      onError: function(result){
        console.log(result);
        alert("Pembayaran gagal!");
      },
      onClose: function(){
        alert('Anda menutup jendela pembayaran sebelum selesai.');
      }
    });
  });
</script>
<?= $this->endSection() ?>
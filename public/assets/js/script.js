// Menunggu sampai seluruh halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    
    // Cari elemen alert
    const alertElement = document.querySelector('.alert-success');

    // Jika elemen alert ada
    if (alertElement) {
        // Atur timer untuk menghilangkan alert setelah 4 detik (4000 milidetik)
        setTimeout(function() {
            // Gunakan Bootstrap's Alert component untuk menutupnya dengan animasi
            const bsAlert = new bootstrap.Alert(alertElement);
            bsAlert.close();
        }, 4000);
    }

});
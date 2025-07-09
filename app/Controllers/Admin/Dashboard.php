<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;   // Tambahkan ini
use App\Models\PesananModel;  // Tambahkan ini

class Dashboard extends BaseController
{
    public function index()
    {
        // Panggil model yang dibutuhkan
        $produkModel = new ProdukModel();
        $pesananModel = new PesananModel();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title'                 => 'Dashboard',
            // Hitung semua baris di tabel produk
            'total_produk'          => $produkModel->countAllResults(),
            // Hitung pesanan dengan status 'selesai'
            'pesanan_berhasil'      => $pesananModel->where('status_pembayaran', 'selesai')->countAllResults(),
            // Hitung pesanan dengan status 'pending' atau 'menunggu konfirmasi'
            'pesanan_pending'       => $pesananModel->whereIn('status_pembayaran', ['pending', 'menunggu konfirmasi'])->countAllResults(),
        ];
        
        return view('admin/dashboard', $data);
    }
}
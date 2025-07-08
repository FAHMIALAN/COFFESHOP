<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * Menampilkan halaman utama setelah admin login.
     */
    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        // Di sini bisa ditambahkan logika untuk mengambil data ringkasan
        // seperti jumlah produk, jumlah pesanan baru, dll.
        return view('admin/dashboard', $data);
    }
}
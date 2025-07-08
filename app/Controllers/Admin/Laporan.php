<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Penjualan',
        ];
        // Untuk saat ini, kita hanya menampilkan view placeholder
        // Logika untuk filter tanggal dan pengambilan data akan ditambahkan di sini
        return view('admin/laporan/index', $data);
    }
}
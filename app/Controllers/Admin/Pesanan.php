<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Pesanan extends BaseController
{
    /**
     * Menampilkan daftar semua pesanan yang masuk.
     */
    public function index()
    {
        $pesananModel = new PesananModel();
        $data = [
            'title' => 'Manajemen Pesanan',
            'pesanan' => $pesananModel->orderBy('waktu_pesan', 'DESC')->findAll(),
        ];
        return view('admin/pesanan/index', $data);
    }
}
<?php

namespace App\Controllers;

use App\Models\PesananModel;

class History extends BaseController
{
    /**
     * Menampilkan halaman untuk mencari riwayat pesanan.
     */
    public function index()
    {
        $data = [
            'title' => 'Cek Riwayat Pesanan Anda',
            'pesanan' => [],
        ];
        return view('user/riwayat_pesanan', $data);
    }

    /**
     * Memproses pencarian riwayat pesanan berdasarkan nomor HP.
     */
    public function search()
    {
        $no_hp = $this->request->getPost('no_hp');
        $pesananModel = new PesananModel();
        
        $data = [
            'title' => 'Hasil Riwayat Pesanan',
            'pesanan' => $pesananModel->where('no_hp', $no_hp)->orderBy('waktu_pesan', 'DESC')->findAll(),
            'no_hp_searched' => $no_hp
        ];

        return view('user/riwayat_pesanan', $data);
    }
}
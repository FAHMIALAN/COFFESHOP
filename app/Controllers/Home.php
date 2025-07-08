<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    /**
     * Menampilkan halaman utama dengan daftar semua produk.
     */
    public function index()
    {
        $produkModel = new ProdukModel();
        $data = [
            'title' => 'Selamat Datang di Coffee Shop Kami',
            'produk' => $produkModel->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('user/home', $data);
    }

    /**
     * Menampilkan halaman detail untuk satu produk.
     */
    public function detail($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Produk tidak ditemukan');
        }

        $data = [
            'title' => $produk['nama_produk'],
            'produk' => $produk,
        ];
        return view('user/detail_produk', $data);
    }
}
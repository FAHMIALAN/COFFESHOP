<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;

class Checkout extends BaseController
{
    /**
     * Menampilkan halaman checkout dengan form data pembeli.
     */
    public function index()
    {
        $cart = session('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Keranjang Anda kosong, tidak bisa checkout!');
        }
        
        $data = [
            'title' => 'Checkout',
            'cart' => $cart
        ];
        return view('user/checkout', $data);
    }

    /**
     * Memproses data checkout, menyimpan ke DB, dan mengarahkan ke halaman pembayaran manual.
     */
    public function process()
    {
        $cart = session('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/');
        }
        
        // Aturan validasi
        $rules = [
            'nama_pembeli' => 'required|min_length[3]',
            'no_hp'        => 'required|numeric|min_length[10]',
            'alamat'       => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database
        $pesananModel = new PesananModel();
        $detailModel = new DetailPesananModel();
        
        $totalHarga = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));
        $orderId = 'COFFEE-' . time();
        
        $pesananModel->insert([
            'order_id' => $orderId,
            'nama_pembeli' => $this->request->getPost('nama_pembeli'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'total_harga' => $totalHarga,
            'status_pembayaran' => 'pending', // Status awal saat pesanan dibuat
        ]);
        $idPesanan = $pesananModel->getInsertID();

        foreach($cart as $item) {
            $detailModel->insert([
                'id_pesanan' => $idPesanan,
                'id_produk' => $item['id'],
                'jumlah' => $item['qty'],
                'harga_satuan' => $item['price']
            ]);
        }
        
        // Kosongkan keranjang belanja
        session()->remove('cart');

        // Alihkan ke halaman pembayaran manual dengan mengirim order_id
        return redirect()->to('/pembayaran/' . $orderId);
    }
}
<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;

class Checkout extends BaseController
{
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

    public function process()
    {
        $cart = session('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/');
        }
        
        // --- BAGIAN VALIDASI YANG DITAMBAHKAN ---
        // Aturan validasi yang harus dipenuhi
        $rules = [
            'nama_pembeli' => 'required|min_length[3]',
            'no_hp'        => 'required|numeric|min_length[10]',
            'alamat'       => 'required|min_length[10]'
        ];

        // Jalankan validasi. Jika gagal, kembali ke form dengan error
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // --- AKHIR BAGIAN VALIDASI ---

        // Kode di bawah ini hanya akan jalan jika validasi berhasil
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
            'status_pembayaran' => 'pending',
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
        
        \Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = (bool)getenv('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$clientKey = getenv('MIDTRANS_CLIENT_KEY');

        $transaction_details = ['order_id' => $orderId, 'gross_amount' => $totalHarga];
        $customer_details = ['first_name' => $this->request->getPost('nama_pembeli'), 'phone' => $this->request->getPost('no_hp')];
        $item_details = array_map(fn($item) => ['id' => $item['id'], 'price' => $item['price'], 'quantity' => $item['qty'], 'name' => $item['name']], $cart);

        $transaction = ['transaction_details' => $transaction_details, 'customer_details' => $customer_details, 'item_details' => $item_details];
        
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            session()->remove('cart');
            return view('user/pembayaran', ['title' => 'Lanjutkan Pembayaran', 'snapToken' => $snapToken]);
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Snap Token Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memproses pembayaran. Silakan coba lagi.');
        }
    }

    public function success()
    {
        return view('user/pembayaran_sukses', ['title' => 'Pembayaran Berhasil']);
    }
}
<?php

namespace App\Controllers;

use App\Models\PesananModel;

class Pembayaran extends BaseController
{
    public function index($orderId)
    {
        $pesananModel = new PesananModel();
        $pesanan = $pesananModel->where('order_id', $orderId)->first();

        if (!$pesanan) {
            return redirect()->to('/')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'pesanan' => $pesanan
        ];

        return view('user/pembayaran_manual', $data);
    }

    public function upload()
    {
        $orderId = $this->request->getPost('order_id');
        $buktiFile = $this->request->getFile('bukti_pembayaran');

        // Validasi file
        $rules = [
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,2048]|is_image[bukti_pembayaran]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Pindahkan file ke folder public
        $namaFile = $orderId . '.' . $buktiFile->getExtension();
        $buktiFile->move('assets/bukti_pembayaran', $namaFile);

        // Update database
        $pesananModel = new PesananModel();
        $pesananModel->where('order_id', $orderId)->set([
            'bukti_pembayaran' => $namaFile,
            'status_pembayaran' => 'menunggu konfirmasi'
        ])->update();

        return redirect()->to('/pembayaran/sukses');
    }

    // Ganti nama method success di Checkout.php menjadi di sini
    public function sukses()
    {
        return view('user/pembayaran_sukses', ['title' => 'Konfirmasi Terkirim']);
    }
}
<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\ProdukModel;

class Api extends BaseController
{
    public function notification()
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$isProduction = (bool)getenv('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();

        // Ambil data notifikasi
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $pesananModel = new PesananModel();
        $pesanan = $pesananModel->where('order_id', $order_id)->first();

        // Jika pesanan tidak ditemukan, kirim response error
        if (!$pesanan) {
            return $this->response->setStatusCode(404, 'Order not found');
        }

        // Handle status pembayaran dari notifikasi
        if ($transaction == 'settlement') {
            // Update status pembayaran menjadi 'success'
            $pesananModel->update($pesanan['id'], [
                'status_pembayaran' => 'success',
                'tipe_pembayaran' => $type
            ]);

            // --- Logika Pengurangan Stok ---
            $detailModel = new DetailPesananModel();
            $produkModel = new ProdukModel();

            $itemProduk = $detailModel->where('id_pesanan', $pesanan['id'])->findAll();

            foreach ($itemProduk as $item) {
                $produkModel->where('id', $item['id_produk'])
                            ->decrement('stok', $item['jumlah']);
            }

        } else if ($transaction == 'pending') {
            $pesananModel->update($pesanan['id'], ['status_pembayaran' => 'pending']);
        } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
            $pesananModel->update($pesanan['id'], ['status_pembayaran' => 'failed']);
        }

        // Kirim response OK ke Midtrans untuk mengkonfirmasi notifikasi telah diterima
        return $this->response->setStatusCode(200, 'OK');
    }
}
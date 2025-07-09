<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Pesanan extends BaseController
{
    public function index()
    {
        $pesananModel = new PesananModel();
        $data = [
            'title' => 'Manajemen Pesanan',
            'pesanan' => $pesananModel->orderBy('waktu_pesan', 'DESC')->findAll(),
        ];
        return view('admin/pesanan/index', $data);
    }

    /**
     * Method baru untuk update status pesanan.
     */
    public function updateStatus()
    {
        $pesananModel = new PesananModel();

        // Ambil id dan status baru dari form
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Update data di database
        $pesananModel->update($id, ['status_pembayaran' => $status]);

        // Kembali ke halaman pesanan dengan notifikasi
        return redirect()->to('/admin/pesanan')->with('success', 'Status pesanan berhasil diupdate.');
    }
}
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Laporan extends BaseController
{
    public function index()
    {
        $pesananModel = new PesananModel();
        $tanggal_mulai = $this->request->getGet('tanggal_mulai');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        $data = [
            'title' => 'Laporan Penjualan',
            'pesanan' => [],
            'total_pendapatan' => 0,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
        ];

        if ($tanggal_mulai && $tanggal_akhir) {
            $pesanan_selesai = $pesananModel
                ->where('status_pembayaran', 'selesai')
                ->where('waktu_pesan >=', $tanggal_mulai . ' 00:00:00')
                ->where('waktu_pesan <=', $tanggal_akhir . ' 23:59:59')
                ->findAll();

            $total_pendapatan = $pesananModel
                ->selectSum('total_harga')
                ->where('status_pembayaran', 'selesai')
                ->where('waktu_pesan >=', $tanggal_mulai . ' 00:00:00')
                ->where('waktu_pesan <=', $tanggal_akhir . ' 23:59:59')
                ->first()['total_harga'];

            $data['pesanan'] = $pesanan_selesai;
            $data['total_pendapatan'] = $total_pendapatan;
        }

        return view('admin/laporan/index', $data);
    }

    /**
     * Method baru untuk export data ke CSV
     */
    public function exportCsv()
    {
        $tanggal_mulai = $this->request->getGet('tanggal_mulai');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        if (!$tanggal_mulai || !$tanggal_akhir) {
            return redirect()->to('/admin/laporan')->with('error', 'Silakan pilih rentang tanggal terlebih dahulu.');
        }

        $pesananModel = new PesananModel();
        $dataPesanan = $pesananModel
            ->where('status_pembayaran', 'selesai')
            ->where('waktu_pesan >=', $tanggal_mulai . ' 00:00:00')
            ->where('waktu_pesan <=', $tanggal_akhir . ' 23:59:59')
            ->findAll();

        $filename = 'laporan-penjualan-' . $tanggal_mulai . '-sd-' . $tanggal_akhir . '.csv';

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=" . $filename);

        $output = fopen('php://output', 'w');
        // Tulis header kolom
        fputcsv($output, ['Order ID', 'Nama Pembeli', 'No. HP', 'Total Harga', 'Waktu Pesan']);

        // Tulis data baris
        foreach ($dataPesanan as $pesanan) {
            fputcsv($output, [
                $pesanan['order_id'],
                $pesanan['nama_pembeli'],
                $pesanan['no_hp'],
                $pesanan['total_harga'],
                $pesanan['waktu_pesan'],
            ]);
        }

        fclose($output);
        exit();
    }
}
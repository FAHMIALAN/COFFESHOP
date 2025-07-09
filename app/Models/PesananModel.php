<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'tbl_pesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'order_id',
        'nama_pembeli',
        'no_hp',
        'alamat',
        'total_harga',
        'status_pembayaran',
        'tipe_pembayaran',
        'bukti_pembayaran', // <-- TAMBAHKAN BARIS INI
        'waktu_pesan'
    ];
}
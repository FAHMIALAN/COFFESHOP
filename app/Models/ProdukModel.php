<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_produk', 'deskripsi', 'harga', 'gambar', 'kategori', 'stok'];

    // Mengaktifkan penggunaan created_at dan updated_at secara otomatis
    protected $useTimestamps = true;
}
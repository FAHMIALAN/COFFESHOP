<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    /**
     * Menampilkan daftar semua produk.
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen Produk',
            'produk' => $this->produkModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/produk/index', $data);
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        $data['title'] = 'Tambah Produk Baru';
        return view('admin/produk/create', $data);
    }

    /**
     * Menyimpan data produk baru ke database.
     */
    public function store()
    {
        $rules = [
            'nama_produk' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambar = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('assets/images', $namaGambar);

        $this->produkModel->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'kategori' => $this->request->getPost('kategori'),
            'stok' => $this->request->getPost('stok'),
            'gambar' => $namaGambar,
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Produk',
            'produk' => $this->produkModel->find($id)
        ];
        return view('admin/produk/edit', $data);
    }

    /**
     * Mengupdate data produk di database.
     */
    public function update($id)
    {
        $rules = [
            'nama_produk' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ];

        if ($this->request->getFile('gambar')->isValid()) {
            $rules['gambar'] = 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'kategori' => $this->request->getPost('kategori'),
            'stok' => $this->request->getPost('stok'),
        ];

        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $produkLama = $this->produkModel->find($id);
            if ($produkLama['gambar'] && file_exists('assets/images/' . $produkLama['gambar'])) {
                unlink('assets/images/' . $produkLama['gambar']);
            }
            $namaGambar = $gambar->getRandomName();
            $gambar->move('assets/images', $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $this->produkModel->update($id, $data);
        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Menghapus produk dari database.
     */
    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk && $produk['gambar'] && file_exists('assets/images/' . $produk['gambar'])) {
            unlink('assets/images/' . $produk['gambar']);
        }
        $this->produkModel->delete($id);
        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
<?php

namespace App\Controllers;

class Cart extends BaseController
{
    protected $cart;

    public function __construct()
    {
        // Mengambil data keranjang dari session saat controller diinisialisasi.
        $this->cart = session('cart') ?? [];
    }

    /**
     * Menyimpan data keranjang ke dalam session.
     */
    private function saveCart()
    {
        session()->set('cart', $this->cart);
    }

    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $data = [
            'title' => 'Keranjang Belanja',
            'cart' => $this->cart
        ];
        return view('user/keranjang', $data);
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function add()
    {
        $id = $this->request->getPost('id');
        $qty = (int)$this->request->getPost('qty');
        
        if (isset($this->cart[$id])) {
            // Jika produk sudah ada, tambahkan kuantitasnya.
            $this->cart[$id]['qty'] += $qty;
        } else {
            // Jika produk belum ada, tambahkan sebagai item baru.
            $this->cart[$id] = [
                'id'    => $id,
                'name'  => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'qty'   => $qty
            ];
        }

        $this->saveCart();
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus satu item dari keranjang.
     */
    public function remove($id)
    {
        if (isset($this->cart[$id])) {
            unset($this->cart[$id]);
            $this->saveCart();
        }
        return redirect()->to('/cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Mengosongkan seluruh keranjang belanja.
     */
    public function clear()
    {
        session()->remove('cart');
        return redirect()->to('/cart')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
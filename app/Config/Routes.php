<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//================================================
// RUTE USER (HALAMAN DEPAN)
//================================================
$routes->get('/', 'Home::index');
$routes->get('/produk/(:num)', 'Home::detail/$1');

$routes->get('/cart', 'Cart::index');
$routes->post('/cart/add', 'Cart::add');
$routes->get('/cart/remove/(:any)', 'Cart::remove/$1');
$routes->get('/cart/clear', 'Cart::clear');

$routes->get('/checkout', 'Checkout::index');
$routes->post('/checkout/process', 'Checkout::process');

$routes->get('/history', 'History::index');
$routes->post('/history/search', 'History::search');

// Rute untuk Pembayaran Manual
$routes->get('/pembayaran/(:any)', 'Pembayaran::index/$1');
$routes->post('/pembayaran/upload', 'Pembayaran::upload');
$routes->get('/pembayaran/sukses', 'Pembayaran::sukses');


//================================================
// RUTE ADMIN (PANEL ADMIN)
//================================================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    // Rute yang tidak dilindungi
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::processLogin');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::processRegister');
    $routes->get('logout', 'Auth::logout');

    // Rute yang dilindungi filter 'adminAuth'
    $routes->group('', ['filter' => 'adminAuth'], function ($routes) {
        $routes->get('dashboard', 'Dashboard::index');
        
        // Rute Produk
        $routes->get('produk', 'Produk::index');
        $routes->get('produk/create', 'Produk::create');
        $routes->post('produk/store', 'Produk::store');
        $routes->get('produk/edit/(:num)', 'Produk::edit/$1');
        $routes->post('produk/update/(:num)', 'Produk::update/$1');
        $routes->get('produk/delete/(:num)', 'Produk::delete/$1');

        // Rute Pesanan & Laporan
        $routes->get('pesanan', 'Pesanan::index');
        $routes->post('pesanan/update_status', 'Pesanan::updateStatus'); // <-- PERBAIKAN DI SINI
        $routes->get('laporan', 'Laporan::index');
    });
});
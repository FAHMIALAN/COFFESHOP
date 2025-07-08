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
$routes->get('/checkout/success', 'Checkout::success');

$routes->get('/history', 'History::index');
$routes->post('/history/search', 'History::search');


//================================================
// RUTE ADMIN (PANEL ADMIN)
//================================================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    // Rute yang tidak dilindungi (halaman login & register)
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::processLogin');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::processRegister');
    $routes->get('logout', 'Auth::logout');

    // Rute yang dilindungi filter 'adminAuth' (wajib login)
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
        $routes->get('laporan', 'Laporan::index');
    });
});


//================================================
// RUTE API (UNTUK WEBHOOK MIDTRANS)
//================================================
$routes->post('api/notification', 'Api::notification');
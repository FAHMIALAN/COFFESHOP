<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    /**
     * Method ini dijalankan SEBELUM controller yang dilindungi diakses.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'isLoggedInAdmin' ada dan bernilai true.
        if (! session()->get('isLoggedInAdmin')) {
            // Jika tidak, paksa pengguna kembali ke halaman login admin.
            return redirect()->to('/admin/login');
        }
    }

    /**
     * Method ini dijalankan SETELAH controller diakses.
     * Kita tidak perlu melakukan apa-apa di sini.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    /**
     * Menampilkan halaman login admin.
     */
    public function login()
    {
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/login');
    }

    /**
     * Memproses data login admin.
     */
    public function processLogin()
    {
        $model = new AdminModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $model->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'admin_id'        => $admin['id'],
                'username'        => $admin['username'],
                'isLoggedInAdmin' => true,
            ]);
            return redirect()->to('/admin/dashboard');
        }
        
        return redirect()->back()->with('error', 'Username atau Password Salah');
    }

    /**
     * Menampilkan halaman registrasi admin.
     */
    public function register()
    {
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/register');
    }

    /**
     * Memproses data registrasi admin baru.
     */
    public function processRegister()
    {
        $rules = [
            'username'     => 'required|is_unique[tbl_admin.username]|min_length[4]',
            'password'     => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new AdminModel();
        $model->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/admin/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    
    /**
     * Menghapus session dan logout admin.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
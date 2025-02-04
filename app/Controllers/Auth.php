<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        // Tampilkan halaman login
        if (session()->get('user_id')) {
            return redirect()->to('/');
        }
        return view('login');
    }

    public function processLogin()
    {
        // Lakukan validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('authError', 'Email atau Password Tidak Valid');
        }

        // Proses autentikasi user
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Lakukan pengecekan di database atau sistem autentikasi lainnya
        // Misalnya, Anda bisa menggunakan model User
        $userModel = new \App\Models\UsersModel();
        $mhsModel = new \App\Models\MahasiswaModel();
        $stafModel = new \App\Models\StafModel();
        $user = $userModel->asArray()->where('email', $email)->first();
        
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('authError', 'Email atau password salah');
        }

        $nama = $mhsModel->asArray()->where('id_user', $user['id'])->first();
        if (!$nama) {
            $nama = $stafModel->asArray()->where('id_user', $user['id'])->first();
        }

        $nama = $nama ? $nama['nama'] :  $user['nama'];

        // Login berhasil, simpan informasi user ke dalam sesi
        $session = session();
        $session->set([
            'user_id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
            'nama' => $nama,
            'logged_in' => true,
            // Tambahkan informasi lain yang diperlukan
        ]);

        // Redirect ke halaman dashboard atau halaman lainnya
        return redirect()->to('/');
    }

    public function logout()
    {
        // Hapus sesi dan redirect ke halaman login
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    
}

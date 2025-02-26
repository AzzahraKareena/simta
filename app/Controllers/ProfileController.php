<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\StafModel;
use App\Models\MahasiswaModel;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $mahasiswaModel;
    protected $stafModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->stafModel = new StafModel();
    }

    // Menampilkan profil pengguna
    public function index()
    {
        $userId = session()->get('user_id'); // Ambil ID pengguna dari session
        $data['user'] = $this->userModel->find($userId); // Ambil data pengguna

        // Cek peran pengguna untuk mengambil data tambahan
        if (session()->get('role') == 'Mahasiswa') {
            $data['mahasiswa'] = $this->mahasiswaModel->where('id_user', $userId)->first();
        } else  {
            $data['staf'] = $this->stafModel->where('id_user', $userId)->first();
        }

        // dd($data);

        return view('profile/index', $data); // Tampilkan view profil
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        $userId = session()->get('user_id'); // Ambil ID pengguna dari session
        $data['user'] = $this->userModel->find($userId); // Ambil data pengguna

        // Cek peran pengguna untuk mengambil data tambahan
        if (session()->get('role') == 'Mahasiswa') {
            $data['mahasiswa'] = $this->mahasiswaModel->where('id_user', $userId)->first();
        } else {
            $data['staf'] = $this->stafModel->where('id_user', $userId)->first();
        }

        return view('profile/edit', $data); // Tampilkan view edit profil
    }

// Mengupdate profil pengguna
public function update()
{
    $userId = session()->get('user_id'); // Ambil ID pengguna dari session

    // Validasi input
    $this->validate([
        'nama' => 'required',
        'email' => 'required|valid_email',
        'username' => 'required',
        'password' => 'permit_empty|min_length[6]', // Password opsional
    ]);

    // Ambil data dari form
    $data = [
        'nama' => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
        'username' => $this->request->getPost('username'),
    ];

    // Jika password diisi, hash dan tambahkan ke data
    if ($this->request->getPost('password')) {
        $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    }

    // Update data pengguna
    $this->userModel->update($userId, $data);

    // Update nama di masing-masing tabel
    if (session()->get('role') == 'Mahasiswa') {
        // Ambil ID mahasiswa berdasarkan user_id
        $mahasiswa = $this->mahasiswaModel->where('id_user', $userId)->first();
        if ($mahasiswa) {
            $mahasiswaData = [
                'nama' => $this->request->getPost('nama'), // Pastikan nama juga diperbarui di tabel mahasiswa
                // Tambahkan field lain yang diperlukan jika ada
            ];
            $this->mahasiswaModel->update($mahasiswa->id_mhs, $mahasiswaData); // Gunakan ID mahasiswa untuk update
        }
    } else {
        // Ambil ID staf berdasarkan user_id
        $staf = $this->stafModel->where('id_user', $userId)->first();
        if ($staf) {
            $stafData = [
                'nama' => $this->request->getPost('nama'), // Pastikan nama juga diperbarui di tabel staf
                // Tambahkan field lain yang diperlukan jika ada
            ];
            $this->stafModel->update($staf->id_staf, $stafData); // Gunakan ID staf untuk update
        }
    }

    return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
}
}
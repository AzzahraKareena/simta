<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaController extends BaseController
{
    public function table()
    {
        $data = (new MahasiswaModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Data Master Mahasiswa';
        $operation['sub_title'] = '';
        return view("mastermahasiswa/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Data Master mahasiswa';
        $operation['sub_title'] = '';
        return view('mastermahasiswa/create', $operation);
    }

    public function store()
    {
        // Mulai transaksi
        $db = \Config\Database::connect();
        $db->transStart();
        
        // Ambil data POST
        $data = $this->request->getPost();
        
        // Hash password sebelum menyimpan
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Simpan data pengguna ke tabel users
        $userModel =  new \App\Models\UsersModel();
        $userData = [
            'email'         => $data['email'],
            'username'      => $data['username'],
            'password_hash' => $data['password_hash'],
            'role'          => "Mahasiswa",  // Role diset ke Mahasiswa
            'created_at'    => date('Y-m-d H:i:s'),
        ];
        $userModel->insert($userData);
        $userId = $userModel->insertID();
        
        // Jika insert user gagal, rollback transaksi dan kembalikan error
        if (!$userId) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data pengguna.');
        }
        
        // Simpan data ke tabel mahasiswa dengan relasi id_user
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $mahasiswaData = [
            'id_user'   => $userId,  // Relasi ke tabel users
            'nama'      => $data['nama'],
            'nim'       => $data['nim'],
            'no_telp'   => $data['no_telp'],
            'prodi'     => $data['prodi'],
            'th_masuk'  => $data['th_masuk'],
            'th_lulus'  => $data['th_lulus'],
            'kelas'     => $data['kelas'],
            'status'    => $data['status'],
        ];
        $mahasiswaModel->insert($mahasiswaData);
        
        // Selesaikan transaksi
        $db->transComplete();
        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Transaksi gagal. Silakan coba lagi.');
        }
        
        return redirect()->to('mastermahasiswa')->with('success', 'Data mahasiswa berhasil disimpan.');
    }

    public function edit($id)
    {
        $mahasiswaModel = new MahasiswaModel();
        $data['dataForm'] = $mahasiswaModel->withUser()->where('mahasiswa.id_mhs', $id)->first();
    
        if (!$data['dataForm']) {
            return redirect()->to('mastermahasiswa')->with('error', 'Data tidak ditemukan');
        }
    
        $data['title'] = 'Data Master mahasiswa';
        $data['sub_title'] = '';
        return view('mastermahasiswa/create', $data);
    }

    public function update($id)
    {

        
        $data = $this->request->getPost();
        $mahasiswaModel = new MahasiswaModel();
        $userModel = new \App\Models\UsersModel();
        
        $mahasiswa = $mahasiswaModel->find($id);
        if (!$mahasiswa) {
            return redirect()->to('mastermahasiswa')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $id_user = $mahasiswa->id_user; 

        $userData = [
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => "Mahasiswa",
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!empty($data['password'])) {
            $userData['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $userModel->update($id_user, $userData);

    

        // Perbarui data mahasiswa (kolom yang ada di tabel mahasiswa)
        $mahasiswaData = [
            'nama'      => $data['nama'],
            'nim'       => $data['nim'],
            'no_telp'   => $data['no_telp'],
            'prodi'     => $data['prodi'],
            'th_masuk'  => $data['th_masuk'],
            'th_lulus'  => $data['th_lulus'],
            'kelas'     => $data['kelas'],
            'status'    => $data['status'],
        ];
        $mahasiswaModel->update($id, $mahasiswaData);

        
        return redirect()->to('mastermahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $mahasiswa = new MahasiswaModel();
        $mahasiswa->delete($id);
        return redirect()->to('mastermahasiswa');
    }
}
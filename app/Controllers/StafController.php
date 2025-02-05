<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StafModel;
use CodeIgniter\HTTP\ResponseInterface;

class StafController extends BaseController
{
    public function table()
    {
    // Buat instance model StafModel
    $stafModel = new \App\Models\StafModel();

    // Gunakan query builder untuk melakukan join antara tabel 'staf' dan 'users'
    $builder = $stafModel->builder();
    // Pilih semua kolom dari staf dan ambil kolom role dari users sebagai 'jenis'
    $builder->select('staf.*, users.role as jenis');
    $builder->join('users', 'users.id = staf.id_user');
    
    // Ambil data sebagai array
    $data = $builder->get()->getResultArray();

    $operation['data'] = $data;
    $operation['title'] = 'Data Master Staf';
    $operation['sub_title'] = '';
    return view("masterstaf/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view('masterstaf/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
    
        // Hash password sebelum menyimpan
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
        // Simpan data pengguna ke tabel users
        $userModel = new \App\Models\UsersModel();
        $userModel->save([
            'email' => $data['email'],
            'username' => $data['username'],
            'password_hash' => $data['password_hash'],
            'role' => $data['role'],  // Atur role sesuai kebutuhan
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    
        // Ambil ID pengguna yang baru saja disimpan
        $userId = $userModel->insertID();
    
        // Simpan data staf ke tabel staf
        $stafModel = new StafModel();
        $stafModel->save([
            'id_user' => $userId, // Simpan ID pengguna yang baru
            'nama' => $data['nama'],
            'nip' => $data['nip'],
            'no_telp' => $data['no_telp'],
            'alamat' => $data['alamat'],

        ]);
    
        return redirect()->to('masterstaf');
    }

    public function edit($id)
    {
        $stafModel = new StafModel();
        $data['dataForm'] = $stafModel->withUser()->where('staf.id_staf', $id)->first();
    
        if (!$data['dataForm']) {
            return redirect()->to('masterstaf')->with('error', 'Data tidak ditemukan');
        }
    
        $data['title'] = 'Data Master Staf';
        $data['sub_title'] = '';
    
        return view('masterstaf/create', $data); // Pastikan $data dikirim ke view
    }
    

  
    public function update($id)
    {
        $data = $this->request->getPost();
    
        $stafModel = new StafModel();
        $userModel = new \App\Models\UsersModel();
    
        // Ambil data staf berdasarkan ID
        $staf = $stafModel->find($id);
        if (!$staf) {
            return redirect()->to('masterstaf')->with('error', 'Data staf tidak ditemukan.');
        }
    
        // Ambil ID user dari tabel staf
        $id_user = $staf->id_user; 
    
        // Data pengguna yang akan diperbarui
        $userData = [
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => $data['role'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        // Jika password diisi, update password
        if (!empty($data['password'])) {
            $userData['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    
        // Update data pengguna di tabel users
        $userModel->update($id_user, $userData);
    
        // Update data staf
        $stafData = [
            'nama' => $data['nama'],
            'nip' => $data['nip'],
            'no_telp' => $data['no_telp'],
            'alamat' => $data['alamat'],
        ];
        $stafModel->update($id, $stafData);
    
        return redirect()->to('masterstaf')->with('success', 'Data staf berhasil diperbarui.');
    }
    

    public function delete($id)
    {
        $staf = new StafModel();
        $staf->delete($id);
        return redirect()->to('masterstaf');
    }
}

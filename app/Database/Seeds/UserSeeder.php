<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data untuk Admin
        $adminData = [
            [
                'username' => 'admin123',
                'email'    => 'admin@gmail.com',
                'nama'     => 'Admin',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'role'     => 'Admin',
            ],
        ];

        // Data untuk Dosen
        $dosenData = [
            [
                'username' => 'dosen1',
                'email'    => 'dosen1@gmail.com',
                'nama'     => 'Dosen Pertama',
                'password_hash' => password_hash('dosen123', PASSWORD_BCRYPT),
                'role'     => 'Dosen',
            ],
            [
                'username' => 'dosen2',
                'email'    => 'dosen2@gmail.com',
                'nama'     => 'Dosen Kedua',
                'password_hash' => password_hash('dosen123', PASSWORD_BCRYPT),
                'role'     => 'Dosen',
            ],
        ];

        // Data untuk Mahasiswa
        $mahasiswaData = [
            [
                'username' => 'mahasiswa1',
                'email'    => 'mahasiswa1@gmail.com',
                'nama'     => 'Mahasiswa Pertama',
                'password_hash' => password_hash('mahasiswa123', PASSWORD_BCRYPT),
                'role'     => 'Mahasiswa',
            ],
            [
                'username' => 'mahasiswa2',
                'email'    => 'mahasiswa2@gmail.com',
                'nama'     => 'Mahasiswa Kedua',
                'password_hash' => password_hash('mahasiswa123', PASSWORD_BCRYPT),
                'role'     => 'Mahasiswa',
            ],
        ];

        // Data untuk Koordinator
        $koordinatorData = [
            [
                'username' => 'koordinator1',
                'email'    => 'koordinator1@gmail.com',
                'nama'     => 'Koordinator Pertama',
                'password_hash' => password_hash('koordinator123', PASSWORD_BCRYPT),
                'role'     => 'Koordinator',
            ],
            [
                'username' => 'koordinator2',
                'email'    => 'koordinator2@gmail.com',
                'nama'     => 'Koordinator Kedua',
                'password_hash' => password_hash('koordinator123', PASSWORD_BCRYPT),
                'role'     => 'Koordinator',
            ],
        ];

        // Menggunakan Query Builder untuk memasukkan data ke tabel users
        $this->db->table('users')->insertBatch($adminData);
        $this->db->table('users')->insertBatch($dosenData);
        $this->db->table('users')->insertBatch($mahasiswaData);
        $this->db->table('users')->insertBatch($koordinatorData);

        // Ambil semua user yang baru saja ditambahkan untuk digunakan di tabel mahasiswa dan staf
        $users = $this->db->table('users')->get()->getResult();

        // Data untuk Mahasiswa
        $mahasiswaDetails = [
            [
                'id_user' => $users[2]->id, // Menggunakan id dari user mahasiswa1
                'nama'    => 'Mahasiswa Pertama',
                'nim'     => '123456789',
                'prodi'   => 'Teknik Informatika',
                'no_telp' => '081234567890',
                'th_masuk'=> 2021,
                'th_lulus'=> 2025,
                'kelas'   => 'A',
                'status'   => 'Aktif',
            ],
            [
                'id_user' => $users[3]->id, // Menggunakan id dari user mahasiswa2
                'nama'    => 'Mahasiswa Kedua',
                'nim'     => '987654321',
                'prodi'   => 'Sistem Informasi',
                'no_telp' => '089876543210',
                'th_masuk'=> 2021,
                'th_lulus'=> 2025,
                'kelas'   => 'B',
                'status'   => 'Aktif',
            ],
        ];

        // Menggunakan Query Builder untuk memasukkan data ke tabel mahasiswa
        $this->db->table('mahasiswa')->insertBatch($mahasiswaDetails);

        // Data untuk Staf
        $stafDetails = [
            [
                'id_user' => $users[0]->id, // Menggunakan id dari user admin
                'nama'    => 'Staf Admin',
                'nip'     => '1234567890',
                'no_telp' => '081234567891',
                'alamat'  => 'Jl. Admin No. 1',
                'jenis'   => 'Admin',
                'status'  => '1',
            ],
            [
                'id_user' => $users[1]->id, // Menggunakan id dari user dosen1
                'nama'    => 'Staf Dosen',
                'nip'     => '0987654321',
                'no_telp' => '089876543211',
                'alamat'  => 'Jl. Dosen No. 2',
                'jenis'   => 'Dosen',
                'status'  => '1',
            ],
            [
                'id_user' => $users[4]->id, // Menggunakan id dari user koordinator1
                'nama'    => 'Staf Koordinator',
                'nip'     => '1122334455',
                'no_telp' => '081234567892',
                'alamat'  => 'Jl. Koordinator No. 3',
                'jenis'   => 'Koordinator',
                'status'  => '1',
            ],
        ];

        // Menggunakan Query Builder untuk memasukkan data ke tabel staf
        $this->db->table('staf')->insertBatch($stafDetails);
    }
}
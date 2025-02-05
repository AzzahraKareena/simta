<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
        'username' => 'admin123',
            'email'    => 'admin@gmail.com',
            'nama'   => 'Admin',
            'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
            'role'     => 'Admin',
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
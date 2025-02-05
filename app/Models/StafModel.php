<?php

namespace App\Models;

use CodeIgniter\Model;

class StafModel extends Model
{
    protected $table = 'staf';
    protected $primaryKey = 'id_staf';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['nama', 'nip', 'no_telp', 'alamat', 'id_user'];

    public function withUser()
    {
        return $this->select('staf.*, users.email, users.username, users.password_hash, users.role')
                    ->join('users', 'users.id = staf.id_user'); 
    }
    
    
}

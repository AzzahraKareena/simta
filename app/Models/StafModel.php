<?php

namespace App\Models;

use CodeIgniter\Model;

class StafModel extends Model
{
    protected $table = 'staf';
    protected $primaryKey = 'id_staf';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['id_staf', 'nama', 'nip'];
}

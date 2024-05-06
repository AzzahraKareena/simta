<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class MasterStafModel extends Model
{
    protected $table = 'simta_masterstaf'; // Ganti 'nama_tabel_timeline' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_masterstaf';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_masterstaf',
        'nama_staf',
        'nip',
        'no_telp',
        'alamat_staf',
        'jenis_staf',
    ];
  
}

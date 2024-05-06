<?php
namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class BerkasTAModel extends Model
{
    protected $uuidFields       = ['id_berkas'];
    protected $table            = 'simta_berkas';
    protected $primaryKey       = 'id_berkas';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_berkas', 'nama_berkas', 'file_berkas'];
}


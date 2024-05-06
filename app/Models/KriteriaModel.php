<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['id_kriteria', 'nama', 'jenis'];

    // Tambahkan metode sesuai kebutuhan

    public function getDataById($id_kriteria)
    {
        $builder = $this->db->table('kriteria');
        $builder->where('id_kriteria', $id_kriteria);
        return $builder->get()->getRow();
    }

    
}

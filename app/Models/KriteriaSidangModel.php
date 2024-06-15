<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class KriteriaSidangModel extends Model
{
    protected $table = 'simta_kriteria_sidang';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['id_kriteria', 'nama_kriteria'];
    // protected $allowedFields = ['id_kriteria', 'nama_kriteria', 'jenis'];

    // Tambahkan metode sesuai kebutuhan

    public function getDataById($id_kriteria)
    {
        $builder = $this->db->table('simta_kriteria_sidang');
        $builder->where('id_kriteria', $id_kriteria);
        return $builder->get()->getRow();
    }

    public function indikators()
    {
        return $this->hasMany('App\Models\IndikatorSidangModel', 'id_kriteria', 'id_kriteria');
    }
}

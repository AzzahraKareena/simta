<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class IndikatorModel extends Model
{
    protected $table = 'simta_indikator';
    protected $primaryKey = 'id_indikator';
    protected $allowedFields = ['id_indikator', 'id_kriteria', 'nama', 'max_nilai'];

    // Tambahkan metode sesuai kebutuhan

    public function getDataById($id_indikator)
    {
        $builder = $this->db->table('indikator');
        $builder->where('id_indikator', $id_indikator);
        return $builder->get()->getRow();
    }

    public function withKriteria()
    {
        return $this->join('simta_kriteria', 'simta_kriteria.id_kriteria = simta_indikator.id_kriteria');
    }

}
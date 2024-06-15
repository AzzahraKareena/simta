<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class IndikatorSidangModel extends Model
{
    protected $table = 'simta_indikator_sidang';
    protected $primaryKey = 'id_indikator';
    protected $allowedFields = ['id_indikator', 'id_kriteria', 'nama', 'max_nilai'];

    // Tambahkan metode sesuai kebutuhan

    public function getDataById($id_indikator)
    {
        $builder = $this->db->table('simta_indikator_sidang');
        $builder->where('id_indikator', $id_indikator);
        return $builder->get()->getRow();
    }

    public function withKriteria()
    {
        return $this->join('simta_kriteria_sidang as kriteria', 'kriteria.id_kriteria = simta_indikator_sidang.id_kriteria');
    }

    public function getKriteria()
    {
        return $this->select('simta_indikator_sidang.*, kriteria.nama_kriteria as kriteria_nama_kriteria')
                    ->withKriteria()
                    ->findAll();
    }

}
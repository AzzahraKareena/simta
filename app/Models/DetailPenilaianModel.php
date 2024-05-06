<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenilaianModel extends Model
{
    protected $table = 'detail_penilaian';
    protected $primaryKey = 'id_detail_penilaian';
    protected $allowedFields = ['id_detail_penilaian', 'id_indikator', 'nilai'];

    // Tambahkan metode sesuai kebutuhan

    public function getDataById($id_detail_penilaian)
    {
        $builder = $this->db->table('detail_penilaian');
        $builder->where('id_detail_penilaian', $id_detail_penilaian);
        return $builder->get()->getRow();
    }

    // Anda dapat menambahkan metode lain sesuai kebutuhan aplikasi Anda
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class RevisiSemhasModel extends Model
{
    protected $table = 'simta_revisi_semhas';
    protected $primaryKey = 'id_revisi_semhas';
    protected $allowedFields = ['id_rilis_jadwal_semhas', 'id_penguji', 'catatan_revisi', 'created_at'];


}
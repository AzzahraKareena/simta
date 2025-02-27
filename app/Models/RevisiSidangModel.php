<?php namespace App\Models;

use CodeIgniter\Model;

class RevisiSidangModel extends Model
{
    protected $table = 'simta_revisi_sidang';
    protected $primaryKey = 'id_revisi_sidang';
    protected $allowedFields = ['id_rilis_jadwal_sidang', 'id_penguji', 'catatan_revisi', 'created_at'];
    

}
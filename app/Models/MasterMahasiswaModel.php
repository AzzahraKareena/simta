<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class MasterMahasiswaModel extends Model
{
    protected $table = 'simta_master_mahasiswa'; // Ganti 'nama_tabel_timeline' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_master_mahasiswa';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_master_mahasiswa',
        'nama_mahasiswa',
        'nim',
        'prodi',
        'nomor_telp',
        'tahun_masuk',
        'tahun_lulus',
        'kelas',
        'status',
    ];
  
}

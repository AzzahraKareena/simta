<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class TimelineModel extends Model
{
    protected $table = 'simta_timeline'; // Ganti 'nama_tabel_timeline' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_timeline';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_timeline',
        'tahun',
        'nama',
        'pengajuan_judul_start',
        'pengajuan_judul_end',
        'pengajuan_bimbingan_start',
        'pengajuan_bimbingan_end',
        'sempro_start',
        'sempro_end',
        'semhas_start',
        'semhas_end',
        'sidang_start',
        'sidang_end',
        'pengumpulan_syarat_start',
        'pengumpulan_syarat_end'
    ];

    protected $validationRules = [
        'tahun' => 'required',
        'nama' => 'required',
        'pengajuan_judul_start' => 'required',
        'pengajuan_judul_end' => 'required',
        'pengajuan_bimbingan_start' => 'required',
        'pengajuan_bimbingan_end' => 'required',
        'sempro_start' => 'required',
        'sempro_end' => 'required',
        'semhas_start' => 'required',
        'semhas_end' => 'required',
        'sidang_start' => 'required',
        'sidang_end' => 'required',
        'pengumpulan_syarat_start' => 'required',
        'pengumpulan_syarat_end' => 'required'
    ];
}

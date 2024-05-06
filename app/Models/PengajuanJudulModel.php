<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanJudulModel extends Model
{
    protected $table = 'simta_pengajuanjudul'; // Ganti 'nama_tabel_pengajuanjudul' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_pengajuanjudul';
    // protected $returnType = 'object';
    protected $allowedFields = [
        'id_pengajuanjudul',
        'id_mhs',
        'nama_judul1',
        'deskripsi_sistem1',
        'nama_judul2',
        'deskripsi_sistem2',
        'nama_judul3',
        'deskripsi_sistem3',
        'status_pj',
        'created_at',
        'updated_at',
        'id_timeline',
        'id_rekom_dospem1',
        'id_rekom_dospem2',
        'id_dospem',
        'updated_by',
        'acc_judul',
        'acc_deskripsi'
    ];

    // protected $validationRules = [
    //     'id_mhs' => 'required',
    //     'nama_judul1' => 'required',
    //     'deskripsi_sistem1' => 'required',
    //     'nama_judul2' => 'required',
    //     'deskripsi_sistem2' => 'required',
    //     'nama_judul3' => 'required',
    //     'deskripsi_sistem3' => 'required',
    //     'catatan' => 'required',
    //     'status_pj' => 'required',
    //     'id_timeline' => 'required',
    //     'id_rekom_dospem1' => 'required',
    //     'id_rekom_dospem2' => 'required',
    //     'id_dospem' => 'required',
    //     'updated_by' => 'required',
    //     'acc_judul' => 'required',
    //     'acc_deskripsi' => 'required'
    // ];
}

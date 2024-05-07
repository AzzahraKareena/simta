<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanBimbinganModel extends Model
{
    protected $table = 'simta_pengajuanbimbingan'; // Ganti 'nama_tabel_pengajuanbimbingan' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_pengajuanbimbingan';
    protected $allowedFields = [
        'id_pengajuanbimbingan',
        'id_mhs',
        'id_staf',
        'lokasi_bimbingan',
        'hasil_bimbingan',
        'status_ajuan',
        'created_at',
        'updated_at',
        'waktu_bimbingan',
        'jadwal_bimbingan',
        'agenda',
        'id_acc_judul'
    ];

    // Jika Anda memiliki aturan validasi, Anda dapat mendefinisikannya di sini
    // protected $validationRules = [
    //     'id_mhs' => 'required',
    //     'id_staf' => 'required',
    //     'lokasi_bimbingan' => 'required',
    //     'hasil_bimbingan' => 'required',
    //     'status_ajuan' => 'required',
    //     'waktu_bimbingan' => 'required',
    //     'jadwal_bimbingan' => 'required',
    //     'agenda' => 'required',
    //     'id_acc_judul' => 'required'
    // ];
}

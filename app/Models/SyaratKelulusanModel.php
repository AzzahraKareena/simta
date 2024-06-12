<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class SyaratKelulusanModel extends Model
{
    protected $table = 'simta_syarat_kelulusan'; // Ganti 'nama_tabel_pengajuanjudul' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_syarat_kelulusan';
    // protected $returnType = 'object';
    protected $allowedFields = [
        'id_syarat_kelulusan',
        'id_mhs',
        'poster',
        'lembar_pengesahan',
        'lembar_persetujuan',
        'bukti_pelunasan_ukt',
        'surat_bebas_lab',
        'aplikasi_ta',
        'laporan_ta_pdf',
        'status_syarat'
    ];

}

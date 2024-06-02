<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanSidangModel extends Model
{
    protected $table = 'simta_pengajuan_sidang';
    protected $primaryKey = 'id_sidang';
    protected $allowedFields = [
        'id_sidang',
        'id_mhs',
        'id_dospem',
        'id_pengajuanjudul',
        'abstrak',
        'revisi_laporan',
        'laporan_ta',
        'revisi_laporan_date',
        'ajuan_tgl_ujian',
        'status_pengajuan',
        'id_penguji1',
        'id_penguji2',
        'transkrip_nilai',
        'beritaacara_kmm',
        'surat_rekomendasi',
        'krs'
    ];
}
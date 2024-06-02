<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanSeminarHasilModel extends Model
{
    protected $table = 'simta_pengajuan_seminarhasil';
    protected $primaryKey = 'id_seminarhasil';
    protected $allowedFields = [
        'id_seminarhasil',
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
        'id_penguji2'
    ];
}
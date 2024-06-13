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
        'id_accjudul',
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

    public function getMhs() 
    {
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_pengajuan_sidang.*')
            ->join('users', 'simta_pengajuan_sidang.id_mhs=users.id')
            ->join('mahasiswa', 'users.id=mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_sidang.id_accjudul=simta_acc_judul.id_accjudul')
            ->where('status_pengajuan', 'PENDING')
            ->findAll();
    }
}
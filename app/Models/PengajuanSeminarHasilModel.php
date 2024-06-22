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
        'id_accjudul',
        'abstrak',
        'revisi_laporan',
        'laporan_ta',
        'revisi_laporan_date',
        'ajuan_tgl_ujian',
        'status_pengajuan',
        'id_penguji1',
        'id_penguji2'
    ];

    public function getMhs() 
    {
        return $this->select('simta_pengajuan_seminarhasil.*, mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_acc_judul.dospem_acc as dospem')
            ->join('users', 'simta_pengajuan_seminarhasil.id_mhs = users.id')
            ->join('mahasiswa', 'users.id = mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_seminarhasil.id_accjudul = simta_acc_judul.id_accjudul')
            ->findAll();
    }
    
}
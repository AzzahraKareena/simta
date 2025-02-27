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
        'status_laporan',
        'id_penguji1',
        'id_penguji2',
        'transkrip_nilai',
        'beritaacara_kmm',
        'surat_rekomendasi',
        'krs'
    ];

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_pengajuan_sidang.id_mhs')
        ->join('mahasiswa', 'mhs.id=mahasiswa.id_user');
    }

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_pengajuan_sidang.id_accjudul');
    }

    public function getMhs($id = null) 
    {
        $query = $this->select('simta_pengajuan_sidang.*, mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_pengajuan_sidang.*')
                ->join('users', 'simta_pengajuan_sidang.id_mhs=users.id')
                ->join('mahasiswa', 'users.id=mahasiswa.id_user')
                ->join('simta_acc_judul', 'simta_pengajuan_sidang.id_accjudul=simta_acc_judul.id_accjudul');

        if ($id !== null) {
            $query->where('simta_pengajuan_sidang.id_sidang', $id);
        }

        return $query->first();
    }

    public function getAllPengajuanWithJadwal($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('simta_pengajuan_sidang.*, mhs.nama as nama_mhs, judulacc.judul_acc as judul, simta_rilis_jadwal_sidang.id_rilis_jadwal_sidang as jadwal_id')
                    ->join('simta_rilis_jadwal_sidang', 'simta_pengajuan_sidang.id_sidang = simta_rilis_jadwal_sidang.id_pengajuansidang', 'left')
                    ->withMhs()
                    ->withJudul()
                    ->where('mahasiswa.th_lulus', $tahun)
                    ->findAll();
    }
}
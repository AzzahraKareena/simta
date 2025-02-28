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
        'status_laporan',
        'id_penguji1',
        'id_penguji2'
    ];

    // public function getMhs() 
    // {
    //     return $this->select('simta_pengajuan_seminarhasil.*, mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_acc_judul.dospem_acc as dospem')
    //         ->join('users', 'simta_pengajuan_seminarhasil.id_mhs = users.id')
    //         ->join('mahasiswa', 'users.id = mahasiswa.id_user')
    //         ->join('simta_acc_judul', 'simta_pengajuan_seminarhasil.id_accjudul = simta_acc_judul.id_accjudul')
    //         ->findAll();
    // }

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_pengajuan_seminarhasil.id_mhs')
            ->join('mahasiswa', 'mhs.id=mahasiswa.id_user');
    }

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_pengajuan_seminarhasil.id_accjudul');
    }

    public function getMhs($id = null)
    {
        $query = $this->select('simta_pengajuan_seminarhasil.*, mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_acc_judul.dospem_acc as dospem_acc, dosen.nama as nama_dosen, dosen.nip as nip_pembimbing') //perubahan disini, sblm = $this->select('simta_pengajuan_seminarhasil.*, mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_acc_judul.dospem_acc as dospem, dosen.nama as nama_pembimbing, s1.nip as nip_pembimbing')
            ->join('users', 'simta_pengajuan_seminarhasil.id_mhs = users.id')
            ->join('mahasiswa', 'users.id = mahasiswa.id_user')
            ->join('staf as dosen', 'simta_pengajuan_seminarhasil.id_dospem=dosen.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_seminarhasil.id_accjudul = simta_acc_judul.id_accjudul');

        if ($id !== null) {
            $query->where('simta_pengajuan_seminarhasil.id_seminarhasil', $id);
        }

        return $query->first();
    }


    public function getAllPengajuanWithJadwal($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('simta_pengajuan_seminarhasil.*, mhs.nama as nama_mhs, judulacc.judul_acc as judul, simta_rilis_jadwal_semhas.id_rilis_jadwal_semhas as jadwal_id')
            ->join('simta_rilis_jadwal_semhas', 'simta_pengajuan_seminarhasil.id_seminarhasil = simta_rilis_jadwal_semhas.id_pengajuansemhas', 'left')
            ->withMhs()
            ->withJudul()
            ->where('mahasiswa.th_lulus', $tahun)
            ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class JadwalUjianPropoModel extends Model
{
    protected $table = 'simta_rilis_jadwal';
    protected $primaryKey = 'id_rilis_jadwal';
    protected $allowedFields = [
        'ruangan',
        'jam_start',
        'jam_end',
        'tgl_ujian',
        'id_penguji1',
        'id_penguji2',
        'id_pengajuanujianpropo',
    ];

    public function getJadwal($tahun = null) 
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim,  mahasiswa.prodi as prodi, u3.id as id_mhs, u1.nama as penguji1, u2.nama as penguji2, simta_acc_judul.judul_acc as judul, simta_rilis_jadwal.*')
            ->join('users as u1', 'simta_rilis_jadwal.id_penguji1=u1.id')
            ->join('users as u2', 'simta_rilis_jadwal.id_penguji2=u2.id')
            ->join('simta_pengajuan_ujianproposal', 'simta_rilis_jadwal.id_pengajuanujianpropo=simta_pengajuan_ujianproposal.id_ujianproposal')
            ->join('users as u3', 'simta_pengajuan_ujianproposal.mahasiswa=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_ujianproposal.judul_acc_id=simta_acc_judul.id_accjudul')
            ->where('mahasiswa.th_lulus', $tahun)
            ->findAll();
    }

    public function getBeritaAcara($id) 
    {
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim,  mahasiswa.prodi as prodi, u3.id as id_mhs, u1.nama as penguji1, u2.nama as penguji2, s1.nip as nip_penguji1, s2.nip as nip_penguji2, simta_acc_judul.judul_acc as judul, simta_pengajuan_ujianproposal.*, simta_rilis_jadwal.*')
            ->join('users as u1', 'simta_rilis_jadwal.id_penguji1=u1.id')
            ->join('users as u2', 'simta_rilis_jadwal.id_penguji2=u2.id')
            ->join('simta_pengajuan_ujianproposal', 'simta_rilis_jadwal.id_pengajuanujianpropo=simta_pengajuan_ujianproposal.id_ujianproposal')
            ->join('users as u3', 'simta_pengajuan_ujianproposal.mahasiswa=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('staf as s1', 'u1.id=s1.id_user')
            ->join('staf as s2', 'u2.id=s2.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_ujianproposal.judul_acc_id=simta_acc_judul.id_accjudul')
            ->find($id);
    }
}

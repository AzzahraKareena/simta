<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class JadwalSemhasModel extends Model
{
    protected $table = 'simta_rilis_jadwal_semhas';
    protected $primaryKey = 'id_rilis_jadwal_semhas';
    protected $allowedFields = [
        'ruangan',
        'jam_start',
        'jam_end',
        'tgl_ujian',
        'id_penguji1',
        'id_penguji2',
        'id_pengajuansemhas',
    ];

    public function getJadwal($tahun = null) 
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim,  mahasiswa.prodi as prodi, u3.id as id_mhs, u1.nama as penguji1, simta_acc_judul.judul_acc as judul, simta_rilis_jadwal_semhas.*')
            ->join('users as u1', 'simta_rilis_jadwal_semhas.id_penguji1=u1.id')
            // ->join('users as u2', 'simta_rilis_jadwal_semhas.id_penguji2=u2.id')
            ->join('simta_pengajuan_seminarhasil', 'simta_rilis_jadwal_semhas.id_pengajuansemhas=simta_pengajuan_seminarhasil.id_seminarhasil')
            ->join('users as u3', 'simta_pengajuan_seminarhasil.id_mhs=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_seminarhasil.id_accjudul=simta_acc_judul.id_accjudul')
            ->where('mahasiswa.th_lulus', $tahun)
            ->findAll();
    }

    public function getBeritaAcara($id) 
    {
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim,  mahasiswa.prodi as prodi, u3.id as id_mhs, u1.nama as penguji1, s1.nip as nip_penguji1, simta_acc_judul.judul_acc as judul, dosen.nama, simta_pengajuan_seminarhasil.*, simta_rilis_jadwal_semhas.*')
            ->join('users as u1', 'simta_rilis_jadwal_semhas.id_penguji1=u1.id')
            // ->join('users as u2', 'simta_rilis_jadwal_semhas.id_penguji2=u2.id')
            ->join('simta_pengajuan_seminarhasil', 'simta_rilis_jadwal_semhas.id_pengajuansemhas=simta_pengajuan_seminarhasil.id_seminarhasil')
            ->join('users as u3', 'simta_pengajuan_seminarhasil.id_mhs=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('staf as s1', 'u1.id=s1.id_user')
            // ->join('staf as s2', 'u2.id=s2.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_seminarhasil.id_accjudul=simta_acc_judul.id_accjudul')
            ->join('users as dosen', 'simta_acc_judul.dospem_acc=dosen.id')
            ->find($id);
    }

    public function getPersetujuan($id) 
    {
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, dosen.nama as nama_pembimbing, s1.nip as nip_pembimbing, simta_rilis_jadwal_semhas.*')
            ->join('simta_pengajuan_seminarhasil', 'simta_rilis_jadwal_semhas.id_pengajuansemhas=simta_pengajuan_seminarhasil.id_seminarhasil')
            ->join('users as u3', 'simta_pengajuan_seminarhasil.id_mhs=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_seminarhasil.id_accjudul=simta_acc_judul.id_accjudul')
            ->join('users as dosen', 'simta_acc_judul.dospem_acc=dosen.id')
            ->join('staf as s1', 'dosen.id=s1.id_user')
            ->find($id);
    }
}

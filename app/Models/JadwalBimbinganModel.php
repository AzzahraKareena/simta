<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalBimbinganModel extends Model
{
    protected $table = 'simta_jadwal_bimbingan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_dosen', 'tanggal', 'waktu', 'tempat', 'created_at', 'updated_at'];

    public function getJadwalBimbinganByDospem($id_dosen, $tahun)
    {
        return $this->db->table('simta_mahasiswa_bimbingan as mb')
            ->select('mb.id_mahasiswa_bimbingan, mb.judul_acc_id, mb.tracking, j.id AS id_jadwal_bimbingan, j.tanggal, j.waktu, j.tempat, a.dospem_acc as id_dosen, a.mhs_id as id_mahasiswa')
            ->join('simta_acc_judul as a', 'mb.judul_acc_id = a.id_accjudul', 'left') 
            ->join('simta_jadwal_bimbingan as j', 'j.id_dosen = a.dospem_acc', 'left') // Pastikan join ini benar
            ->where('a.dospem_acc', $id_dosen)
            ->where('YEAR(j.tanggal)', $tahun)
            ->groupBy('j.id') // Mengelompokkan berdasarkan ID jadwal
            ->orderBy('j.tanggal, j.waktu')     
            ->get()
            ->getResultArray();
    }

    public function getAllJadwalBimbingan()
    {
        return $this->db->table('simta_jadwal_bimbingan as j')
            ->select('j.id AS id_jadwal_bimbingan, j.tanggal, j.waktu, j.tempat, dosen.nama as nama_dosen')
            ->join('users as dosen', 'j.id_dosen = dosen.id', 'left')
            ->orderBy('j.tanggal, j.waktu')
            ->get()
            ->getResultArray();
    }
}
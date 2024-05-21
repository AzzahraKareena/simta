<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanBimbinganModel extends Model
{
    protected $table = 'simta_pengajuanbimbingan'; // Ganti 'nama_tabel_pengajuanbimbingan' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_pengajuanbimbingan';
    protected $allowedFields = [
        'id_pengajuanbimbingan',
        'id_mhs',
        'id_staf',
        'lokasi_bimbingan',
        'hasil_bimbingan',
        'status_ajuan',
        'created_at',
        'updated_at',
        'waktu_bimbingan',
        'jadwal_bimbingan',
        'agenda',
        'tracking',
        'id_accjudul'
    ];

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_pengajuanbimbingan.id_mhs');
    }

    public function withStaff()
    {
        return $this->join('users as staff', 'staff.id = simta_pengajuanbimbingan.id_staf');
    }

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_pengajuanbimbingan.id_accjudul');
    }

    public function getPengajuan()
    {
        return $this->select('simta_pengajuanbimbingan.*, mhs.nama as mahasiswa_nama, staff.nama as staff_nama,  judulacc.judul_acc as judul_judul_acc')
                    ->withMhs()
                    ->withStaff()
                    ->withJudul()
                    ->findAll();
    }
}

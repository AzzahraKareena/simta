<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PenilaianSidangModel extends Model
{
    protected $table = 'simta_penilaian_sidang';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_penilaian', 'id_staf', 'id_mhs', 'nilai_total', 'created_at', 'updated_at', 'id_rilis_jadwal'];

    // Tambahkan metode sesuai kebutuhan


    public function withStaff()
    {
        return $this->join('users as staff', 'staff.id = simta_penilaian_sidang.id_staf');
    }

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_penilaian_sidang.id_mhs');
    }
    
    
    public function rilisJadwal()
    {
        return $this->join('simta_rilis_jadwal_sidang as jdw', 'jdw.id_rilis_jadwal_sidang = simta_penilaian_sidang.id_rilis_jadwal')
        ->join('simta_pengajuan_sidang', 'jdw.id_pengajuansidang=simta_pengajuan_sidang.id_sidang')
        ->join('users as pembimbing', 'pembimbing.id = simta_pengajuan_sidang.id_dospem')
        ->join('simta_acc_judul as judul', 'simta_pengajuan_sidang.id_accjudul=judul.id_accjudul');
    }


    public function getKriteria()
    {
        return $this->select('simta_penilaian_sidang.*,pembimbing.nama as dospem_nama, judul.judul_acc as judul_judul_acc, jdw.tgl_ujian as jadwal, mhs.nama as mhs_nama, staff.nama as staff_nama')
                    ->withStaff()
                    ->withMhs()
                    ->rilisJadwal()
                    ->findAll();
    }

}
<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class RekapNilaiModel extends Model
{
    protected $table = 'simta_rekap_nilai';
    protected $primaryKey = 'id_rekap';
    protected $allowedFields = ['id_rekap', 'mahasiswa_id', 'total_nilai', 'judul_id'];

    // Tambahkan metode sesuai kebutuhan


    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_rekap_nilai.id_mhs');
    }

    public function judulAcc()
    {
        return $this->join('simta_acc_judul as judul', 'judul.id_accjudul = simta_rekap_nilai.judul_id');
    }

    public function getRekap()
    {
        return $this->select('simta_rekap_nilai.*, mhs.nama as mhs_nama, judul.judul_acc as jdw')
                    ->withMhs()
                    ->judulAcc()
                    ->findAll();
    }

}
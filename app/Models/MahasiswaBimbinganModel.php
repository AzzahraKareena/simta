<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaBimbinganModel extends Model
{
    protected $table            = 'simta_mahasiswa_bimbingan';
    protected $primaryKey       = 'id_mahasiswa_bimbingan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['judul_acc_id', 'tracking']; // Remove 'id_mahasiswa_bimbingan'
    
    // Remove the validation rule for 'id_mahasiswa_bimbingan'
    protected $validationRules = [
        'judul_acc_id' => 'required',
        'tracking' => 'required'
    ];

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_mahasiswa_bimbingan.judul_acc_id')
                    ->join('users as staf', 'staf.id = judulacc.dospem_acc')
                    ->join('users as mhs', 'mhs.id = judulacc.mhs_id')
                    ->join('mahasiswa as mh', 'mhs.id = mh.id_user');
    }

    public function getAllMahasiswaBimbingan()
    {
        return $this->select('simta_mahasiswa_bimbingan.*, mh.nama as mahasiswa_nama, mh.th_lulus as angkatan, judulacc.judul_acc as judul_acc, staf.nama as dospem_nama')
                    ->withJudul()
                    ->findAll();
    }

    public function getUserByDosen($dosenId, $tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('simta_mahasiswa_bimbingan.*, mh.nama as mahasiswa_nama, mh.th_lulus as angkatan, judulacc.judul_acc as judul_acc, staf.nama as dospem_nama')
                    ->withJudul()
                    ->where('judulacc.dospem_acc', $dosenId)
                    ->where('mh.th_lulus', $tahun)
                    ->findAll();
    }

    public function updateTrackingByJudulAccId($judulAccId, $newTracking)
    {
        return $this->where('judul_acc_id', $judulAccId)->set(['tracking' => $newTracking])->update();
    }

    public function getAllBimbingan()
    {
        return $this->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaBimbinganModel extends Model
{
    protected $table            = 'simta_mahasiswa_bimbingan';
    protected $primaryKey       = 'id_mahasiswa_bimbingan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_mahasiswa_bimbingan', 'mahasiswa_id', 'judul_acc_id', 'tracking', 'dospem_id'];
    
    protected $validationRules = [
        'id_mahasiswa_bimbingan' => 'required'
    ];

    // public function withMhs()
    // {
    //     return $this->join('mahasiswa as mhs', 'mhs.id_mhs = simta_mahasiswa_bimbingan.mahasiswa_id');
    // }

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_mahasiswa_bimbingan.judul_acc_id')
                    ->join('users as staf', 'staf.id = judulacc.dospem_acc')
                    ->join('users as mhs', 'mhs.id = judulacc.mhs_id')
                    ->join('mahasiswa as mh', 'mhs.id = mh.id_user');
    }

    // public function withDospem()
    // {
    //     return $this->join('simta_acc_judul as dospem', 'dospem.id_accjudul = simta_mahasiswa_bimbingan.dospem_id')
    //                 ->join('users as staf', 'staf.id = dospem.dospem_acc');
    // }

    public function getUser()
    {
        return $this->select('simta_mahasiswa_bimbingan.*, mh.nama as mahasiswa_nama, mh.th_lulus as angkatan, judulacc.judul_acc as judul_acc, staf.nama as dospem_nama')
                    // ->withMhs()
                    ->withJudul()
                    // ->withDospem()
                    ->findAll();
    }
}

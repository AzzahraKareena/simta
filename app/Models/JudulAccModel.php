<?php 

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class JudulAccModel extends Model
{
    protected $table = 'simta_acc_judul'; 
    protected $primaryKey = 'id_accjudul';
    protected $allowedFields = [
        'id_accjudul',
        'judul_acc',
        'dospem_acc',
        'mhs_id',
        'keterangan',
    ];

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_acc_judul.mhs_id');
    }

    public function withDospem()
    {
        return $this->join('users as dospem', 'dospem.id = simta_acc_judul.dospem_acc');
    }

    // public function withJudul()
    // {
    //     return $this->join('simta_pengajuanjudul as judul', 'judul.id = simta_acc_judul.dospem_acc');
    // }

    public function getPengajuan()
    {
        return $this->select('simta_acc_judul.*, mhs.nama as mahasiswa_nama, dospem.nama as dospem_nama')
                    ->withMhs()
                    ->withDospem()
                    ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanJudulModel extends Model
{
    protected $table = 'simta_pengajuanjudul'; // Ganti 'nama_tabel_pengajuanjudul' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_pengajuanjudul';
    // protected $returnType = 'object';
    protected $allowedFields = [
        'id_pengajuanjudul',
        'id_mhs',
        'nama_judul1',
        'deskripsi_sistem1',
        'nama_judul2',
        'deskripsi_sistem2',
        'nama_judul3',
        'deskripsi_sistem3',
        'status_pj',
        'created_at',
        'updated_at',
        'id_timeline',
        'id_rekom_dospem1',
        'id_rekom_dospem2',
        'id_dospem',
        'updated_by',
        'acc_judul',
        'acc_deskripsi'
    ];

    public function getDataById($id_pengajuanjudul)
    {
        $builder = $this->db->table('simta_pengajuanjudul');
        $builder->where('id_pengajuanjudul', $id_pengajuanjudul);
        return $builder->get()->getRow();
    }

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_pengajuanjudul.id_mhs');
    }

    public function withDospem1()
    {
        return $this->join('users as dospem1', 'dospem1.id = simta_pengajuanjudul.id_rekom_dospem1');
    }

    public function withDospem2()
    {
        return $this->join('users as dospem2', 'dospem2.id = simta_pengajuanjudul.id_rekom_dospem2');
    }

    public function getPengajuan()
    {
        return $this->select('simta_pengajuanjudul.*, mhs.nama as mahasiswa_nama, dospem1.nama as dospem1_nama, dospem2.nama as dospem2_nama')
                    ->withMhs()
                    ->withDospem1()
                    ->withDospem2()
                    ->findAll();
    }
}

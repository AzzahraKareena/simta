<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PenilaianProposalModel extends Model
{
    protected $table = 'simta_penilaian_ujianproposal';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_penilaian', 'id_staf', 'id_mhs', 'id_pengajuanjudul', 'nilai_total', 'created_at', 'updated_at', 'id_rilis_jadwal'];

    // Tambahkan metode sesuai kebutuhan


    public function withStaff()
    {
        return $this->join('users as staff', 'staff.id = simta_penilaian_ujianproposal.id_staf');
    }

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_penilaian_ujianproposal.id_mhs');
    }
    
    
    public function rilisJadwal()
    {
        return $this->join('simta_rilis_jadwal as jdw', 'jdw.id_rilis_jadwal = simta_penilaian_ujianproposal.id_rilis_jadwal')
        ->join('simta_pengajuan_ujianproposal', 'jdw.id_pengajuanujianpropo=simta_pengajuan_ujianproposal.id_ujianproposal')
        ->join('users as pembimbing', 'pembimbing.id = simta_pengajuan_ujianproposal.id_dospem')
        ->join('simta_acc_judul as judul', 'simta_pengajuan_ujianproposal.judul_acc_id=judul.id_accjudul');
    }


    public function getKriteria()
    {
        return $this->select('simta_penilaian_ujianproposal.*,pembimbing.nama as dospem_nama, judul.judul_acc as judul_judul_acc, jdw.tgl_ujian as jadwal, mhs.nama as mhs_nama, staff.nama as staff_nama')
                    ->withStaff()
                    ->withMhs()
                    ->rilisJadwal()
                    ->findAll();
    }

}
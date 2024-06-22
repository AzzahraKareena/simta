<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PengajuanUjianProposalModel extends Model
{
    protected $table = 'simta_pengajuan_ujianproposal';
    protected $primaryKey = 'id_ujianproposal';
    protected $allowedFields = [
        'id_ujianproposal',
        'judul_acc_id',
        'mahasiswa',
        'id_dospem',
        'abstrak',
        'revisi_proposal',
        'proposal_ta',
        'revisi_proposal_date',
        'ajuan_tgl_ujian',
        'status_pengajuan',
        'status_ajuan_revisi',
        'jadwal'
    ];

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_pengajuan_ujianproposal.mahasiswa');
    }

    public function withDospem()
    {
        return $this->join('users as dospem', 'dospem.id = simta_pengajuan_ujianproposal.id_dospem');
    }

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_pengajuan_ujianproposal.judul_acc_id');
    }

    public function getPengajuan()
    {
        return $this->select('simta_pengajuanbimbingan.*, mhs.nama as mahasiswa_nama, dospem.nama as dospem_nama,  judulacc.judul_acc as judul')
                    ->withMhs()
                    ->withDospem()
                    ->withPenguji1()
                    ->withPenguji2()
                    ->withJudul()
                    ->findAll();
    }

    public function getMhs() 
    {
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, simta_acc_judul.judul_acc as judul, simta_pengajuan_ujianproposal.*')
            ->join('users', 'simta_pengajuan_ujianproposal.mahasiswa=users.id')
            ->join('mahasiswa', 'users.id=mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_ujianproposal.judul_acc_id=simta_acc_judul.id_accjudul')
            ->where('status_pengajuan', 'PENDING')
            ->findAll();
    }

    public function getAllPengajuanWithJadwal()
    {
        return $this->select('simta_pengajuan_ujianproposal.*, mhs.nama as nama_mhs, judulacc.judul_acc as judul, simta_rilis_jadwal.id_rilis_jadwal as jadwal_id')
                    ->join('simta_rilis_jadwal', 'simta_pengajuan_ujianproposal.id_ujianproposal = simta_rilis_jadwal.id_pengajuanujianpropo', 'left')
                    ->withMhs()
                    ->withJudul()
                    ->findAll();
    }

    // public function getPengajuanForBeritaAcara($id)
    // {
    //     return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim, mahasiswa.prodi as prodi, u1.nama as penguji1, u2.nama as penguji2, simta_acc_judul.judul_acc as judul, simta_pengajuan_ujianproposal.*, simta_rilis_jadwal.*')
    //                 ->join('simta_rilis_jadwal', 'simta_pengajuan_ujianproposal.id_ujianproposal = simta_rilis_jadwal.id_pengajuanujianpropo')
    //                 ->join('users as u1', 'simta_rilis_jadwal.id_penguji1=u1.id')
    //                 ->join('users as u2', 'simta_rilis_jadwal.id_penguji2=u2.id')
    //                 ->join('users', 'simta_pengajuan_ujianproposal.mahasiswa=users.id')
    //                 ->join('mahasiswa', 'users.id=mahasiswa.id_user')
    //                 ->join('simta_acc_judul', 'simta_pengajuan_ujianproposal.judul_acc_id=simta_acc_judul.id_accjudul')
    //                 ->find($id);
    // }

}

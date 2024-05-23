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

    // Jika Anda memiliki aturan validasi, Anda dapat mendefinisikannya di sini
    // protected $validationRules = [
    //     'id_mhs' => 'required',
    //     'id_dospem' => 'required',
    //     'abstrak' => 'required',
    //     'revisi_proposal' => 'required',
    //     'proposal_ta' => 'required',
    //     'revisi_proposal_date' => 'required',
    //     'ajuan_tgl_ujian' => 'required',
    //     'status_pengajuan' => 'required',
    //     'id_penguji1' => 'required',
    //     'id_penguji2' => 'required'
    // ];

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_pengajuan_ujian_proposal.mahasiswa');
    }

    public function withDospem()
    {
        return $this->join('users as dospem', 'dospem.id = simta_pengajuan_ujian_proposal.id_dospem');
    }

    // public function withPenguji1()
    // {
    //     return $this->join('users as penguji1', 'penguji1.id = simta_pengajuan_ujian_proposal.id_penguji1');
    // }
    // public function withPenguji2()
    // {
    //     return $this->join('users as penguji2', 'penguji2.id = simta_pengajuan_ujian_proposal.id_penguji2');
    // }

    public function withJudul()
    {
        return $this->join('simta_acc_judul as judulacc', 'judulacc.id_accjudul = simta_pengajuan_ujian_proposal.judul_acc_id');
    }

    public function getPengajuan()
    {
        return $this->select('simta_pengajuanbimbingan.*, mhs.nama as mahasiswa_nama, dospem.nama as dospem_nama,  judulacc.judul_acc as judul_judul_acc')
                    ->withMhs()
                    ->withDospem()
                    ->withPenguji1()
                    ->withPenguji2()
                    ->withJudul()
                    ->findAll();
    }
}

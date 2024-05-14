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
        'id_mhs',
        'id_dospem',
        'abstrak',
        'revisi_proposal',
        'proposal_ta',
        'revisi_proposal_date',
        'ajuan_tgl_ujian',
        'status_pengajuan',
        'status_ajuan_revisi',
        'id_penguji1',
        'id_penguji2',
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
}

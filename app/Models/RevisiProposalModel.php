<?php

namespace App\Models;

use CodeIgniter\Model;

class RevisiProposalModel extends Model
{
    protected $table = 'simta_revisi_proposal';
    protected $primaryKey = 'id_revisi_proposal';
    protected $allowedFields = ['id_rilis_jadwal', 'id_penguji', 'catatan_revisi', 'created_at'];


}
<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class TimelineModel extends Model
{
    protected $table = 'simta_timeline'; 
    protected $primaryKey = 'id_timeline';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_timeline',
        'nama_kegiatan',
        'mulai',
        'akhir',
        'tahun'
    ];

    protected $validationRules = [
        'nama_kegiatan' => 'required',
        'mulai' => 'required',
        'akhir' => 'required',
        'tahun' => 'required'
    ];
}

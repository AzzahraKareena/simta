<?php

namespace App\Models;

use CodeIgniter\Model;

class MengelolaSuratModel extends Model
{
    protected $table = 'simta_mengelola_surat';
    protected $primaryKey = 'id_surat';
    protected $allowedFields = ['id_mhs', 'id_staf', 'surat_undangan', 'surat_tugas', 'file_surat'];

    // Validasi otomatis
    protected $validationRules = [
        'id_mhs' => 'required|integer',
        'id_staf' => 'required|integer',
        'surat_undangan' => 'permit_empty|max_length[255]',
        'surat_tugas' => 'permit_empty|max_length[255]',
        'file_surat' => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [
        'id_mhs' => [
            'required' => 'Mahasiswa ID diperlukan.',
            'integer' => 'Mahasiswa ID harus berupa angka.'
        ],
        'id_staf' => [
            'required' => 'Staf ID diperlukan.',
            'integer' => 'Staf ID harus berupa angka.'
        ]
    ];

    protected $skipValidation = false;

    // Metode tambahan jika diperlukan
}

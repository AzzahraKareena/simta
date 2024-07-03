<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class SyaratKelulusanModel extends Model
{
    protected $table = 'simta_syarat_kelulusan'; // Ganti 'nama_tabel_pengajuanjudul' dengan nama tabel yang Anda gunakan
    protected $primaryKey = 'id_syarat_kelulusan';
    // protected $returnType = 'object';
    protected $allowedFields = [
        'id_syarat_kelulusan',
        'id_mhs',
        'id_staf',
        'poster',
        'lembar_pengesahan',
        'lembar_persetujuan',
        'bukti_pelunasan_ukt',
        'surat_bebas_lab',
        'aplikasi_ta',
        'laporan_ta_pdf',
        'status_syarat'
    ];

    public function getKelulusan($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('simta_syarat_kelulusan.*, mahasiswa.nama as mahasiswa_nama, mahasiswa.nim as nim')
                    ->join('users', 'simta_syarat_kelulusan.id_mhs=users.id')
                    ->join('mahasiswa', 'users.id=mahasiswa.id_user')
                    ->where('mahasiswa.th_lulus', $tahun)
                    ->findAll();
    }
}

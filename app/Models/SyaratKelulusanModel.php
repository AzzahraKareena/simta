<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class SyaratKelulusanModel extends Model
{
    protected $table = 'syarat_kelulusan';
    protected $primaryKey = 'id_syaratkelulusan';
    protected $allowedFields = ['id_syaratkelulusan', 'poster', 'lembar_pengesahan', 'lembar_persetujuan', 'bukti_pelunasan_ukt', 'surat_bebas_lab', 'aplikasi_ta', 'laporan_ta_word', 'laporan_ta_pdf', 'ktp', 'id_mhs', 'created_at', 'id_staf', 'status_syarat', 'catatan'];

    public function getSyaratKelulusanByUser()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('syarat_kelulusan');
        $builder->select('syarat_kelulusan.*, mahasiswa.*, mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = syarat_kelulusan.id_mhs');
        $builder->join('users', 'users.id = mahasiswa.id_user');
        $builder->where(['mahasiswa.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSyaratKelulusanByUser1()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('syarat_kelulusan');
        $builder->select('syarat_kelulusan.*, mahasiswa.*, staf.*, staf.nama as nm_staf, mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = syarat_kelulusan.id_mhs');
        $builder->join('staf', 'staf.id_staf = syarat_kelulusan.id_staf');
        $builder->join('users', 'users.id = staf.id_user');
        $builder->where(['staf.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSyaratKelulusanDetail()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('syarat_kelulusan');
        $builder->select('syarat_kelulusan.*, mahasiswa.*, staf.*, simta_rekomendasi.* simta_rekomendasi.nama_rekomendasi as nm_rekomendasi, staf.nama as nm_staf, mahasiswa.nama as nm_mhs'); 
        $builder->join('simta_rekomendasi', 'simta_rekomendasi.id_pengajuanjudul = syarat_kelulusan.id_rekomendasi');
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = syarat_kelulusan.id_mhs');
        $builder->join('staf', 'staf.id_staf = syarat_kelulusan.id_staf');
        $builder->join('users', 'users.id = mahasiswa.id_user');
        $builder->where(['mahasiswa.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getUsers()
    {
        // Define your method logic here
    }

    public function getDataByIdSyaratKelulusan($id_syaratkelulusan)
    {
        $builder = $this->db->table('syarat_kelulusan');
        $builder->where('id_syaratkelulusan', $id_syaratkelulusan);
        return $builder->get()->getRow();
    }

    // Add more methods as needed
}

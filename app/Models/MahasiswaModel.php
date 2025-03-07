<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id_mhs';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [ 'id_user', 'nama', 'nim', 'prodi', 'no_telp', 'th_masuk', 'th_lulus', 'kelas', 'status'];
   
    public function findAllMahasiswa()
    {
        return $this->db->table('mahasiswa')
            ->select('id_mhs, nama') // Ensure you select the 'nama' field
            ->get()
            ->getResult();
    }
    // public function getMahasiswabyUserId()
    // {
    //     $user_id = user()->id;
    //     $builder = $this->db->table('mahasiswa');
    //     $builder->select('*');
    //     $builder->join('users','users.id = mahasiswa.id_user');
    //     $builder->where('id_user', $user_id);
    //     $query = $builder->get();
    //     return $query->getResult();  
    // }


    // public function getMahasiswa($id_mhs){
    //     $builder = $this->db->table('mahasiswa');
    //     $builder->join('users', 'users.id = mahasiswa.id_user');
    //     $builder->where('mahasiswa.id_mhs', $id_mhs);
    //     $query = $builder->get();
    //     return $query->getRow();
    // }

    // public function getUniqueKelas(){
    //     $builder = $this->db->table('mahasiswa');
    //     $builder->select('kelas');
    //     $builder->groupBy('kelas');
    //     $query = $builder->get();
    //     return $query->getResult();
    // }

    // public function getAngkatanMahasiswa(){
    //     $builder = $this->db->table('mahasiswa');
    //     $builder->select('th_masuk');
    //     $builder->groupBy('th_masuk');
    //     $query = $builder->get();
    //     return $query->getResult();
    // }

    

    public function withUser()
    {
        return $this->select('mahasiswa.*, users.email, users.username, users.password_hash, users.role')
                    ->join('users', 'users.id = mahasiswa.id_user'); 
    }

    public function getUser()
    {
        return $this->select('mahasiswa.*, mhs.id as mahasiswa_id')
                    ->withMhs()
                    ->withStaff()
                    ->withJudul()
                    ->findAll();
    }
}
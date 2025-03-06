<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table = 'simta_logbook';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_jadwal', 'id_mahasiswa', 'catatan', 'created_at', 'updated_at'];

 // Get all logbook entries with schedule details
 public function getAllLogbook()
 {
     return $this->db->table('simta_logbook as l')
         ->select('l.*, l.id as id_logbook, j.tanggal, j.waktu, j.tempat, m.nama as nama_mahasiswa')
         ->join('simta_jadwal_bimbingan as j', 'l.id_jadwal = j.id', 'left')
         ->join('mahasiswa as m', 'l.id_mahasiswa = m.id_mhs', 'left') 
         ->get()
         ->getResultArray();
 }

 // Get logbook entries by mahasiswa with schedule details
 public function getLogbookByMahasiswa($id_mahasiswa)
 {
     return $this->db->table('simta_logbook as l')
         ->select('l.*, l.id as id_logbook,j.tanggal, j.waktu, j.tempat, m.nama as nama_mahasiswa')
         ->join('simta_jadwal_bimbingan as j', 'l.id_jadwal = j.id', 'left')
         ->join('mahasiswa as m', 'l.id_mahasiswa = m.id_mhs', 'left') 
         ->where('l.id_mahasiswa', $id_mahasiswa)
         ->get()
         ->getResultArray();
 }

    public function addLogbook($data)
    {
        return $this->insert($data);
    }

    public function updateLogbook($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteLogbook($id)
    {
        return $this->delete($id);
    }
}
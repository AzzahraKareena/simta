<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PenilaianProposalDetailModel extends Model
{
    protected $table = 'simta_penilaian_ujianproposal_detail';
    protected $primaryKey = 'id_penilaian_detail';
    protected $allowedFields = ['id_penilaian_detail', 'id_indikator', 'nilai', 'id_penilaian_proposal'];


    public function withIndikator()
    {
        return $this->join('simta_indikator as indi', 'indi.id_indikator = simta_penilaian_ujianproposal_detail.id_indikator')
                    ->join('simta_kriteria as kriteria', 'kriteria.id_kriteria = indi.id_kriteria');
    }

    public function withPenilaian()
    {
        return $this->join('simta_penilaian_ujianproposal as pnl', 'pnl.id_penilaian = simta_penilaian_ujianproposal_detail.id_penilaian_proposal')
                    ->join('users as mhs', 'mhs.id = pnl.id_mhs')
                    ->join('users as staf', 'staf.id = pnl.id_staf')
                    ->join('staf as stf', 'stf.id_user = staf.id')
                    ->join('simta_rilis_jadwal as jdw', 'jdw.id_rilis_jadwal = pnl.id_rilis_jadwal')
                    ->join('simta_pengajuan_ujianproposal as peng', 'jdw.id_pengajuanujianpropo=peng.id_ujianproposal')
                    ->join('simta_acc_judul as judul', 'peng.judul_acc_id=judul.id_accjudul')
                    ->join('mahasiswa as mh', 'mhs.id=mh.id_user');
    }

    public function getDetail()
    {
        return $this->select('simta_penilaian_ujianproposal_detail.*, judul.judul_acc as judul_judul_acc, ,peng.mahasiswa as peng_id_mhs, mh.nim as nim, mh.prodi as prodi, mhs.nama as mhs_nama, staf.nama as staf_nama, stf.nip as stf_nip, indi.nama as indi, indi.max_nilai as indi_nilai, kriteria.nama_kriteria as kri, kriteria.id_kriteria as id_kri')
                    ->withIndikator()
                    ->withPenilaian()
                    ->findAll();
    }

}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BobotPenilaianModel;
use App\Models\MahasiswaModel;
use App\Models\PenilaianSemhasModel;
use App\Models\PenilaianSidangModel;
use App\Models\PenilaianProposalModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class RekapitulasiController extends BaseController
{
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswas = $mahasiswaModel->findAll(); 

        $data = [];

        foreach ($mahasiswas as $mahasiswa) {
            // Nilai Proposal
            $proposalModel = new PenilaianProposalModel();
            $nilaiProposal = $proposalModel->where('id_mhs', $mahasiswa->id_user)->findAll();

            $totalNilaiProposal = 0;
            foreach ($nilaiProposal as $nilai) {
                $totalNilaiProposal += $nilai['nilai_total'];
            }
            $rataNilaiProposal = count($nilaiProposal) > 0 ? $totalNilaiProposal / count($nilaiProposal) : 0;

            // Nilai Seminar
            $seminarModel = new PenilaianSemhasModel();
            $nilaiSeminar = $seminarModel->where('id_mhs', $mahasiswa->id_user)->findAll();

            $totalNilaiSeminar = 0;
            foreach ($nilaiSeminar as $nilai) {
                $totalNilaiSeminar += $nilai['nilai_total'];
            }
            $rataNilaiSeminar = count($nilaiSeminar) > 0 ? $totalNilaiSeminar / count($nilaiSeminar) : 0;

            // Nilai Sidang
            $sidangModel = new PenilaianSidangModel();
            $nilaiSidang = $sidangModel->where('id_mhs', $mahasiswa->id_user)->findAll();

            $totalNilaiSidang = 0;
            foreach ($nilaiSidang as $nilai) {
                $totalNilaiSidang += $nilai['nilai_total'];
            }
            $rataNilaiSidang = count($nilaiSidang) > 0 ? $totalNilaiSidang / count($nilaiSidang) : 0;

            // Nilai Akhir
            $nilaiAkhir = ($rataNilaiProposal * 0.1) + ($rataNilaiSeminar * 0.3) + ($rataNilaiSidang * 0.6);

            $data[] = [
                'mahasiswa' => $mahasiswa,
                'nilaiProposal' => $rataNilaiProposal,
                'nilaiSeminar' => $rataNilaiSeminar,
                'nilaiSidang' => $rataNilaiSidang,
                'nilaiAkhir' => $nilaiAkhir,
            ];
        }

        // dd($data);
        return view('rekapitulasi-nilai/index', ['data' => $data]);
    }

}

<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Libraries\CustomPDF;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\BobotPenilaianModel;
use App\Models\JadwalSidangModel;
use App\Models\PenilaianSemhasModel;
use App\Models\PenilaianSidangModel;
use App\Models\PenilaianProposalModel;
use CodeIgniter\HTTP\ResponseInterface;

class RekapitulasiController extends BaseController
{
    public function index()
    {
        $data = $this->hitungNilaiMahasiswa();

        return view('rekapitulasi-nilai/index', ['data' => $data]);
    }

    public function cetak($id)
    {
        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        $dataNilai = $this->hitungNilaiMahasiswa();

        helper('my_date_helper');
        // $indonesian_date = convert_datetime_to_indonesian($dataNilai['mahasiswa']['tgl_ujian']);

        $dataToPrint = null;
        $indonesian_date = [];
        foreach ($dataNilai as $item) {
            if ($item['mahasiswa']['id_user'] == $id) {
                $dataToPrint = $item;
                $indonesian_date[] = convert_datetime_to_indonesian($item['mahasiswa']['tgl_ujian']);
                break;
            }
        }

        if (!$dataToPrint) {
            // Handle jika data tidak ditemukan
            throw new \RuntimeException("Data dengan ID '$id' tidak ditemukan.");
        }
        // dd($indonesian_date);

        $data = [
            'imagePath' => $imagePath,
            'rekap' => $dataToPrint,
            'day' => $indonesian_date[0]['day'],
            'date' => $indonesian_date[0]['date'],
            'month' => $indonesian_date[0]['month'],
            'year' => $indonesian_date[0]['year'],
        ];

        $html = view('rekapitulasi-nilai/nilai-akhir', $data);

        $pdf = new CustomPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('rekomendasi.pdf', 'I');
    }

    private function hitungNilaiMahasiswa()
    {
        // $mahasiswaModel = new MahasiswaModel();
        // $mahasiswas = $mahasiswaModel->findAll(); 
        $mahasiswaModel = new JadwalSidangModel();
        $mahasiswas = $mahasiswaModel->getJadwal();

        $data = [];

        foreach ($mahasiswas as $mahasiswa) {
            $rataNilaiProposal = $this->hitungRataNilai(new PenilaianProposalModel(), $mahasiswa['id_user']);
            $rataNilaiSeminar = $this->hitungRataNilai(new PenilaianSemhasModel(), $mahasiswa['id_user']);
            $rataNilaiSidang = $this->hitungRataNilai(new PenilaianSidangModel(), $mahasiswa['id_user']);

            $nilaiAkhir = ($rataNilaiProposal * 0.1) + ($rataNilaiSeminar * 0.3) + ($rataNilaiSidang * 0.6);

            $data[] = [
                'id' => uniqid(), 
                'mahasiswa' => $mahasiswa,
                'nilaiProposal' => $rataNilaiProposal,
                'nilaiSeminar' => $rataNilaiSeminar,
                'nilaiSidang' => $rataNilaiSidang,
                'nilaiAkhir' => $nilaiAkhir,
            ];
        }

        return $data;
    }

    private function hitungRataNilai($model, $id_mhs)
    {
        $nilai = $model->where('id_mhs', $id_mhs)->findAll();

        $totalNilai = 0;
        foreach ($nilai as $item) {
            $totalNilai += $item['nilai_total'];
        }

        return count($nilai) > 0 ? $totalNilai / count($nilai) : 0;
    }
    // public function index()
    // {
    //     $mahasiswaModel = new MahasiswaModel();
    //     $mahasiswas = $mahasiswaModel->findAll(); 

    //     $data = [];

    //     foreach ($mahasiswas as $mahasiswa) {
    //         // Nilai Proposal
    //         $proposalModel = new PenilaianProposalModel();
    //         $nilaiProposal = $proposalModel->where('id_mhs', $mahasiswa->id_user)->findAll();

    //         $totalNilaiProposal = 0;
    //         foreach ($nilaiProposal as $nilai) {
    //             $totalNilaiProposal += $nilai['nilai_total'];
    //         }
    //         $rataNilaiProposal = count($nilaiProposal) > 0 ? $totalNilaiProposal / count($nilaiProposal) : 0;

    //         // Nilai Seminar
    //         $seminarModel = new PenilaianSemhasModel();
    //         $nilaiSeminar = $seminarModel->where('id_mhs', $mahasiswa->id_user)->findAll();

    //         $totalNilaiSeminar = 0;
    //         foreach ($nilaiSeminar as $nilai) {
    //             $totalNilaiSeminar += $nilai['nilai_total'];
    //         }
    //         $rataNilaiSeminar = count($nilaiSeminar) > 0 ? $totalNilaiSeminar / count($nilaiSeminar) : 0;

    //         // Nilai Sidang
    //         $sidangModel = new PenilaianSidangModel();
    //         $nilaiSidang = $sidangModel->where('id_mhs', $mahasiswa->id_user)->findAll();

    //         $totalNilaiSidang = 0;
    //         foreach ($nilaiSidang as $nilai) {
    //             $totalNilaiSidang += $nilai['nilai_total'];
    //         }
    //         $rataNilaiSidang = count($nilaiSidang) > 0 ? $totalNilaiSidang / count($nilaiSidang) : 0;

    //         // Nilai Akhir
    //         $nilaiAkhir = ($rataNilaiProposal * 0.1) + ($rataNilaiSeminar * 0.3) + ($rataNilaiSidang * 0.6);

    //         $data[] = [
    //             'mahasiswa' => $mahasiswa,
    //             'nilaiProposal' => $rataNilaiProposal,
    //             'nilaiSeminar' => $rataNilaiSeminar,
    //             'nilaiSidang' => $rataNilaiSidang,
    //             'nilaiAkhir' => $nilaiAkhir,
    //         ];
    //     }

    //     // dd($data);
    //     return view('rekapitulasi-nilai/index', ['data' => $data]);
    // }

}

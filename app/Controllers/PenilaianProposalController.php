<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Models\IndikatorModel;
use App\Models\PengajuanJudulModel;
use App\Models\PengajuanUjianProposalModel;
use TCPDF;

class PenilaianProposalController extends BaseController
{

    public function penilaian()
    {
        helper('my_date_helper');

        $indikator = new IndikatorModel();
        $indik = $indikator->getKriteria();
        // $indonesian_date = convert_datetime_to_indonesian($ujianpropo->ajuan_tgl_ujian);

        // dd($ujianpropo);
        // Mengelompokkan data berdasarkan id_kriteria
        $groupedData = [];
        foreach ($indik as $indi) {
            $id_kriteria = $indi['id_kriteria'];
            if (!isset($groupedData[$id_kriteria])) {
                $groupedData[$id_kriteria] = [
                    'kriteria_nama_kriteria' => $indi['kriteria_nama_kriteria'],
                    'indikator' => []
                ];
            }
            $groupedData[$id_kriteria]['indikator'][] = $indi;
        }

        $data = [
            'indikator' => $groupedData,
            'mahasiswa' => 'bunga',
            'nim' => 'V3459983',
            'prodi' => 'Teknik Infromatika',
            'date' => '12',
            'month' => 'Mei',
            'year' => '2024'
        ];
        // dd($data);

        $html = view('penilaianproposal/penilaian-proposal', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Setel margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(false);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Tambahkan logo dan judul ke header
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 11, 'LEMBAR PENILAIAN PROPOSAL TUGAS AKHIR,', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->SetFont('times', '', 12);
        $pdf->Ln(0);  // Tambahkan jarak setelah header

        // Tulis konten HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        // Atur response untuk menampilkan PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('berita-acara.pdf', 'I');
    }
}

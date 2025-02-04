<?php

namespace App\Controllers;

use TCPDF;
use App\Models\StafModel;
use App\Libraries\CustomPDF;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\PengajuanUjianProposalModel;

class JadwalUjianPropoController extends BaseController
{
    public function table()
    {
        // dd(session()->get('user_id'));
        $model = new JadwalUjianPropoModel();
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getJadwal($tahun);

        $getData = []; 
        
        foreach ($data as $jadwal) {
            if (session()->get('role') == 'Dosen') {
                if ($jadwal['id_penguji1'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }elseif ($jadwal['id_penguji2'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($jadwal['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }
            }elseif (session()->get('role') == 'Koordinator') {
                    $getData[] = $jadwal;
            }
        }
        $operation['data'] = $getData;
        $operation['tahun'] = $tahun;
        $operation['title'] = 'Rilis Jadwal Ujian Proposal';
        $operation['sub_title'] = 'Daftar Jadwal Ujian Proposal';
        // dd($operation['data']);
        return view("rilisjadwal/index", $operation);
    }
    
    public function create($id)
    {
        $pengajuanUjianPropo = new PengajuanUjianProposalModel();
        $dataPengajuanUjian = $pengajuanUjianPropo->getMhs($id);
        // dd($dataPengajuanUjian);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pengajuan'] = $dataPengajuanUjian;
        $operation['dosen'] = (new StafModel())->asArray()->findAll();
        // dd($operation['pjudul']);
        return view('rilisjadwal/create', ['pengajuan' => $operation['pengajuan'], 'dosen' => $operation['dosen']]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        // dd($data);
        $jadwalModel = new JadwalUjianPropoModel();
        $jadwalModel->save($data);
        return redirect()->to('rilisjadwal');
    }

    public function edit($id)
    {
        $jadwalModel = new JadwalUjianPropoModel();
        $dataForm = $jadwalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Rilis Jadwal Ujian Proposal';
        $operation['sub_title'] = 'Edit Jadwal Ujian Proposal';
        $operation['dosen'] = (new StafModel())->asArray()->findAll();
        return view('rilisjadwal/edit', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $jadwalModel = new JadwalUjianPropoModel();
        $jadwalModel->update($id, $data);
        return redirect()->to('rilisjadwal');
    }

    public function delete($id)
    {
        $jadwalModel = new JadwalUjianPropoModel();
        $jadwalModel->delete($id);
        return redirect()->to('rilisjadwal');
    }

    public function beritaacara($id)
    {
        helper('my_date_helper');

        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        $jadwal = (new JadwalUjianPropoModel())->getBeritaAcara($id);
        $indonesian_date = convert_datetime_to_indonesian($jadwal['tgl_ujian']);

        $data = [
            'imagePath' => $imagePath,
            'day' => $indonesian_date['day'],
            'date' => $indonesian_date['date'],
            'month' => $indonesian_date['month'],
            'year' => $indonesian_date['year'],
            'jadwal' => $jadwal,
            'tahapUjian' => 'Ujian Proposal'
        ];
        // dd($data);

        $html = view('rilisjadwal/berita-acara', $data);
        $html2 = view('rilisjadwal/berita-acara-2', $data);
        $html3 = view('rilisjadwal/berita-acara-3', $data);

        $pdf = new CustomPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'F4', true, 'UTF-8', false);
        // Setel margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);

        // Tambahkan halaman baru
        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        // Tulis konten HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html2, true, false, true, false, '');

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html3, true, false, true, false, '');

        // Atur response untuk menampilkan PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('berita-acara.pdf', 'I');
    }
}

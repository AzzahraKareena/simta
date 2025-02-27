<?php

namespace App\Controllers;

use TCPDF;
use App\Models\StafModel;
use App\Libraries\CustomPDF;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Models\JadwalSemhasModel;
use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\PengajuanSeminarHasilModel;

class JadwalSemhasController extends BaseController
{
    public function table()
    {
        // dd(session()->get('user_id'));
        $model = new JadwalSemhasModel();
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getJadwal($tahun);

        $getData = []; // Inisialisasi sebagai array kosong
        
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
        // dd($data);
        $operation['data'] = $getData;
        $operation['tahun'] = $tahun;
        $operation['title'] = 'Rilis Jadwal Seminar Hasil';
        $operation['sub_title'] = 'Daftar Jadwal Seminar Hasil';
        // dd($operation['data']);
        return view("rilisjadwalsemhas/index", $operation);
    }
    
    // public function create()
    // {
    //     // $id_mhs = session()->get('user_id');
    //     $pengajuanSeminar = new PengajuanSeminarHasilModel();
    //     $dataPengajuan = $pengajuanSeminar->getMhs();
    //     $operation['title'] = 'Pengajuan Ujian Proposal';
    //     $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
    //     $operation['pengajuan'] = $dataPengajuan;
    //     $operation['dosen'] = (new StafModels())->where('jenis', 'Dosen')->asArray()->findAll();
    //     // dd($operation['pengajuan']);
    //     return view('rilisjadwalsemhas/create', ['pengajuan' => $operation['pengajuan'], 'dosen' => $operation['dosen']]);
    // }

    public function store()
    {
        $data = $this->request->getPost();
        // dd($data);
        $jadwalModel = new JadwalSemhasModel();
        $jadwalModel->save($data);
        return redirect()->to('rilisjadwalsemhas');
    }


    public function edit($id)
    {
        $jadwalModel = new JadwalSemhasModel();
        $dataForm = $jadwalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Rilis Jadwal Seminar Hasil';
        $operation['sub_title'] = 'Edit Jadwal Seminar Hasil';
        $operation['dosen'] = (new StafModel())->asArray()->findAll();
        return view('rilisjadwalsemhas/edit', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $jadwalModel = new JadwalSemhasModel();
        $jadwalModel->update($id, $data);
        return redirect()->to('rilisjadwalsemhas');
    }

    public function delete($id)
    {
        $jadwalModel = new JadwalSemhasModel();
        $jadwalModel->delete($id);
        return redirect()->to('rilisjadwalsemhas');
    }

    public function beritaacara($id)
    {
        helper('my_date_helper');

        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        $jadwal = (new JadwalSemhasModel())->getBeritaAcara($id);
        $indonesian_date = convert_datetime_to_indonesian($jadwal['tgl_ujian']);

        $data = [
            'imagePath' => $imagePath,
            'day' => $indonesian_date['day'],
            'date' => $indonesian_date['date'],
            'month' => $indonesian_date['month'],
            'year' => $indonesian_date['year'],
            'jadwal' => $jadwal,
            'tahapUjian' => 'Seminar Hasil'
        ];
        // dd($data);

        $html = view('rilisjadwal/berita-acara', $data);
        $html2 = view('rilisjadwal/lembar-revisi-1', $data);
        // $html3 = view('rilisjadwal/berita-acara-3', $data);

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

        // Atur response untuk menampilkan PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('lembar-revisi-dan-berita-acara.pdf', 'I');
    }

    public function persetujuan($id)
    {
        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        $dataSeminar = (new JadwalSemhasModel())->getPersetujuan($id);

        $data = [
            'imagePath' => $imagePath,
            'semhas' => $dataSeminar,
        ];

        $html = view('rilisjadwalsemhas/lembar-persetujuan', $data);

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
        $pdf->Output('berita-acara.pdf', 'I');
    }
}

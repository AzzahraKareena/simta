<?php

namespace App\Controllers;

use TCPDF;
use App\Models\StafModels;
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
        $data = (new JadwalUjianPropoModel())->getJadwal();
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $jadwal) {
            if (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($jadwal['id_penguji1'] == session()->get('user_id')) {
                    $getData[] = $jadwal; // Tambahkan ke array
                }elseif ($jadwal['id_penguji2'] == session()->get('user_id')) {
                    $getData[] = $jadwal; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($jadwal['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $jadwal; // Tambahkan ke array
                }
            }elseif (session()->get('role') == 'Koordinator') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                    $getData[] = $jadwal; // Tambahkan ke array
            }
        }
        $operation['data'] = $getData;
        $operation['title'] = 'Rilis Jadwal Ujian Proposal';
        $operation['sub_title'] = 'Daftar Jadwal Ujian Proposal';
        // dd($operation['data']);
        return view("rilisjadwal/index", ['data' => $operation['data']]);
    }
    
    public function create()
    {
        // $id_mhs = session()->get('user_id');
        $pengajuanUjianPropo = new PengajuanUjianProposalModel();
        $dataPengajuanUjian = $pengajuanUjianPropo->getMhs();
        // dd($dataPengajuanUjian);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pengajuan'] = $dataPengajuanUjian;
        $operation['dosen'] = (new StafModels())->asArray()->findAll();
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
        $operation['dosen'] = (new StafModels())->asArray()->findAll();
        return view('rilisjadwal/create', $operation);
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
            'jadwal' => $jadwal
        ];
        // dd($data);

        $html = view('rilisjadwal/berita-acara', $data);
        $html2 = view('rilisjadwal/berita-acara-2', $data);

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
        $pdf->Output('berita-acara.pdf', 'I');
    }
}

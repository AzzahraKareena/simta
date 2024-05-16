<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\PengajuanUjianProposalModel;
use TCPDF;

class PengajuanUjianProposalController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanUjianProposalModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Daftar Pengajuan Ujian Proposal';
        return view("pengajuanujianproposal/index", $operation);
    }
    
    public function create()
    {
        $id_mhs = session()->get('user_id');
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pjudul'] = (new PengajuanJudulModel())->where('id_mhs', $id_mhs)->first();
        // dd($operation['pjudul']);
        return view('pengajuanujianproposal/create', ['pjudul' => $operation['pjudul']]);
    }

    public function store()
    {
        $id_mhs = session()->get('user_id');

        // Ambil data post
        $data = $this->request->getPost();
        
        // Tambahkan id_mhs ke data
        $data['id_mhs'] = $id_mhs;
        $data['id_pengajuanjudul'] = $this->request->getVar('id_pengajuanjudul');

        // Mengelola file upload
        $file = $this->request->getFile('proposal_ta');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getName();
            $file->move('public/assets/proposal/', $newName);
            $data['proposal_ta'] = $newName;
        }

        // Insert ke database
        $data['status'] = $this->request->getPost('status');

        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->insert($data);

        return redirect()->to('pengajuanujianproposal');
    }

    public function edit($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $dataForm = $pengajuanUjianProposalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Edit Pengajuan Ujian Proposal';
        return view('pengajuanujianproposal/create', $operation);
    }

    public function updateStatus($id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $data = $this->request->getPost('status');
        // dd($data);
        $pengajuanUjianProposalModel->update($id, ['status_pengajuan' => $data]);
        // $model->update($id, ['status' => $status]);
        return redirect()->to('pengajuanujianproposal');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->update($id, $data);
        return redirect()->to('pengajuanujianproposal');
    }

    public function uploadJadwal($proposalId)
    {
        $uploadedFile = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            // Pindahkan file yang diunggah ke folder yang diinginkan
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/jadwalujian/', $newFileName);

            // Simpan detail file ke dalam database
            $proposalModel = new PengajuanUjianProposalModel();
            $proposalModel->update($proposalId, ['jadwal' => $newFileName]);

            // Kirim respon ke client
            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function uploadRevisi($proposalId)
    {
        $uploadedFile = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            // Pindahkan file yang diunggah ke folder yang diinginkan
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/revisi_ujian/', $newFileName);

            // Simpan detail file ke dalam database
            $proposalModel = new PengajuanUjianProposalModel();
            $proposalModel->update($proposalId, ['revisi_proposal' => $newFileName]);

            // Kirim respon ke client
            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }


    public function delete($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->delete($id);
        return redirect()->to('pengajuanujianproposal');
    }

    public function beritaacara($id)
    {
        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';

        $data = [
            'imagePath' => $imagePath,
            'pengajuanpropo' => (new PengajuanUjianProposalModel())->find($id)
        ];

        $html = view('pengajuanujianproposal/berita-acara', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Setel margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(false);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Tambahkan garis header
        $pdf->SetLineWidth(0.75); // Atur ketebalan garis
        $pdf->Line(10, 57, 200, 57); // Atur koordinat garis (x1, y1, x2, y2)

        // Tambahkan logo dan judul ke header
        $pdf->Image($imagePath, 10, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $pdf->SetFont('times', '', 14);
        $pdf->Cell(0, 11, 'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 11, 'RISET, DAN TEKNOLOGI', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 11, 'UNIVERSITAS SEBELAS MARET', 0, 3, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 11, 'SEKOLAH VOKASI', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 11, 'PROGRAM STUDI D3 TEKNIK INFORMATIKA (MADIUN)', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, 'Jalan Imam Bonjol, Pandean, Mejayan, Madiun', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 10, 'Telepon (0351) 4486943 Faksimile (0351) 4486943', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 10, 'Website: https://prodi.vokasi.uns.ac.id/psdku-tekinfo/', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 10, 'Email: d3ti.vokasiuns@gmail.com', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Ln(0);  // Tambahkan jarak setelah header

        // Tulis konten HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        // Atur response untuk menampilkan PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('berita-acara.pdf', 'I');
    }
}

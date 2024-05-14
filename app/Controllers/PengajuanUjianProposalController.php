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


    public function delete($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->delete($id);
        return redirect()->to('pengajuanujianproposal');
    }

    public function beritaacara()
    {
        $data = [

        ];

        $html = view('pengajuanujianproposal/berita-acara', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->addPage();
        $pdf->writeHTML($html);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->response->setContentType('application/pdf');
        $pdf->Output('berita-acara.pdf', 'I');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanUjianProposalModel;

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
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        return view('pengajuanujianproposal/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
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

    public function delete($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->delete($id);
        return redirect()->to('pengajuanujianproposal');
    }
}

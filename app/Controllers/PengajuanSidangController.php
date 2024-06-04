<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanSidangModel;

class PengajuanSidangController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanSidangModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Daftar Pengajuan Sidang';
        return view("pengajuansidang/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Buat Pengajuan Sidang Baru';
        return view('pengajuansidang/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $pengajuanSidang = new PengajuanSidangModel();
        $pengajuanSidang->insert($data);
        return redirect()->to('pengajuansidang');
    }

    public function edit($id)
    {
        $pengajuanSidang = new PengajuanSidangModel();
        $dataForm = $pengajuanSidang->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Edit Pengajuan Sidang';
        return view('pengajuansidang/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanSidang = new PengajuanSidangModel();
        $pengajuanSidang->update($id, $data);
        return redirect()->to('pengajuansidang');
    }

    public function delete($id)
    {
        $pengajuanSidang = new PengajuanSidangModel();
        $pengajuanSidang->delete($id);
        return redirect()->to('pengajuansidang');
    }
}

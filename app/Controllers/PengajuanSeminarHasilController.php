<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanSeminarHasilModel;
use CodeIgniter\HTTP\ResponseInterface;

class PengajuanSeminarHasilController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanSeminarHasilModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Data Pengajuan Seminar Hasil';
        $operation['sub_title'] = '';
        return view("pengajuanseminarhasil/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        return view('pengajuanseminarhasil/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $pengajuanSeminarHasil->save($data);
        return redirect()->to('pengajuanseminarhasil');
    }

    public function edit($id)
    {
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $dataForm = $timeline->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        return view('pengajuanseminarhasil/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $pengajuanSeminarHasil->update($id, $data);
        return redirect()->to('pengajuanseminarhasil');
    }

    public function delete($id)
    {
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $pengajuanSeminarHasil->delete($id);
        return redirect()->to('pengajuanseminarhasil');
    }
}

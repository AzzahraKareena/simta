<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaSidangModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaSidangController extends BaseController
{
    public function table()
    {
        $data = (new KriteriaSidangModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Kriteria';
        $operation['sub_title'] = 'Daftar Kriteria';
        return view("kriteria-sidang/index", $operation);
    }

    public function index()
    {
        $data['kriteria'] = (new KriteriaSidangModel())->asArray()->findAll();
        return view('kriteria-sidang/index', $data);
    }

    
    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria-sidang/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaSidangModel();
        $kriteriaModel->save($data);
        return redirect()->to('kriteria_sidang');
    }

    public function edit($id = null)
    {
        $kriteriaModel = new KriteriaSidangModel();
        $dataForm = $kriteriaModel->find($id);
        $data['dataForm'] = $dataForm;
        $data['kriteria'] = $kriteriaModel->find($id);
        $data['title'] = 'Edit Kriteria';
        return view('kriteria-sidang/create', $data);
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaSidangModel();
        $kriteriaModel->update($id, $data);
        return redirect()->to('kriteria_sidang');
    }

    public function delete($id = null)
    {
        $kriteriaModel = new KriteriaSidangModel();
        $kriteriaModel->delete($id);
        return redirect()->to('kriteria_sidang');
    }
}

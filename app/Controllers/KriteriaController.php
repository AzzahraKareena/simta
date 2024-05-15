<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaController extends BaseController
{
    public function table()
    {
        $data = (new KriteriaModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Kriteria';
        $operation['sub_title'] = 'Daftar Kriteria';
        return view("kriteria/index", $operation);
    }

    public function index()
    {
        $data['kriteria'] = (new KriteriaModel())->asArray()->findAll();
        return view('kriteria/index', $data);
    }

    
    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->save($data);
        return redirect()->to('kriteria');
    }

    public function edit($id = null)
    {
        $kriteriaModel = new KriteriaModel();
        $dataForm = $kriteriaModel->find($id);
        $data['dataForm'] = $dataForm;
        $data['kriteria'] = $kriteriaModel->find($id);
        $data['title'] = 'Edit Kriteria';
        return view('kriteria/create', $data);
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->update($id, $data);
        return redirect()->to('kriteria');
    }

    public function delete($id = null)
    {
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->delete($id);
        return redirect()->to('kriteria');
    }
}

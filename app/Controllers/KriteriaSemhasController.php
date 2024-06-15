<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaSemhasModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaSemhasController extends BaseController
{
    public function table()
    {
        $data = (new KriteriaSemhasModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Kriteria';
        $operation['sub_title'] = 'Daftar Kriteria';
        return view("kriteria-semhas/index", $operation);
    }

    public function index()
    {
        $data['kriteria'] = (new KriteriaSemhasModel())->asArray()->findAll();
        return view('kriteria-semhas/index', $data);
    }

    
    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria-semhas/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaSemhasModel();
        $kriteriaModel->save($data);
        return redirect()->to('kriteria_semhas');
    }

    public function edit($id = null)
    {
        $kriteriaModel = new KriteriaSemhasModel();
        $dataForm = $kriteriaModel->find($id);
        $data['dataForm'] = $dataForm;
        $data['kriteria'] = $kriteriaModel->find($id);
        $data['title'] = 'Edit Kriteria';
        return view('kriteria-semhas/create', $data);
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaSemhasModel();
        $kriteriaModel->update($id, $data);
        return redirect()->to('kriteria_semhas');
    }

    public function delete($id = null)
    {
        $kriteriaModel = new KriteriaSemhasModel();
        $kriteriaModel->delete($id);
        return redirect()->to('kriteria_semhas');
    }
}

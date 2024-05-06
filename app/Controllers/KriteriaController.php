<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaController extends BaseController
{
    public function index()
    {
        $kriteriaModel = new KriteriaModel();
        $data['kriterias'] = $kriteriaModel->findAll();
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

    public function edit($id)
    {
        $kriteriaModel = new KriteriaModel();
        $data['kriteria'] = $kriteriaModel->find($id);
        $data['title'] = 'Edit Kriteria';
        return view('kriteria/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->update($id, $data);
        return redirect()->to('kriteria');
    }

    public function delete($id)
    {
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->delete($id);
        return redirect()->to('kriteria');
    }
}

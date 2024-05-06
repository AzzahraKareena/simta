<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IndikatorModel;
use CodeIgniter\HTTP\ResponseInterface;

class IndikatorController extends BaseController
{
    public function index()
    {
        $indikatorModel = new IndikatorModel();
        $data['indikators'] = $indikatorModel->findAll();
        return view('indikator/index', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Create Indikator';
        return view('indikator/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $indikatorModel = new IndikatorModel();
        $indikatorModel->save($data);
        return redirect()->to('indikator');
    }

    public function edit($id)
    {
        $indikatorModel = new IndikatorModel();
        $data['indikator'] = $indikatorModel->find($id);
        $data['title'] = 'Edit Indikator';
        return view('indikator/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $indikatorModel = new IndikatorModel();
        $indikatorModel->update($id, $data);
        return redirect()->to('indikator');
    }

    public function delete($id)
    {
        $indikatorModel = new IndikatorModel();
        $indikatorModel->delete($id);
        return redirect()->to('indikator');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StafModels;
use CodeIgniter\HTTP\ResponseInterface;

class StafController extends BaseController
{
    public function table()
    {
        $data = (new StafModels())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view("masterstaf/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view('masterstaf/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $staf = new StafModel();
        $staf->save($data);
        return redirect()->to('masterstaf');
    }

    public function edit($id)
    {
        $staf = new StafModel();
        $dataForm = $masterstaf->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view('masterstaf/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $staf = new StafModel();
        $staf->update($id, $data);
        return redirect()->to('masterstaf');
    }

    public function delete($id)
    {
        $staf = new StafModel();
        $staf->delete($id);
        return redirect()->to('masterstaf');
    }
}
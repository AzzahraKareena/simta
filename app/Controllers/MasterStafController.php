<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MasterStafModel;
use CodeIgniter\HTTP\ResponseInterface;

class MasterStafController extends BaseController
{
    public function table()
    {
        $data = (new MasterStafModel())->asArray()->findAll();
        
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
        $timeline = new MasterStafModel();
        $timeline->save($data);
        return redirect()->to('masterstaf');
    }

    public function edit($id)
    {
        $masterstaf = new MasterStafModel(); // Anda menggunakan nama variabel $timeline di sini, ganti dengan $masterstaf
        $dataForm = $masterstaf->find($id); // Gunakan variabel $masterstaf yang benar
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view('masterstaf/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $masterstaf = new MasterStafModel();
        $masterstaf->update($id, $data);
        return redirect()->to('masterstaf');
    }

    public function delete($id)
    {
        $masterstaf = new MasterStafModel();
        $masterstaf->delete($id);
        return redirect()->to('masterstaf');
    }
}

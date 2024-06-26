<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaController extends BaseController
{
    public function table()
    {
        $data = (new MahasiswaModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Data Master Mahasiswa';
        $operation['sub_title'] = '';
        return view("mastermahasiswa/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view('mastermahasiswa/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $mahasiswa = new MahasiswaModel();
        $mahasiswa->save($data);
        return redirect()->to('mastermahasiswa');
    }

    public function edit($id)
    {
        $mahasiswa = new MahasiswaModel();
        $dataForm = $mastermahasiswa->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Data Master Staf';
        $operation['sub_title'] = '';
        return view('mastermahasiswa/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $mahasiswa = new MahasiswaModel();
        $mahasiswa->update($id, $data);
        return redirect()->to('mastermahasiswa');
    }

    public function delete($id)
    {
        $mahasiswa = new MahasiswaModel();
        $mahasiswa->delete($id);
        return redirect()->to('mastermahasiswa');
    }
}
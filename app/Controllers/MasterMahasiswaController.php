<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MasterMahasiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class MasterMahasiswaController extends BaseController
{
    public function table()
    {
        $data = (new MasterMahasiswaModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Data Master Mahasiswa';
        $operation['sub_title'] = '';
        return view("mastermahasiswa/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Data Master Mahasiswa';
        $operation['sub_title'] = '';
        return view('mastermahasiswa/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $mastermahasiswa = new MasterMahasiswaModel();
        $mastermahasiswa->save($data);
        return redirect()->to('mastermahasiswa');
    }

    public function edit($id)
    {
        $mastermahasiswa = new MasterMahasiswaModel();
        $dataForm = $mastermahasiswa->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Data Master Mahasiswa';
        $operation['sub_title'] = '';
        return view('mastermahasiswa/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $mastermahasiswa = new MasterMahasiswaModel();
        $mastermahasiswa->update($id, $data);
        return redirect()->to('mastermahasiswa');
    }

    public function delete($id)
    {
        $mastermahasiswa = new MasterMahasiswaModel();
        $mastermahasiswa->delete($id);
        return redirect()->to('mastermahasiswa');
    }
}
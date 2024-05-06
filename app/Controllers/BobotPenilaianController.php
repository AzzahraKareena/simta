<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BobotPenilaianModel;
use CodeIgniter\HTTP\ResponseInterface;

class BobotPenilaianController extends BaseController
{
    public function index()
    {
        $bobotModel = new BobotPenilaianModel();
        $data['bobots'] = $bobotModel->findAll();
        return view('bobot/index', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Tambah Bobot Penilaian';
        return view('bobot/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $bobotModel = new BobotPenilaianModel();
        $bobotModel->save($data);
        return redirect()->to('bobot');
    }

    public function edit($id)
    {
        $bobotModel = new BobotPenilaianModel();
        $data['bobot'] = $bobotModel->find($id);
        $data['title'] = 'Edit Bobot Penilaian';
        return view('bobot/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $bobotModel = new BobotPenilaianModel();
        $bobotModel->update($id, $data);
        return redirect()->to('bobot');
    }

    public function delete($id)
    {
        $bobotModel = new BobotPenilaianModel();
        $bobotModel->delete($id);
        return redirect()->to('bobot');
    }
}

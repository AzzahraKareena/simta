<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailPenilaianModel;
use CodeIgniter\HTTP\ResponseInterface;

class DetailPenilaianController extends BaseController
{
    public function index()
    {
        $detailPenilaianModel = new DetailPenilaianModel();
        $data['details'] = $detailPenilaianModel->findAll();
        return view('detail_penilaian/index', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Tambah Detail Penilaian';
        return view('detail_penilaian/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $detailPenilaianModel = new DetailPenilaianModel();
        $detailPenilaianModel->save($data);
        return redirect()->to('detail-penilaian');
    }

    public function edit($id)
    {
        $detailPenilaianModel = new DetailPenilaianModel();
        $data['detail'] = $detailPenilaianModel->find($id);
        $data['title'] = 'Edit Detail Penilaian';
        return view('detail_penilaian/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $detailPenilaianModel = new DetailPenilaianModel();
        $detailPenilaianModel->update($id, $data);
        return redirect()->to('detail-penilaian');
    }

    public function delete($id)
    {
        $detailPenilaianModel = new DetailPenilaianModel();
        $detailPenilaianModel->delete($id);
        return redirect()->to('detail-penilaian');
    }
}

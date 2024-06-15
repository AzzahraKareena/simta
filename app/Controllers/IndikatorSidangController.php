<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IndikatorSidangModel;
use App\Models\KriteriaSidangModel;
use CodeIgniter\HTTP\ResponseInterface;

class IndikatorSidangController extends BaseController
{
    public function table()
    {
        // Load Indikator data dengan mengakses relasi Kriteria
        $indikatorModel = new IndikatorSidangModel();
        $data = $indikatorModel->withKriteria()->findAll(); // Panggil metode withKriteria

        $operation['data'] = $data;
        $operation['title'] = 'Indikator';
        $operation['sub_title'] = 'Daftar Indikator penilaian';
        return view("indikator-sidang/index", $operation);
    }

    public function index()
    {
        $indikatorModel = new IndikatorSidangModel();
        $data['indikators'] = $indikatorModel->findAll();
        return view('indikator-sidang/index', $data);
    }
    
    public function create()
    {
        $indikatorModel = new IndikatorSidangModel();
        $data = $indikatorModel->withKriteria()->findAll(); 
        $kriteriaModel = new KriteriaSidangModel();
        $kriteria = $kriteriaModel->findAll();

        $operation['data'] = $data;
        $operation['kriteria'] = $kriteria;
        $operation['title'] = 'Create Indikator';
        $operation['sub_title'] = 'Daftar Indikator penilaian';
        return view('indikator-sidang/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $indikatorModel = new IndikatorSidangModel();
        $indikatorModel->save($data);
        return redirect()->to('indikator_sidang');
    }

    public function edit($id)
    {
        $indikator = new IndikatorSidangModel();
        $dataForm = $indikator->find($id);
        $kriteriaModel = new KriteriaSidangModel();
        $kriteria = $kriteriaModel->findAll();

        if (!$dataForm) {
            // Jika data tidak ditemukan, redirect ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Data not found.');
            // Atau lakukan tindakan lain sesuai kebutuhan aplikasi Anda
        }
        
        // Lanjutkan dengan proses edit jika data ditemukan
        $operation['dataForm'] = $dataForm;
        $operation['kriteria'] = $kriteria;
        $operation['title'] = 'Edit Indikator'; // Ubah judul
        $operation['sub_title'] = 'Edit Data Indikator'; // Ubah subjudul
        // $indikatorModel = new IndikatorSidangModel();
        // $data = $indikatorModel->withKriteria()->findAll(); // Panggil metode withKriteria
        // $operation['data'] = $data;
        // dd($operation);
        return view('indikator-sidang/create', $operation);
    }


    public function update($id)
    {
        $data = $this->request->getPost();
        $indikatorModel = new IndikatorSidangModel();
        $indikatorModel->update($id, $data);
        return redirect()->to('indikator_sidang');
    }

    public function delete($id)
    {
        $indikatorModel = new IndikatorSidangModel();
        $indikatorModel->delete($id);
        return redirect()->to('indikator_sidang');
    }
}

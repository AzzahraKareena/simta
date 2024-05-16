<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IndikatorModel;
use App\Models\KriteriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class IndikatorController extends BaseController
{
    public function table()
    {
        // Load Indikator data dengan mengakses relasi Kriteria
        $indikatorModel = new IndikatorModel();
        $data = $indikatorModel->withKriteria()->findAll(); // Panggil metode withKriteria

        $operation['data'] = $data;
        $operation['title'] = 'Indikator';
        $operation['sub_title'] = 'Daftar Indikator penilaian';
        return view("indikator/index", $operation);
    }

    public function index()
    {
        $indikatorModel = new IndikatorModel();
        $data['indikators'] = $indikatorModel->findAll();
        return view('indikator/index', $data);
    }
    
    public function create()
    {
        $indikatorModel = new IndikatorModel();
        $data = $indikatorModel->withKriteria()->findAll(); 
        $kriteriaModel = new KriteriaModel();
        $kriteria = $kriteriaModel->findAll();

        $operation['data'] = $data;
        $operation['kriteria'] = $kriteria;
        $operation['title'] = 'Create Indikator';
        $operation['sub_title'] = 'Daftar Indikator penilaian';
        return view('indikator/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $indikatorModel = new IndikatorModel();
        $indikatorModel->save($data);
        return redirect()->to('indikator');
    }

    // public function edit($id)
    // {
    //     $indikator = new IndikatorModel();
    //     $dataForm = $indikator->find($id);
    //     $operation['dataForm'] = $dataForm;
    //     $operation['title'] = 'Pengajuan Bimbingan';
    //     $operation['sub_title'] = 'Edit Pengajuan Bimbingan';
    //     return view('indikator/create', $operation);
    // }

    public function edit($id)
    {
        $indikator = new IndikatorModel();
        $dataForm = $indikator->find($id);
        $kriteriaModel = new KriteriaModel();
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
        // $indikatorModel = new IndikatorModel();
        // $data = $indikatorModel->withKriteria()->findAll(); // Panggil metode withKriteria
        // $operation['data'] = $data;
        // dd($operation);
        return view('indikator/create', $operation);
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

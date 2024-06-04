<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\MahasiswaBimbinganModel;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaBimbinganController extends BaseController
{
    // public function table()
    // {
    //     $model = new MahasiswaBimbinganModel();
    //     $data = $model->getUser();
    //     // $data = (new MahasiswaBimbinganModel())->asArray()->findAll();
    //     // dd($data);

    //     error_log(print_r($data, true));

    //     $operation['data'] = $data;
    //     $operation['title'] = 'Mahasiswa Bimbingan';
    //     $operation['sub_title'] = 'Daftar Mahasiswa Bimbingan Tugas Akhir';
        
    //     return view("mahasiswabimbingan/index", $operation);
    // }

    // public function get_data()
    // {
    //     $mahasiswaModel = new MahasiswaBimbinganModel();
    //     $data = $mahasiswaModel->getUser();

    //     $id_mhs = null;
    //     if (!empty($data)) {
    //         foreach ($data as $key) {
    //             $id_mhs = $key['id_mhs'];
    //         }
    //     }

    //     if ($id_mhs !== null) {
    //         $mahasiswaNim = new MahasiswaModel();
    //         $mahasiswa = $mahasiswaNim->where('id_user', $id_mhs)->get()->getRow()->th_masuk;
    //     } else {
    //         $mahasiswa = 'Data tidak ditemukan';
    //     }

    //     $getData = [];
        
    //     foreach ($data as $bimbingan) {
    //         if (session()->get('role') == 'Dosen') {
    //             if ($bimbingan['id_staf'] == session()->get('user_id')) {
    //                 $getData[] = $bimbingan;
    //             }
    //         }
    //     }
    
    //     $operation['data'] = $getData;
    //     $operation['th_masuk'] = $mahasiswa;
    //     $operation['title'] = 'Mahasiswa Bimbingan';
    //     $operation['sub_title'] = 'Daftar Mahasiswa Bimbingan Tugas Akhir';
        
    //     return view("mahasiswabimbingan/index", $operation);
    // }

    public function table()
    {
        $model = new MahasiswaBimbinganModel();
        $data = $model->getUser();
        
        // Debugging data
        error_log(print_r($data, true));

        $operation['data'] = $data;
        $operation['title'] = 'Mahasiswa Bimbingan';
        $operation['sub_title'] = 'Daftar Mahasiswa Bimbingan Tugas Akhir';

        return view("mahasiswabimbingan/index", $operation);
    }

    public function get_data()
    {
        $mahasiswaModel = new MahasiswaBimbinganModel();
        $data = $mahasiswaModel->getUser();

        $id_mhs = null;
        if (!empty($data)) {
            foreach ($data as $key) {
                $id_mhs = $key['id_mhs'];
            }
        }

        if ($id_mhs !== null) {
            $mahasiswaNim = new MahasiswaModel();
            $mahasiswa = $mahasiswaNim->where('id_user', $id_mhs)->get()->getRow()->th_masuk;
        } else {
            $mahasiswa = 'Data tidak ditemukan';
        }

        $getData = [];
        
        foreach ($data as $bimbingan) {
            if (session()->get('role') == 'Dosen') {
                if ($bimbingan['id_staf'] == session()->get('user_id')) {
                    $getData[] = $bimbingan;
                }
            }
        }

        $operation['data'] = $getData;
        $operation['th_masuk'] = $mahasiswa;
        $operation['title'] = 'Mahasiswa Bimbingan';
        $operation['sub_title'] = 'Daftar Mahasiswa Bimbingan Tugas Akhir';
        
        return view("mahasiswabimbingan/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Data Master Mahasiswa';
        $operation['sub_title'] = '';
        return view('mahasiswabimbingan/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $mastermahasiswa = new MahasiswaBimbinganModel();
        $mastermahasiswa->save($data);
        return redirect()->to('mahasiswabimbingan');
    }

    public function edit($id)
    {
        $mastermahasiswa = new MahasiswaBimbinganModel();
        $dataForm = $mastermahasiswa->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Data Mahasiswa yang Dibimbing';
        $operation['sub_title'] = '';
        return view('mahasiswabimbingan/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $mastermahasiswa = new MahasiswaBimbinganModel();
        $mastermahasiswa->update($id, $data);
        return redirect()->to('mahasiswabimbingan');
    }

    public function delete($id)
    {
        $mastermahasiswa = new MahasiswaBimbinganModel();
        $mastermahasiswa->delete($id);
        return redirect()->to('mahasiswabimbingan');
    }
}
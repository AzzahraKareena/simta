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
    //     // dd($data);
        
    //     // Debugging data
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
    //     // dd($data);

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
        $dosenId = session()->get('user_id');
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getUserByDosen($dosenId, $tahun);
        
        // Debugging data
        error_log(print_r($data, true));

        $operation['data'] = $data;
        $operation['tahun'] = $tahun;
        $operation['title'] = 'Mahasiswa Bimbingan';
        $operation['sub_title'] = 'Daftar Mahasiswa Bimbingan Tugas Akhir';

        return view("mahasiswabimbingan/index", $operation);
    }

    public function get_data()
    {
        $mahasiswaModel = new MahasiswaBimbinganModel();
        $dosenId = session()->get('user_id');

        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $mahasiswaModel->getUserByDosen($dosenId, $tahun);
        // $data = $mahasiswaModel->getUserByDosen($dosenId);

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
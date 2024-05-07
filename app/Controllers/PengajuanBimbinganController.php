<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\PengajuanBimbinganModel;
use CodeIgniter\RESTful\ResourceController;

class PengajuanBimbinganController extends ResourceController
{
    public function table()
    {
        $data = (new PengajuanBimbinganModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Daftar Pengajuan Bimbingan Tugas Akhir';
        return view("pengajuanbimbingan/index", $operation);
    }

    public function get_data() {
        $mahasiswaModel = new MahasiswaModel();
        $bimbinganModel = new PengajuanBimbinganModel();

        // fetch data from bimbingan, then get nama mahasiswa from mahasiswa table where id mhs in bimbingan table
        $data = $bimbinganModel->asObject()->findAll();
        // $data2 = $mahasiswaModel->asObject()->findAll();

        
        foreach ($data as $bimbingan) {
            if (session()->get('role') == 'Mahasiswa') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                $mahasiswa = $mahasiswaModel->where('id_user', session()->get('id'))->first();
                if ($mahasiswa) {
                    $bimbingan->id_mhs = $mahasiswa->id_user;
                    $bimbingan->nama_mahasiswa = $mahasiswa->nama;
                    $bimbingan->nim = $mahasiswa->nim;
                }
            } else {
                // Jika rolenya bukan "Mahasiswa", maka semua data bimbingan akan ditampilkan
                $mahasiswa = $mahasiswaModel->first();
                $bimbingan->id_mhs = $mahasiswa->id_user;
                $bimbingan->nama_mahasiswa = $mahasiswa->nama;
                $bimbingan->nim = $mahasiswa->nim;
            }
        }
        // return $this->response->setJSON($mahasiswa->nama);

        // since i'm not using it as rest api, send it to view
        $operation['data'] = $data;
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Daftar Pengajuan Bimbingan Tugas Akhir';
        return view("pengajuanbimbingan/index", $operation);
        
    }

    public function index() {
        // return data as json for rest
        $data = (new PengajuanBimbinganModel())->asArray()->findAll();
        return $this->response->setJSON($data);
    }
    
    public function create()
    {
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Buat Pengajuan Bimbingan Baru';
        return view('pengajuanbimbingan/create', $operation);
    }

    public function store()
    {
        // $data = $this->request->getPost();
        // get data from request per field
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();

        $data = [
            // id_mhs get from user session
            'id_mhs'  => session()->get('user_id'),
            'lokasi_bimbingan' => $this->request->getPost('lokasi_bimbingan'),
            'hasil_bimbingan' => $this->request->getPost('hasil_bimbingan'),
            'waktu_bimbingan' => $this->request->getPost('waktu_bimbingan'),
            'jadwal_bimbingan' => $this->request->getPost('jadwal_bimbingan'),
            'agenda' => $this->request->getPost('agenda'),
        ];
        // dd($data);
        $insert = $pengajuanBimbinganModel->insert($data);

        if ($insert) {
            return redirect()->to('pengajuanbimbingan');
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }

    }



    public function edit($id = null)
    {
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $dataForm = $pengajuanBimbinganModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Edit Pengajuan Bimbingan';
        return view('pengajuanbimbingan/create', $operation);
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $pengajuanBimbinganModel->update($id, $data);
        return redirect()->to('pengajuanbimbingan');
    }

    public function delete($id = null)
    {
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $pengajuanBimbinganModel->delete($id);
        return redirect()->to('pengajuanbimbingan');
    }
}

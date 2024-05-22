<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\JudulAccModel;
use App\Models\PengajuanJudulModel;
use CodeIgniter\RESTful\ResourceController;

class JudulAccController extends ResourceController
{

    public function table() {
        $bimbinganModel = new JudulAccModel();
    
        // Fetch data from bimbingan
        $data = $bimbinganModel->getPengajuan();
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $bimbingan) {
            if (session()->get('role') == 'Mahasiswa') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($bimbingan['mhs_id'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                if ($bimbingan['dospem_acc'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }
            }
        }
    
        $operation['data'] = $getData;
        $operation['title'] = 'Judul Acc';
        $operation['sub_title'] = 'Daftar Judul Acc';
    
        return view("judulacc/index", $operation);
    }
    
    public function index() {
        // return data as json for rest
        $data = (new JudulAccModel())->asArray()->findAll();
        return $this->response->setJSON($data);
    }
    
    public function create($id = null)
    {
        // dd($id);
        $judulModel = new JudulAccModel();
        $data = $judulModel->getPengajuan();
        $pengajuan = new PengajuanJudulModel();
        $data_pengajuan = $pengajuan->where('id_pengajuanjudul', $id)->getPengajuan();

        foreach ($data_pengajuan as $data) {
           $id_mhs = $data['id_mhs'];
           $nama_mhs = $data['mahasiswa_nama'];
           $judul1 = $data['nama_judul1'];
           $judul2 = $data['nama_judul2'];
           $judul3 = $data['nama_judul3'];
           $dospem1 = $data['dospem1_nama'];
           $dospem2 = $data['dospem2_nama'];
           $dospemId1 = $data['id_rekom_dospem1'];
           $dospemId2 = $data['id_rekom_dospem2'];
        }
        // dd($dospemId1);
        $operation['data'] = $data;
        $operation['id_mhs'] = $id_mhs;
        $operation['nama_mhs'] = $nama_mhs;
        $operation['judul1'] = $judul1;
        $operation['judul2'] = $judul2;
        $operation['judul3'] = $judul3;
        $operation['dospem1'] = $dospem1;
        $operation['dospem2'] = $dospem2;
        $operation['dospemId1'] = $dospemId1;
        $operation['dospemId2'] = $dospemId2;
        $operation['title'] = 'Create Judul Acc';
        $operation['sub_title'] = 'Daftar Judul penilaian';
        return view('judulacc/create', $operation);
    }

    public function store()
    {
        $JudulAccModel = new JudulAccModel();

        $data = [
            // id_mhs get from user session
            'mhs_id'  => $this->request->getPost('mhs_id'),
            'dospem_acc' => $this->request->getPost('dospemId'),
            'judul_acc' => $this->request->getPost('judul_acc'),
        ];
        // dd($data);
        $insert = $JudulAccModel->insert($data);

        if ($insert) {
            return redirect()->to('judulacc');
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }

    }
    
    public function edit($id = null)
    {
        $JudulAccModel = new JudulAccModel();
        $dataForm = $JudulAccModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Edit Pengajuan Bimbingan';
        return view('pengajuanbimbingan/create', $operation);
    }

    public function updateStatus($id = null)
    {
        $JudulAccModel = new JudulAccModel();
        $data = $this->request->getPost('status');
        $JudulAccModel->update($id, ['status_ajuan' => $data]);
        return redirect()->to('pengajuanbimbingan');
    }

    public function updateTracking($id = null)
    {
        $JudulAccModel = new JudulAccModel();
        $data = $this->request->getPost('tracking');
        $JudulAccModel->update($id, ['tracking' => $data]);
        return redirect()->to('pengajuanbimbingan');
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $JudulAccModel = new JudulAccModel();
        $JudulAccModel->update($id, $data);
        return redirect()->to('pengajuanbimbingan');
    }

    public function updateBimbingan($id)
    {
        // Menerima data dari POST request
        $requestData = $this->request->getJSON();

        // Menyiapkan model
        $JudulAccModel = new JudulAccModel();

        // Menyiapkan data yang akan diupdate
        $dataToUpdate = [
            'waktu_bimbingan' => $requestData->waktu_bimbingan,
            'lokasi_bimbingan' => $requestData->lokasi_bimbingan,
            'hasil_bimbingan' => $requestData->hasil_bimbingan,
            'jadwal_bimbingan' => $requestData->jadwal_bimbingan,
            'agenda' => $requestData->agenda,
            // Tambahkan kolom lainnya sesuai kebutuhan
        ];

        // Melakukan update data berdasarkan id
        $JudulAccModel->update($id, $dataToUpdate);

        // Response JSON jika diperlukan
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data updated successfully']);
    }

    public function delete($id = null)
    {
        $JudulAccModel = new JudulAccModel();
        $JudulAccModel->delete($id);
        return redirect()->to('judulacc');
    }

    // public function verifikasi($id = null)
    // {
    //     // Pastikan hanya admin yang dapat melakukan verifikasi
    //     if (session()->get('role') !== 'Admin') {
    //         return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan verifikasi.');
    //     }

    //     $status = $this->request->getPost('status');

    //     // Periksa apakah status yang diinginkan adalah status yang valid
    //     if (!in_array($status, ['Disetujui', 'revisi', 'ditolak'])) {
    //         return redirect()->back()->with('error', 'Status ajuan tidak valid.');
    //     }

    //     // Perbarui status ajuan di database
    //     $JudulAccModel = new JudulAccModel();
    //     $JudulAccModel->update($id, ['status_ajuan' => $status]);

    //     return redirect()->back()->with('success', 'Status ajuan berhasil diperbarui.');
    // }

}
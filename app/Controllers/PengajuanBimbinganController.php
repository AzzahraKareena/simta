<?php

namespace App\Controllers;

use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
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
        $bimbinganModel = new PengajuanBimbinganModel();
        $data = $bimbinganModel->getPengajuan();

        $id_mhs = null; // Nilai default jika tidak ada data
        if (!empty($data)) {
            foreach ($data as $key) {
                $id_mhs = $key['id_mhs'];
            }
        }

        if ($id_mhs !== null) {
            $mahasiswaNim = new MahasiswaModel();
            $mahasiswa = $mahasiswaNim->where('id_user', $id_mhs)->get()->getRow()->nim;
        } else {
            $mahasiswa = 'Data tidak ditemukan'; // Atau tindakan lain yang sesuai
        }

    
        // Fetch data from bimbingan
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $bimbingan) {
            if (session()->get('role') == 'Mahasiswa') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($bimbingan['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                if ($bimbingan['id_staf'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }
            }
        }
    
        // Ambil data enum dari field status
        $query = $bimbinganModel->query("SHOW COLUMNS FROM simta_pengajuanbimbingan LIKE 'tracking'");
        $row = $query->getRow();
        preg_match("/^enum\(\'(.*)\'\)$/", $row->Type, $matches);
        $enum_values = explode("','", $matches[1]);
    
        // Since I'm not using it as a REST API, send it to view
        $operation['data'] = $getData;
        $operation['nim'] = $mahasiswa;
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Daftar Pengajuan Bimbingan Tugas Akhir';
        $operation['tracking'] = $enum_values;
    
        return view("pengajuanbimbingan/index", $operation);
    }
    
    public function index() {
        // return data as json for rest
        $data = (new PengajuanBimbinganModel())->asArray()->findAll();
        return $this->response->setJSON($data);
    }
    
    public function create()
    {
        $judulModel = new JudulAccModel();
        // dd(session()->get('user_id'));

        if (session()->get('role') == 'Mahasiswa') {
            $dataJudul = $judulModel->where('mhs_id',session()->get('user_id'))->getPengajuan();
        } elseif (session()->get('role') == 'Dosen') {
            $dataJudul = $judulModel->where('dospem_acc',session()->get('user_id'))->getPengajuan();
        }

        $operation['data'] = $dataJudul;
        $operation['title'] = 'Pengajuan Bimbingan';
        $operation['sub_title'] = 'Buat Pengajuan Bimbingan Baru';
        return view('pengajuanbimbingan/create', $operation);
    }

    public function store()
    {
        // $data = $this->request->getPost();
        // get data from request per field
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $judulAcc = new JudulAccModel();
        $id_mhs = $judulAcc->where('id_accjudul', $this->request->getPost('id_accjudul'))->get()->getRow()->mhs_id;
        $id_staf = $judulAcc->where('id_accjudul', $this->request->getPost('id_accjudul'))->get()->getRow()->dospem_acc;
        // dd($id_staf);

        $data = [
            // id_mhs get from user session
            'id_mhs'  => $id_mhs,
            'id_staf'  => $id_staf,
            'id_accjudul' => $this->request->getPost('id_accjudul'),
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

    public function updateStatus($id = null)
    {
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $data = $this->request->getPost('status');
        $pengajuanBimbinganModel->update($id, ['status_ajuan' => $data]);
        return redirect()->to('pengajuanbimbingan');
    }

    public function updateTracking($id = null)
    {
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $data = $this->request->getPost('tracking');
        $pengajuanBimbinganModel->update($id, ['tracking' => $data]);
        return redirect()->to('pengajuanbimbingan');
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $pengajuanBimbinganModel->update($id, $data);
        return redirect()->to('pengajuanbimbingan');
    }

    public function updateBimbingan($id)
    {
        // Menerima data dari POST request
        $requestData = $this->request->getJSON();

        // Menyiapkan model
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();

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
        $pengajuanBimbinganModel->update($id, $dataToUpdate);

        // Response JSON jika diperlukan
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data updated successfully']);
    }

    public function delete($id = null)
    {
        $pengajuanBimbinganModel = new PengajuanBimbinganModel();
        $pengajuanBimbinganModel->delete($id);
        return redirect()->to('pengajuanbimbingan');
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
    //     $pengajuanBimbinganModel = new PengajuanBimbinganModel();
    //     $pengajuanBimbinganModel->update($id, ['status_ajuan' => $status]);

    //     return redirect()->back()->with('success', 'Status ajuan berhasil diperbarui.');
    // }

}
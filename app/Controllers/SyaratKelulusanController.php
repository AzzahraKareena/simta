<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\SyaratKelulusanModel;
use CodeIgniter\RESTful\ResourceController;

class SyaratKelulusanController extends ResourceController
{
    public function table()
    {
            $data = (new SyaratKelulusanModel())->asArray()->findAll();
            
            $operation['data'] = $data;
            $operation['title'] = 'Syarat Kelulusan';
            $operation['sub_title'] = 'Daftar Syarat Kelulusan Tugas Akhir';
            return view("syaratkelulusan/index", $operation);
        }
    
        public function get_data() {
            $mahasiswaModel = new MahasiswaModel();
            $syaratKelulusanModel = new SyaratKelulusanModel();
        
            $data = $syaratKelulusanModel->asObject()->findAll();
            foreach ($data as $syarat) {
            $mahasiswa = $mahasiswaModel->where('id_user', $syarat->id_mhs)->first();
            // $syarat->nama_mahasiswa = $mahasiswa->nama;
            }
        
            $operation['data'] = $data;
            $operation['title'] = 'Syarat Kelulusan';
            $operation['sub_title'] = 'Daftar Syarat Kelulusan Tugas Akhir';
            return view("syaratkelulusan/index", $operation);
        }
        
    public function index() {
        // return data as json for rest
        $data = (new SyaratKelulusanModel())->asArray()->findAll();
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $operation['title'] = 'Syarat Kelulusan';
        $operation['sub_title'] = 'Tambah Syarat Kelulusan';
        return view('syaratkelulusan/create', $operation);
    }
    
    public function store()
    {
        // $data = $this->request->getPost();
        // get data from request per field
        $syaratKelulusanModel = new SyaratKelulusanModel();

        $data = [
            // id_mhs get from user session
            'id_mhs'  => session()->get('user_id'),
            'poster' => $this->request->getPost('poster'),
            'lembar_pengesahan' => $this->request->getPost('lembar_pengesahan'),
            'lembar_persetujuan' => $this->request->getPost('lembar_persetujuan'),
            'bukti_pelunasan_ukt' => $this->request->getPost('bukti_pelunasan_ukt'),
            'surat_bebas_lab' => $this->request->getPost('surat_bebas_lab'),
            'aplikasi_ta' => $this->request->getPost('aplikasi_ta'),
            'laporan_ta_word' => $this->request->getPost('laporan_ta_word'),
            'laporan_ta_pdf' => $this->request->getPost('laporan_ta_pdf'),
            'ktp' => $this->request->getPost('ktp'),

        ];
        // dd($data);
        $insert = $syaratKelulusanModel->insert($data);

        if ($insert) {
            return redirect()->to('syaratkelulusan');
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

    public function edit($id = null)
    {
        $syaratKelulusanModel = new SyaratKelulusanModel();
        $dataForm = $syaratKelulusanModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Syarat Kelulusan';
        $operation['sub_title'] = 'Edit Syarat Kelulusan';
        return view('syaratkelulusan/create', $operation);
    }

    public function updateStatus($id = null)
    {
        $syaratKelulusanModel = new SyaratKelulusanModel();
        $data = $this->request->getPost('status_syarat');
        // dd($data);
        $syaratKelulusanModel->update($id, ['status_syarat' => $data]);
        // $model->update($id, ['status' => $status]);
        return redirect()->to('syaratkelulusan');
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $syaratKelulusanModel = new SyaratKelulusanModel();
        $syaratKelulusanModel->update($id, $data);
        return redirect()->to('syaratkelulusan');
    }

    public function delete($id = null)
    {
        $syaratKelulusanModel = new SyaratKelulusanModel();
        $syaratKelulusanModel->delete($id);
        return redirect()->to('syaratkelulusan');
    }

    public function verifikasi($id = null)
    {
        // Pastikan hanya admin yang dapat melakukan verifikasi
        if (session()->get('role') !== 'Admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan verifikasi.');
        }

        $status = $this->request->getPost('status');

        // Periksa apakah status yang diinginkan adalah status yang valid
        if (!in_array($status, ['Validasi', 'Sedang Proses'])) {
            return redirect()->back()->with('error', 'Status ajuan tidak valid.');
        }

        // Perbarui status ajuan di database
        $syaratKelulusanModel = new SyaratKelulusanModel();
        $syaratKelulusanModel->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Status ajuan berhasil diperbarui.');
    }
    public function updateValidationStatus($id = null)
{
    // Pastikan hanya admin yang dapat melakukan validasi
    if (session()->get('role') !== 'Admin') {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Anda tidak memiliki izin untuk melakukan validasi.']);
    }

    $syaratKelulusanModel = new SyaratKelulusanModel();
    $status = $this->request->getPost('status');

    // Perbarui status validasi syarat kelulusan di database
    $syaratKelulusanModel->update($id, ['status_syarat' => $status]);

    return $this->response->setJSON(['status' => 'success', 'message' => 'Status validasi berhasil diperbarui.']);
}
  
}
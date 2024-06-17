<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MengelolaSuratModel;
use CodeIgniter\HTTP\ResponseInterface;


class MengelolaSuratController extends BaseController
{
    protected $mengelolaSuratModel;

    public function __construct()
    {
        $this->mengelolaSuratModel = new MengelolaSuratModel();
    }

    public function index()
    {
        $data['title'] = 'Pengelolaan Surat';
        $data['sub_title'] = '';
        $data['surat'] = $this->mengelolaSuratModel->findAll();

        return view('mengelolasurat/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Pengelolaan Surat';
        $data['sub_title'] = 'Data Pengelolaan Surat Tugas Akhir';

        return view('mengelolasurat/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
    
        // Lakukan validasi data
        if (!$this->validate([
            'id_mhs' => 'required|integer',
            'id_staf' => 'required|integer',
            'surat_undangan' => 'uploaded[surat_undangan]|max_size[surat_undangan,1024]|ext_in[surat_undangan,pdf]',
            'surat_tugas' => 'uploaded[surat_tugas]|max_size[surat_tugas,1024]|ext_in[surat_tugas,pdf]'
        ])) {
            // Jika validasi gagal, kembalikan dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Ambil file yang diupload
        $suratUndangan = $this->request->getFile('surat_undangan');
        $suratTugas = $this->request->getFile('surat_tugas');
    
        // Pindahkan file ke folder yang ditentukan (contoh: public/assets/surat)
        if ($suratUndangan->isValid() && !$suratUndangan->hasMoved()) {
            $newNameUndangan = $suratUndangan->getRandomName();
            $suratUndangan->move(ROOTPATH . 'public/public/assets/surat', $newNameUndangan);
            $data['surat_undangan'] = $newNameUndangan;
        }
    
        if ($suratTugas->isValid() && !$suratTugas->hasMoved()) {
            $newNameTugas = $suratTugas->getRandomName();
            $suratTugas->move(ROOTPATH . 'public/public/assets/surat', $newNameTugas);
            $data['surat_tugas'] = $newNameTugas;
        }
    
        // Simpan data ke dalam database
        $mengelolaSuratModel = new MengelolaSuratModel();
        $mengelolaSuratModel->save($data);
    
        // Set flashdata untuk sukses dan redirect ke halaman index
        session()->setFlashdata('success', 'Surat berhasil disimpan.');
        return redirect()->to(base_url('mengelolasurat'));
    }
    
    

    public function edit($id)
    {
        $data['title'] = 'Pengelolaan Surat';
        $data['sub_title'] = 'Edit Data Surat';

        $data['surat'] = $this->mengelolaSuratModel->find($id);

        return view('mengelolasurat/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'id_mhs' => 'required',
            'id_staf' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $data = [
            'id_mhs' => $this->request->getPost('id_mhs'),
            'id_staf' => $this->request->getPost('id_staf'),
        ];

        $this->mengelolaSuratModel->update($id, $data);

        return redirect()->to('mengelolasurat')->with('success', 'Surat berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->mengelolaSuratModel->delete($id);

        return redirect()->to('mengelolasurat')->with('success', 'Surat berhasil dihapus');
    }
}

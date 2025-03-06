<?php

namespace App\Controllers;

use App\Models\JadwalBimbinganModel;
use App\Models\MahasiswaBimbinganModel;

class JadwalBimbinganController extends BaseController
{
    protected $jadwalModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalBimbinganModel();
    }

    public function index()
    {
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $role = session()->get('role');
        $id_dosen = null;
    
        if ($role == 'Dosen') {
            $id_dosen = session()->get('user_id'); // Ambil ID dosen dari session
        } elseif ($role == 'Mahasiswa') {
            $mahasiswaModel = new MahasiswaBimbinganModel();
            $mahasiswa = $mahasiswaModel->withJudul()
                ->where('mhs.id', session()->get('user_id'))
                ->first();
    
            if ($mahasiswa) {
                $id_dosen = $mahasiswa['dospem_acc']; // Ambil dospem_acc dari judul
            }
        }

        if ($role == 'Koordinator') {
            $data = $this->jadwalModel->getAllJadwalBimbingan(); // Ambil semua jadwal
        } else {
             $data = $this->jadwalModel->getJadwalBimbinganByDospem($id_dosen, $tahun); 
        }
    
        // dd($data);
    
        $operation['data'] = $data;
        $operation['tahun'] = $tahun;
        $operation['title'] = 'Jadwal Bimbingan';
        $operation['sub_title'] = 'Jadwal Bimbingan Tugas Akhir';
        
        return view('jadwal_bimbingan/index', $operation);
    }
    // Menampilkan form untuk menambah jadwal bimbingan
    public function create()
    {
        return view('jadwal_bimbingan/create');
    }

    // Menyimpan jadwal bimbingan baru
    public function store()
    {
        $this->jadwalModel->save([
            'id_dosen' => session()->get('user_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'tempat' => $this->request->getPost('tempat'),
        ]);
        return redirect()->to('/jadwalbimbingan');
    }


        public function edit($id)
        {
            $dataForm = $this->jadwalModel->find($id);
            $dataForm['id_jadwal_bimbingan'] = $id;
            if (!$dataForm) {
                // Jika tidak ditemukan, redirect atau tampilkan pesan error
                return redirect()->to('/jadwalbimbingan')->with('error', 'Jadwal tidak ditemukan');
            }
            // dd($dataForm);
            
            return view('jadwal_bimbingan/create', ['dataForm' => $dataForm]);
        }

    // Memperbarui jadwal bimbingan
    public function update($id)
    {
        $this->jadwalModel->update($id, [
            'id_dosen' => session()->get('user_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'tempat' => $this->request->getPost('tempat'),
        ]);
        return redirect()->to('/jadwalbimbingan');
    }

    // Menghapus jadwal bimbingan
    public function delete($id)
    {
        $this->jadwalModel->delete($id);
        return redirect()->to('/jadwalbimbingan');
    }
}
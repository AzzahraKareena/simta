<?php

namespace App\Controllers;

use App\Models\LogbookModel;
use App\Models\MahasiswaModel;
use App\Models\JudulAccModel;
use App\Models\JadwalBimbinganModel;
use App\Models\UsersModel;

class LogbookController extends BaseController
{
    protected $logbookModel;

    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
        $this->mahasiswaModel = new MahasiswaModel(); 
        $this->jadwalModel = new JadwalBimbinganModel();
        $this->judulAccModel = new JudulAccModel();
        $this->usersModel = new UsersModel();
    }

 
    public function index()
    {
        $role = session()->get('role');
        $operation = [];

        if ($role == 'Mahasiswa') {
            $id_mahasiswa = session()->get('user_id');
            $operation['logbook'] = $this->logbookModel->getLogbookByMahasiswa($id_mahasiswa);
        } else {
            // For Dosen and Koordinator
            $operation['mahasiswa'] = $this->mahasiswaModel->findAllMahasiswa();
            $operation['logbook'] = $this->logbookModel->getAllLogbook(); 
        }

  

        $operation['title'] = 'Logbook';
        $operation['sub_title'] = 'Logbook Bimbingan Tugas Akhir';
        // dd($data);
        return view('logbook/index', $operation);
    }
    public function view($id)
    {
        // Fetch mahasiswa details using the provided ID
        $mahasiswa = $this->mahasiswaModel->find($id);
    
        // Check if mahasiswa exists
        if (!$mahasiswa) {
            // Handle the case where the mahasiswa is not found
            return redirect()->to('/logbook')->with('error', 'Mahasiswa not found.');
        }
    
        // Get the user ID from the mahasiswa record
        $id_user = $mahasiswa->id_user; // Assuming 'id_user' is the correct field in the mahasiswa table
    
        // Fetch logbook entries for the selected mahasiswa using the user ID
        $data['logbook'] = $this->logbookModel->getLogbookByMahasiswa($id_user);
        
        // Pass the mahasiswa details to the view
        $data['mahasiswa'] = $mahasiswa;
        $data['title'] = 'Logbook';
        $data['sub_title'] = 'Logbook tugas akhir';
    
        return view('logbook/view', $data);
    }

    // Menampilkan form untuk menambah logbook
    public function create()
    {
        // Get the logged-in student's ID
        $id_mahasiswa = session()->get('user_id');

        // Fetch the dospem (advisor) for the logged-in student
        $judulAcc = $this->judulAccModel->where('mhs_id', $id_mahasiswa)->first();
        $id_dosen = $judulAcc['dospem_acc']; // Assuming 'dospem_acc' is the field for the advisor's ID

        // Fetch the schedules for the advisor
        $schedules = $this->jadwalModel->where('id_dosen', $id_dosen)->findAll();

        // Pass the schedules to the view
        return view('logbook/create', ['schedules' => $schedules]);
    }

    public function store()
    {
        // Handle the form submission to create a logbook entry
        $data = [
            'id_jadwal' => $this->request->getPost('id_jadwal'),
            'id_mahasiswa' => session()->get('user_id'),
            'catatan' => $this->request->getPost('catatan'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->logbookModel->insert($data);
        return redirect()->to('/logbook')->with('success', 'Logbook created successfully.');
    }
    // Menampilkan form untuk mengedit logbook
    public function edit($id)
    {
          // Ambil data logbook berdasarkan ID
    $logbook = $this->logbookModel->find($id);
    $id_mahasiswa = session()->get('user_id');
    
    // Jika data tidak ditemukan, redirect ke halaman logbook
    if (!$logbook) {
        return redirect()->to('/logbook')->with('error', 'Logbook tidak ditemukan.');
    }

    $judulAcc = $this->judulAccModel->where('mhs_id', $id_mahasiswa)->first();
    $id_dosen = $judulAcc['dospem_acc']; // Assuming 'dospem_acc' is the field for the advisor's ID

    // Fetch the schedules for the advisor
    $schedules = $this->jadwalModel->where('id_dosen', $id_dosen)->findAll();

    // Kirim data ke view
    $data = [
        'logbook' => $logbook,
        'schedules' => $schedules
    ];
        return view('logbook/create', $data);
    }

    // Memperbarui logbook
    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'catatan' => 'required|min_length[3]',
            'id_jadwal' => 'required'
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errorForm', $validation->getErrors());
        }
    
        // Data untuk update
        $data = [
            'catatan' => $this->request->getPost('catatan'),
            'id_jadwal' => $this->request->getPost('id_jadwal'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        // Update data
        if ($this->logbookModel->update($id, $data)) {
            return redirect()->to('/logbook')->with('success', 'Logbook berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui logbook.');
        }
    }

    // Menghapus logbook
    public function delete($id)
    {
        $this->logbookModel->deleteLogbook($id);
        return redirect()->to('/logbook');
    }
}
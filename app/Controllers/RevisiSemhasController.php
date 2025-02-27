<?php namespace App\Controllers;

use App\Models\RevisiSemhasModel;
use App\Models\JadwalSemhasModel;
use CodeIgniter\Controller;

class RevisiSemhasController extends Controller
{
    public function create($id_rilis_jadwal)
    {
        $mahasiswa = new  JadwalSemhasModel();
        $mhs = $mahasiswa->where('id_rilis_jadwal_semhas', $id_rilis_jadwal)->getJadwal();
        $data['mahasiswa'] = $mhs;
        $data['id_rilis_jadwal'] = $id_rilis_jadwal;
        $data['title'] = 'Tambah Catatan Revisi';
        return view('revisisemhas/create', $data); // Adjust the view path as necessary
    }

    public function store()
    {
        $revisionModel = new RevisiSemhasModel();
        $catatan_revisi = $this->request->getPost('catatan_revisi');
        $id_rilis_jadwal = $this->request->getPost('id_rilis_jadwal');
        $id_penguji = session()->get('user_id'); // Ensure this is passed

        if (!empty($catatan_revisi)) {
            foreach ($catatan_revisi as $revisi) {
                if (!empty($revisi)) {
                    $revisionModel->insert([
                        'id_rilis_jadwal_semhas' => $id_rilis_jadwal,
                        'id_penguji' => $id_penguji,
                        'catatan_revisi' => $revisi,
                    ]);
                }
            }
            return redirect()->to('rilisjadwalsemhas')->with('success', 'Catatan revisi berhasil disimpan.'); 
        }

        return redirect()->back()->with('error', 'Tidak ada catatan revisi untuk disimpan.');
    }
}
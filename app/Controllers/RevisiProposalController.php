<?php namespace App\Controllers;

use App\Models\RevisiProposalModel;
use App\Models\JadwalUjianPropoModel; 
use CodeIgniter\Controller;

class RevisiProposalController extends Controller
{
    public function create($id=null)
    {
        $mahasiswa = new  JadwalUjianPropoModel();
        $mhs = $mahasiswa->where('id_rilis_jadwal', $id)->getJadwal();
        $data['mahasiswa'] = $mhs; // Fetch all mahasiswa data
        $data['id_rilis_jadwal'] = $id;

        $data['title'] = 'Tambah Catatan Revisi';
        return view('revisiproposal/create', $data);
    }

    public function store()
    {
        $revisionModel = new RevisiProposalModel();
        $catatan_revisi = $this->request->getPost('catatan_revisi');
        $id_rilis_jadwal = $this->request->getPost('id_rilis_jadwal');

        if (!empty($catatan_revisi)) {
            foreach ($catatan_revisi as $revisi) {
                if (!empty($revisi)) {
                    $revisionModel->insert([
                     
                        'id_rilis_jadwal' => $id_rilis_jadwal,
                        'id_penguji' => session()->get('user_id'), // Assuming you have this ID available
                        'catatan_revisi' => $revisi,
                    ]);
                }
            }
            return redirect()->to('rilisjadwal'); 
        }
    
        return redirect()->back()->with('error', 'Tidak ada catatan revisi untuk disimpan.');
    }
}
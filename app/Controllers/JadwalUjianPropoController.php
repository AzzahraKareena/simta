<?php

namespace App\Controllers;

use TCPDF;
use App\Models\StafModels;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\PengajuanUjianProposalModel;

class JadwalUjianPropoController extends BaseController
{
    public function table()
    {
        // dd(session()->get('user_id'));
        $data = (new JadwalUjianPropoModel())->getJadwal();
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $jadwal) {
            if (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($jadwal['id_penguji1'] == session()->get('user_id')) {
                    $getData[] = $jadwal; // Tambahkan ke array
                }elseif ($jadwal['id_penguji2'] == session()->get('user_id')) {
                    $getData[] = $jadwal; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($jadwal['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $jadwal; // Tambahkan ke array
                }
            }elseif (session()->get('role') == 'Koordinator') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                    $getData[] = $jadwal; // Tambahkan ke array
            }
        }
        $operation['data'] = $getData;
        $operation['title'] = 'Rilis Jadwal Ujian Proposal';
        $operation['sub_title'] = 'Daftar Jadwal Ujian Proposal';
        // dd($operation['data']);
        return view("rilisjadwal/index", ['data' => $operation['data']]);
    }
    
    public function create()
    {
        // $id_mhs = session()->get('user_id');
        $pengajuanUjianPropo = new PengajuanUjianProposalModel();
        $dataPengajuanUjian = $pengajuanUjianPropo->getMhs();
        // dd($dataPengajuanUjian);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pengajuan'] = $dataPengajuanUjian;
        $operation['dosen'] = (new StafModels())->asArray()->findAll();
        // dd($operation['pjudul']);
        return view('rilisjadwal/create', ['pengajuan' => $operation['pengajuan'], 'dosen' => $operation['dosen']]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        // dd($data);
        $jadwalModel = new JadwalUjianPropoModel();
        $jadwalModel->save($data);
        return redirect()->to('rilisjadwal');
    }


    public function edit($id)
    {
        $jadwalModel = new JadwalUjianPropoModel();
        $dataForm = $jadwalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Rilis Jadwal Ujian Proposal';
        $operation['sub_title'] = 'Edit Jadwal Ujian Proposal';
        $operation['dosen'] = (new StafModels())->asArray()->findAll();
        return view('rilisjadwal/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $jadwalModel = new JadwalUjianPropoModel();
        $jadwalModel->update($id, $data);
        return redirect()->to('rilisjadwal');
    }

    public function delete($id)
    {
        $jadwalModel = new JadwalUjianPropoModel();
        $jadwalModel->delete($id);
        return redirect()->to('rilisjadwal');
    }
}

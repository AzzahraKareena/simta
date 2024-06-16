<?php

namespace App\Controllers;

use App\Models\JudulAccModel;
use App\Controllers\BaseController;
use App\Models\PengajuanSidangModel;

class PengajuanSidangController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanSidangModel())->asArray()->findAll();

        $getData = [];
        
        foreach ($data as $ujian) {
            if (session()->get('role') == 'Dosen') {
                if ($ujian['id_dospem'] == session()->get('user_id')) {
                    $getData[] = $ujian; 
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($ujian['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $ujian; 
                }
            }elseif (session()->get('role') == 'Koordinator') {
                    $getData[] = $ujian; 
            }
        }
        // Cek apakah mahasiswa yang login sudah memiliki data pengajuan
        $mahasiswaId = session()->get('user_id');
        // dd($mahasiswaId);
        $mahasiswaSudahMengajukan = false;
        foreach ($data as $item) {
            if ($item['id_mhs'] == $mahasiswaId && $item['status_pengajuan'] != 'DITOLAK') {
                $mahasiswaSudahMengajukan = true;
                break;
            }
        }
        $operation['data'] = $getData;
        $operation['mahasiswaSudahMengajukan'] = $mahasiswaSudahMengajukan;
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Daftar Pengajuan Sidang';
        return view("pengajuansidang/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Buat Pengajuan Sidang Baru';
        return view('pengajuansidang/create', $operation);
    }

    public function store()
    {
        $id_mhs = session()->get('user_id');
        $data = $this->request->getPost();
        $data['id_mhs'] = $id_mhs;

        $judulAccModel = new JudulAccModel();
        $id_accjudul = $judulAccModel->where('mhs_id', $id_mhs)->get()->getRow()->id_accjudul;
        $id_dospem = $judulAccModel->where('id_accjudul', $id_accjudul)->get()->getRow()->dospem_acc;
        $data['id_accjudul'] = $id_accjudul;
        $data['id_dospem'] = $id_dospem;
        
        $pengajuanSidang = new PengajuanSidangModel();
        $pengajuanSidang->insert($data);
        return redirect()->to('pengajuansidang');
    }

    public function edit($id)
    {
        $pengajuanSidang = new PengajuanSidangModel();
        $dataForm = $pengajuanSidang->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Edit Pengajuan Sidang';
        return view('pengajuansidang/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanSidang = new PengajuanSidangModel();
        $pengajuanSidang->update($id, $data);
        return redirect()->to('pengajuansidang');
    }

    public function delete($id)
    {
        $pengajuanSidang = new PengajuanSidangModel();
        $pengajuanSidang->delete($id);
        return redirect()->to('pengajuansidang');
    }
}

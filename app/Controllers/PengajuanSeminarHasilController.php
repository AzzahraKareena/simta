<?php

namespace App\Controllers;

use App\Models\JudulAccModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PengajuanSeminarHasilModel;

class PengajuanSeminarHasilController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanSeminarHasilModel())->asArray()->findAll();

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

        $mahasiswaId = session()->get('user_id');
        $mahasiswaSudahMengajukan = false;
        foreach ($data as $item) {
            if ($item['id_mhs'] == $mahasiswaId && $item['status_pengajuan'] != 'DITOLAK') {
                $mahasiswaSudahMengajukan = true;
                break;
            }
        }
        $operation['data'] = $getData;
        $operation['mahasiswaSudahMengajukan'] = $mahasiswaSudahMengajukan;
        
        $operation['title'] = 'Data Pengajuan Seminar Hasil';
        $operation['sub_title'] = '';
        return view("pengajuanseminarhasil/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        return view('pengajuanseminarhasil/create', $operation);
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
        // $data['id_dospem'] = $id_dospem;
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $pengajuanSeminarHasil->save($data);
        return redirect()->to('pengajuanseminarhasil');
    }

    public function edit($id)
    {
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $dataForm = $pengajuanSeminarHasil->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        return view('pengajuanseminarhasil/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $pengajuanSeminarHasil->update($id, $data);
        return redirect()->to('pengajuanseminarhasil');
    }

    public function delete($id)
    {
        $pengajuanSeminarHasil = new PengajuanSeminarHasilModel();
        $pengajuanSeminarHasil->delete($id);
        return redirect()->to('pengajuanseminarhasil');
    }
}

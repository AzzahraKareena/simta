<?php

namespace App\Controllers;

use App\Models\JudulAccModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PengajuanSeminarHasilModel;
use App\Models\MahasiswaBimbinganModel;

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
        $insert = $pengajuanSeminarHasil->save($data);
        if ($insert) {
            $judulAcc = $judulAccModel->where('id_accjudul', $id_accjudul)->get()->getRow();
            if ($judulAcc) {
                $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($id_accjudul, 'Pengajuan Seminar Hasil');
            } else {
                echo "Record with id_accjudul: $id_accjudul not found";
            }
        }
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

    public function updateStatus($id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanSeminarHasilModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        // Ambil status dari post data
        $status = $this->request->getPost('status');

        // Update status_pengajuan di tabel pengajuan_ujian_proposal
        $pengajuanUjianProposalModel->update($id, ['status_pengajuan' => $status]);

        // Jika status adalah REVISI, update tracking di tabel simta_mahasiswa_bimbingan
        if ($status === 'REVISI') {
            // Dapatkan data judul_acc_id dari tabel pengajuan_ujian_proposal
            $pengajuan = $pengajuanUjianProposalModel->find($id);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['id_accjudul'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Revisi Seminar Hasil');
            }
        }

        return redirect()->to('pengajuanseminarhasil');
    }

    public function uploadRevisi($semhasId, $id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanSeminarHasilModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/revisi_semhas/', $newFileName);

            // Simpan detail file ke dalam database
            $pengajuanUjianProposalModel->update($semhasId, [
                'revisi_laporan' => $newFileName,
                'revisi_laporan_date' => date('Y-m-d H:i:s')
            ]);

            // Dapatkan data pengajuan berdasarkan ID
            $pengajuan = $pengajuanUjianProposalModel->find($semhasId);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['id_accjudul'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Pengumpulan Revisi Seminar Hasil');
            }

            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function unduhRevisi($id)
    {
        $fileModel = new PengajuanSeminarHasilModel();
        $file = $fileModel->find($id);

        if ($file) {
            // Menambahkan path absolut
            $filePath = FCPATH . 'public/assets/revisi_semhas/' . $file['revisi_laporan'];
            $fileName = $file['revisi_laporan'];

            return $this->response->download($filePath, null)->setFileName($fileName);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }
    }
}

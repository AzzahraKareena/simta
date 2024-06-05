<?php

namespace App\Controllers;

use TCPDF;
use App\Libraries\CustomPDF;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\MahasiswaBimbinganModel;
use App\Models\PengajuanUjianProposalModel;

class PengajuanUjianProposalController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanUjianProposalModel())->getAllPengajuanWithJadwal();
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $ujian) {
            if (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($ujian['id_dospem'] == session()->get('user_id')) {
                    $getData[] = $ujian; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($ujian['mahasiswa'] == session()->get('user_id')) {
                    $getData[] = $ujian; // Tambahkan ke array
                }
            }elseif (session()->get('role') == 'Koordinator') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                    $getData[] = $ujian; // Tambahkan ke array
            }
        }
        // Cek apakah mahasiswa yang login sudah memiliki data pengajuan
        $mahasiswaId = session()->get('user_id');
        // dd($mahasiswaId);
        $mahasiswaSudahMengajukan = false;
        foreach ($data as $item) {
            if ($item['mahasiswa'] == $mahasiswaId && $item['status_pengajuan'] != 'DITOLAK') {
                $mahasiswaSudahMengajukan = true;
                break;
            }
        }
        $operation['data'] = $getData;
        $operation['mahasiswaSudahMengajukan'] = $mahasiswaSudahMengajukan;
        // dd($data);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Daftar Pengajuan Ujian Proposal';
        return view("pengajuanujianproposal/index", $operation);
    }
    
    public function create()
    {
        // $id_mhs = session()->get('user_id');
        $judulAcc = new JudulAccModel();
        $dataJudul = $judulAcc->where('mhs.id',session()->get('user_id'))->getPengajuan();
        // dd($dataJudul);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pjudul'] = $dataJudul;
        // dd($operation['pjudul']);
        return view('pengajuanujianproposal/create', ['pjudul' => $operation['pjudul']]);
    }

    // public function store()
    // {
    //     $id_mhs = session()->get('user_id');

    //     // Ambil data post
    //     $data = $this->request->getPost();
        
    //     // Tambahkan id_mhs ke data
    //     $data['mahasiswa'] = $id_mhs;
    //     // $data['judul_acc_id'] = $this->request->getVar('judul_acc_id');

    //     $judulAcc = new JudulAccModel();
    //     $id_dospem = $judulAcc->where('id_accjudul', $this->request->getPost('judul_acc_id'))->get()->getRow()->dospem_acc;
    //     $data['id_dospem'] = $id_dospem;

    //     // Mengelola file upload
    //     $file = $this->request->getFile('proposal_ta');
    //     if ($file->isValid() && !$file->hasMoved()) {
    //         $newName = $file->getName();
    //         $file->move('public/assets/proposal/', $newName);
    //         $data['proposal_ta'] = $newName;
    //     }

    //     // Insert ke database
    //     $data['status'] = $this->request->getPost('status');
    //     // $data['judul_acc_id'] = $this->request->getPost('id_accjudul');

    //     // dd($data);
    //     $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
    //     $pengajuanUjianProposalModel->insert($data);

    //     return redirect()->to('pengajuanujianproposal');
    // }

    // public function store()
    // {
    //     $id_mhs = session()->get('user_id');

    //     // Ambil data post
    //     $data = $this->request->getPost();
        
    //     // Tambahkan id_mhs ke data
    //     $data['mahasiswa'] = $id_mhs;
    //     // $data['judul_acc_id'] = $this->request->getVar('judul_acc_id');

    //     $judulAccModel = new JudulAccModel();
    //     $id_dospem = $judulAccModel->where('id_accjudul', $this->request->getPost('judul_acc_id'))->get()->getRow()->dospem_acc;
    //     $data['id_dospem'] = $id_dospem;

    //     // Mengelola file upload
    //     $file = $this->request->getFile('proposal_ta');
    //     if ($file->isValid() && !$file->hasMoved()) {
    //         $newName = $file->getName();
    //         $file->move('public/assets/proposal/', $newName);
    //         $data['proposal_ta'] = $newName;
    //     }

    //     // Insert ke database

    //     // dd($data);
    //     $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
    //     $pengajuanUjianProposalModel->insert($data);

    //     // $id_accjudul = $this->request->getPost('judul_acc_id');
    //     // $tracking = new MahasiswaBimbinganModel();
    //     // // dd($id_accjudul);
    //     // $tracking->update($id_accjudul, ['tracking' => 'Pengajuan Ujian Proposal']);

    //     $id_accjudul = $this->request->getPost('judul_acc_id');

    //     // Check if id_accjudul is not empty
    //     if (!empty($id_accjudul)) {
    //         // Verify record exists
    //         $judulAcc = $judulAccModel->where('id_accjudul', $id_accjudul)->get()->getRow();
    //         if ($judulAcc) {
    //             $judulAccModel->update(['id_accjudul' => $id_accjudul], ['tracking' => 'Pengajuan Ujian Proposal']);
    //         } else {
    //             // Handle case where record not found (optional: flash message)
    //             echo "Record with id_accjudul: $id_accjudul not found";
    //         }
    //     }
        
    //     return redirect()->to('pengajuanujianproposal');
    // }

    public function store()
    {
        $id_mhs = session()->get('user_id');

        // Ambil data post
        $data = $this->request->getPost();
        
        // Tambahkan id_mhs ke data
        $data['mahasiswa'] = $id_mhs;

        $judulAccModel = new JudulAccModel();
        $id_dospem = $judulAccModel->where('id_accjudul', $this->request->getPost('judul_acc_id'))->get()->getRow()->dospem_acc;
        $data['id_dospem'] = $id_dospem;

        // Mengelola file upload
        $file = $this->request->getFile('proposal_ta');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getName();
            $file->move('public/assets/proposal/', $newName);
            $data['proposal_ta'] = $newName;
        }

        // Insert ke database
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->insert($data);

        $id_accjudul = $this->request->getPost('judul_acc_id');

        if (!empty($id_accjudul)) {
            $judulAcc = $judulAccModel->where('id_accjudul', $id_accjudul)->get()->getRow();
            if ($judulAcc) {
                $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($id_accjudul, 'Pengajuan Ujian Proposal');
            } else {
                echo "Record with id_accjudul: $id_accjudul not found";
            }
        }
        
        return redirect()->to('pengajuanujianproposal');
    }

    public function edit($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $dataForm = $pengajuanUjianProposalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Edit Pengajuan Ujian Proposal';
        return view('pengajuanujianproposal/create', $operation);
    }
    
    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->update($id, $data);
        return redirect()->to('pengajuanujianproposal');
    }
    

    // public function updateStatus($id = null)
    // {
    //     $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
    //     $data = $this->request->getPost('status');
    //     // dd($data);
    //     $pengajuanUjianProposalModel->update($id, ['status_pengajuan' => $data]);
    //     // $model->update($id, ['status' => $status]);
    //     return redirect()->to('pengajuanujianproposal');
    // }

    public function updateStatus($id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
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
                $judul_acc_id = $pengajuan['judul_acc_id'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Revisi Ujian Proposal');
            }
        }

        return redirect()->to('pengajuanujianproposal');
    }

    
    public function uploadJadwal($proposalId)
    {
        $uploadedFile = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            // Pindahkan file yang diunggah ke folder yang diinginkan
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/jadwalujian/', $newFileName);

            // Simpan detail file ke dalam database
            $proposalModel = new PengajuanUjianProposalModel();
            $proposalModel->update($proposalId, ['jadwal' => $newFileName]);

            // Kirim respon ke client
            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function uploadRevisi($proposalId)
    {
        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {

            // $time = Carbon::now()->format('Y-m-d_H-i-s');
            // $newFileName = date('Y-m-d H:i:s') . '_Berkas Revisi.pdf';

            $newFileName = $uploadedFile->getName();
            // $newFileName = 'revisi_proposal_' . $proposalId . '.pdf';
            $uploadedFile->move('public/assets/revisi_ujian/', $newFileName);

            // Simpan detail file ke dalam database
            $proposalModel = new PengajuanUjianProposalModel();
            $proposalModel->update($proposalId, [
                'revisi_proposal' => $newFileName,
                'revisi_proposal_date' => date('Y-m-d H:i:s')
            ]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }


    public function unduhRevisi($id)
    {
        $fileModel = new PengajuanUjianProposalModel();
        $file = $fileModel->find($id);

        if ($file) {
            // Menambahkan path absolut
            $filePath = FCPATH . 'public/assets/revisi_ujian/' . $file['revisi_proposal'];
            $fileName = $file['revisi_proposal'];

            return $this->response->download($filePath, null)->setFileName($fileName);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }
    }



    public function delete($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->delete($id);
        return redirect()->to('pengajuanujianproposal');
    }
}

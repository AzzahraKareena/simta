<?php

namespace App\Controllers;

use TCPDF;
use App\Models\StafModels;
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

    public function store()
    {
        $id_mhs = session()->get('user_id');

        // Ambil data post
        $data = $this->request->getPost();
        
        // Tambahkan id_mhs ke data
        $data['mahasiswa'] = $id_mhs;

        $judulAccModel = new JudulAccModel();
        $judulAccId = $this->request->getPost('judul_acc_id');

        // Dapatkan id_dospem dari judul_acc_id
        $id_dospem = $judulAccModel->where('id_accjudul', $judulAccId)->get()->getRow()->dospem_acc;
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

        // Update nama judul di judul_acc jika ada perubahan
        $judulBaru = $this->request->getPost('judul_acc_title');
        if ($judulBaru) {
            $judulAccModel->update($judulAccId, ['judul_acc' => $judulBaru]);
        }

        // Update tracking
        if (!empty($judulAccId)) {
            $judulAcc = $judulAccModel->where('id_accjudul', $judulAccId)->get()->getRow();
            if ($judulAcc) {
                $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judulAccId, 'Pengajuan Ujian Proposal');
            } else {
                echo "Record with id_accjudul: $judulAccId not found";
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

    public function uploadRevisi($proposalId, $id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/revisi_ujian/', $newFileName);

            // Simpan detail file ke dalam database
            $pengajuanUjianProposalModel->update($proposalId, [
                'revisi_proposal' => $newFileName,
                'revisi_proposal_date' => date('Y-m-d H:i:s')
            ]);

            // Dapatkan data pengajuan berdasarkan ID
            $pengajuan = $pengajuanUjianProposalModel->find($proposalId);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['judul_acc_id'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Pengumpulan Revisi Ujian Proposal');
            }

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

    public function createJadwal($id)
    {
        $pengajuanUjianPropo = new PengajuanUjianProposalModel();
        $dataPengajuanUjian = $pengajuanUjianPropo->getMhs($id);
        $operation['title'] = 'Jadwal Ujian Proposal';
        $operation['sub_title'] = 'Buat Jadwal Ujian Proposal Baru';
        $operation['pengajuan'] = $dataPengajuanUjian;
        $operation['dosen'] = (new StafModels())->asArray()->findAll();

        return view('rilisjadwal/create', $operation);
    }
}

<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\JudulAccModel;
use App\Controllers\BaseController;
use App\Models\PengajuanSidangModel;
use App\Models\PengajuanBimbinganModel;
use App\Models\MahasiswaBimbinganModel;

class PengajuanSidangController extends BaseController
{
    public function table()
    {
        $this->setNotifications();
        
        $model = new PengajuanSidangModel();
        $bimbingan = new PengajuanBimbinganModel();
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getAllPengajuanWithJadwal($tahun);
        
        $getData = [];
        
        foreach ($data as $ujian) {
            if (session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah ') {
                $getData[] = $ujian; 
            } elseif (session()->get('role') == 'Dosen') {
                if ($ujian['id_dospem'] == session()->get('user_id')) {
                    $getData[] = $ujian; 
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($ujian['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $ujian; 
                }
            }
        }
    
        // Cek jumlah pengajuan bimbingan yang disetujui
        $mahasiswaId = session()->get('user_id');
        $jumlah_bimbingan = $bimbingan->where('id_mhs', $mahasiswaId)
        ->where('status_ajuan', 'DITERIMA')
        ->countAllResults();
        // $approvedCount = 0;
    
        // if (is_array($jumlah_bimbingan) && !empty($jumlah_bimbingan)) {
        //     foreach ($jumlah_bimbingan as $bimbinganItem) {
        //         if ($bimbinganItem['status_ajuan'] == 'DITERIMA') {
        //             $approvedCount++;
        //         }
        //     }
        // } else {
        //     // Handle the case where there are no approved guidance submissions
        //     $approvedCount = 0; // or any other logic you want to apply
        // }
        
    
        // Cek apakah mahasiswa sudah mengajukan
        $mahasiswaSudahMengajukan = false;
        foreach ($data as $item) {
            if ($item['id_mhs'] == $mahasiswaId && $item['status_pengajuan'] != 'DITOLAK') {
                $mahasiswaSudahMengajukan = true;
                break;
            }
        }
    
        // Tambahkan informasi ke operasi
        $operation['data'] = $getData;
        $operation['tahun'] = $tahun;
        $operation['mahasiswaSudahMengajukan'] = $mahasiswaSudahMengajukan;
        $operation['approvedCount'] = $jumlah_bimbingan; // Tambahkan jumlah pengajuan yang disetujui
        $operation['title'] = 'Pengajuan Sidang';
        $operation['sub_title'] = 'Daftar Pengajuan Sidang';
    
        // Cek apakah mahasiswa bisa mengajukan sidang
        // if (session()->get('role') == 'Mahasiswa' && $approvedCount < 9) {
        //     return redirect()->to('pengajuansidang')->with('error', 'Anda tidak dapat mengajukan sidang karena jumlah pengajuan bimbingan yang disetujui kurang dari 9 kali.');
        // }
    
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
        $insert = $pengajuanSidang->insert($data);
        if ($insert) {
            $judulAcc = $judulAccModel->where('id_accjudul', $id_accjudul)->get()->getRow();
            if ($judulAcc) {
                $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($id_accjudul, 'Pengajuan Sidang');
            } else {
                echo "Record with id_accjudul: $id_accjudul not found";
            }
        }
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

    public function updateStatus($id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanSidangModel();
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
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Revisi Sidang');
            }
        }

        return redirect()->to('pengajuansidang');
    }

    public function uploadRevisi($sidangId, $id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanSidangModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/revisi_sidang/', $newFileName);

            // Simpan detail file ke dalam database
            $pengajuanUjianProposalModel->update($sidangId, [
                'revisi_laporan' => $newFileName,
                'revisi_laporan_date' => date('Y-m-d H:i:s')
            ]);

            // Dapatkan data pengajuan berdasarkan ID
            $pengajuan = $pengajuanUjianProposalModel->find($sidangId);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['id_accjudul'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Pengumpulan Revisi Sidang Akhir');
            }

            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function unduhRevisi($id)
    {
        $fileModel = new PengajuanSidangModel();
        $file = $fileModel->find($id);

        if ($file) {
            // Menambahkan path absolut
            $filePath = FCPATH . 'public/assets/revisi_sidang/' . $file['revisi_laporan'];
            $fileName = $file['revisi_laporan'];

            return $this->response->download($filePath, null)->setFileName($fileName);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }
    }

    public function createJadwal($id)
    {
        $pengajuanSidang = new PengajuanSidangModel();
        $dataPengajuan = $pengajuanSidang->getMhs($id);
        $operation['title'] = 'Pengajuan Sidang TA';
        $operation['sub_title'] = 'Buat Pengajuan Sidang TA Baru';
        $operation['pengajuan'] = $dataPengajuan;
        $operation['dosen'] = (new UsersModel())->where('role', 'Dosen')->asArray()->findAll();
        // dd($operation['pengajuan']);
        return view('rilisjadwalsidang/create', ['pengajuan' => $operation['pengajuan'], 'dosen' => $operation['dosen']]);
    }
    
    public function updateStatusLaporan($id = null)
    {
        $pengajuanSidangModel = new PengajuanSidangModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        // Ambil status dari post data
        $status = $this->request->getPost('status');

        // Update status_pengajuan di tabel pengajuan_ujian_proposal
        $pengajuanSidangModel->update($id, ['status_laporan' => $status]);

        // Jika status adalah REVISI, update tracking di tabel simta_mahasiswa_bimbingan
        if ($status === 'REVISI') {
            // Dapatkan data judul_acc_id dari tabel pengajuan_ujian_proposal
            $pengajuan = $pengajuanSidangModel->find($id);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['judul_acc_id'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Revisi Sidang');
            }
        }

        return redirect()->to('rilisjadwalsidang');
    }
}
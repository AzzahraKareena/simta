<?php

namespace App\Controllers;

use App\Models\StafModel;
use App\Libraries\CustomPDF;
use App\Models\JudulAccModel;
use App\Controllers\BaseController;
use App\Models\MahasiswaBimbinganModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PengajuanSeminarHasilModel;

class PengajuanSeminarHasilController extends BaseController
{
    public function table()
    {
        $this->setNotifications();
        
        $model = new PengajuanSeminarHasilModel();
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getAllPengajuanWithJadwal($tahun);

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
        $operation['tahun'] = $tahun;
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
        $pengajuanSeminarHasilModel = new PengajuanSeminarHasilModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        // Ambil status dari post data
        $status = $this->request->getPost('status');

        // Update status_pengajuan di tabel pengajuan_ujian_proposal
        $pengajuanSeminarHasilModel->update($id, ['status_pengajuan' => $status]);

        // Jika status adalah REVISI, update tracking di tabel simta_mahasiswa_bimbingan
        if ($status === 'REVISI') {
            // Dapatkan data judul_acc_id dari tabel pengajuan_ujian_proposal
            $pengajuan = $pengajuanSeminarHasilModel->find($id);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['id_accjudul'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Revisi Seminar Hasil');
            }
        }

        return redirect()->to('pengajuanseminarhasil');
    }

    public function uploadRevisi($semhasId, $id = null)
    {
        $pengajuanSeminarHasilModel = new PengajuanSeminarHasilModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/revisi_semhas/', $newFileName);

            // Simpan detail file ke dalam database
            $pengajuanSeminarHasilModel->update($semhasId, [
                'revisi_laporan' => $newFileName,
                'revisi_laporan_date' => date('Y-m-d H:i:s')
            ]);

            // Dapatkan data pengajuan berdasarkan ID
            $pengajuan = $pengajuanSeminarHasilModel->find($semhasId);
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

    public function createJadwal($id)
    {
        $pengajuanSeminar = new PengajuanSeminarHasilModel();
        $dataPengajuan = $pengajuanSeminar->getMhs($id);

        // Ambil nama dosen penguji 1 dari id_dosen_penguji1
        $dosenModel = new StafModel();
        $dosenPenguji1 = $dosenModel->where('id_user', $dataPengajuan['id_penguji1'])->asArray()->first();

        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pengajuan'] = $dataPengajuan;
        $operation['dosen'] = (new StafModel())->where('jenis', 'Dosen')->asArray()->findAll();
        // $operation['nama_dosen_penguji1'] = $dosenPenguji1['nama']; // Nama dosen penguji 1
        $operation['id_penguji1'] = $dataPengajuan['id_penguji1']; // ID dosen penguji 1
        // dd($dataPengajuan);

        return view('rilisjadwalsemhas/create', [
            'pengajuan' => $operation['pengajuan'],
            'dosen' => $operation['dosen'],
            'nama_dosen_penguji1' => $dataPengajuan['nama_dosen'],
            'id_dosen_penguji1' => $dataPengajuan['id_dospem']
        ]);
    }

    public function rekomendasi($id)
    {
        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        $dataRekomendasi = (new PengajuanSeminarHasilModel())->getMhs($id);

        $data = [
            'imagePath' => $imagePath,
            'rekom' => $dataRekomendasi,
        ];

        $html = view('pengajuanseminarhasil/rekomendasi', $data);

        $pdf = new CustomPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('rekomendasi.pdf', 'I');
    }
    public function updateStatusLaporan($id = null)
    {
        $pengajuanSeminarHasilModel = new PengajuanSeminarHasilModel();
        $mahasiswaBimbinganModel = new MahasiswaBimbinganModel();

        // Ambil status dari post data
        $status = $this->request->getPost('status');

        // Update status_pengajuan di tabel pengajuan_ujian_proposal
        $pengajuanSeminarHasilModel->update($id, ['status_laporan' => $status]);

        // Jika status adalah REVISI, update tracking di tabel simta_mahasiswa_bimbingan
        if ($status === 'REVISI') {
            // Dapatkan data judul_acc_id dari tabel pengajuan_ujian_proposal
            $pengajuan = $pengajuanSeminarHasilModel->find($id);
            if ($pengajuan) {
                $judul_acc_id = $pengajuan['judul_acc_id'];
                $mahasiswaBimbinganModel->updateTrackingByJudulAccId($judul_acc_id, 'Revisi Seminar Hasil');
            }
        }

        return redirect()->to('rilisjadwalsemhas');
    }
    
}

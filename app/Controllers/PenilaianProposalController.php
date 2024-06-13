<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Models\IndikatorModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\PengajuanJudulModel;
use App\Models\PengajuanUjianProposalModel;
use App\Models\PenilaianProposalDetailModel;
use App\Models\PenilaianProposalModel;
use TCPDF;

class PenilaianProposalController extends BaseController
{

    public function penilaian($id = null)
    {
        helper('my_date_helper');

        $model = new PenilaianProposalDetailModel();
        $nilai = $model->getDetail($id);

        if (!$nilai) {
            // Handle case when no data is found, e.g., redirect or show an error
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $groupedData = [];
        foreach ($nilai as $indi) {
            $id_kriteria = $indi['id_kri'];
            if (!isset($groupedData[$id_kriteria])) {
                $groupedData[$id_kriteria] = [
                    'kri' => $indi['kri'],
                    'indi' => []
                ];
            }
            $groupedData[$id_kriteria]['indi'][] = $indi;
        }
        // Ambil tanggal saat ini
        $currentDate = date('d');
        $currentMonth = date('F'); // Nama bulan lengkap
        $currentYear = date('Y');
        $data = [
            'mhs' => [
                'peng_id_mhs' => $nilai[0]['peng_id_mhs'],  // Ensure this key exists in the $nilai array
                'mhs_nama' => $nilai[0]['mhs_nama'],
                'nim' => $nilai[0]['nim'],
                'prodi' => $nilai[0]['prodi'],
                'judul_judul_acc' => $nilai[0]['judul_judul_acc'],
                'nilai' => $groupedData,
                'date' => $currentDate,
                'month' => $currentMonth,
                'year' => $currentYear,
                'penguji' => $nilai[0]['staf_nama'],
                'nip_penguji' => $nilai[0]['stf_nip'],
            ],
        ];
        // dd($data);

        $html = view('penilaianproposal/penilaian-proposal', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Setel margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(false);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Tambahkan logo dan judul ke header
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 11, 'LEMBAR PENILAIAN PROPOSAL TUGAS AKHIR,', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->SetFont('times', '', 12);
        $pdf->Ln(0);  // Tambahkan jarak setelah header

        // Tulis konten HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        // Atur response untuk menampilkan PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('penilaian-proposal.pdf', 'I');
    }

    public function table()
    {
        $data = (new PenilaianProposalModel())->getKriteria();
        // dd($data);

        $id_mhs = null; // Nilai default jika tidak ada data
        if (!empty($data)) {
            foreach ($data as $key) {
                $id_mhs = $key['id_mhs'];
            }
        }

        if ($id_mhs !== null) {
            $mahasiswaNim = new MahasiswaModel();
            $mahasiswa = $mahasiswaNim->where('id_user', $id_mhs)->get()->getRow()->nim;
        } else {
            $mahasiswa = 'Data tidak ditemukan'; 
        }

        // Fetch data from bimbingan
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $nilai) {
            if (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($nilai['id_staf'] == session()->get('user_id')) {
                    $getData[] = $nilai; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Admin') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                    $getData[] = $nilai; // Tambahkan ke array
            }
        }

        $operation = [
            'data' => $getData,
            'title' => 'Penilaian Ujian Proposal',
            'sub_title' => 'Daftar Penilaian Ujian Proposal',
            'nim' => $mahasiswa,
        ];
        // dd($operation['nim']);
        return view("penilaianproposal/index", $operation);
        
    }

    public function create($id = null)
    {
        $mahasiswa = new  JadwalUjianPropoModel();
        $mhs = $mahasiswa->where('id_rilis_jadwal', $id)->getJadwal();
        $indikator = new IndikatorModel();
        $indik = $indikator->getKriteria();
        $groupedData = [];
        foreach ($indik as $indi) {
            $id_kriteria = $indi['id_kriteria'];
            if (!isset($groupedData[$id_kriteria])) {
                $groupedData[$id_kriteria] = [
                    'kriteria_nama_kriteria' => $indi['kriteria_nama_kriteria'],
                    'indikator' => []
                ];
            }
            $groupedData[$id_kriteria]['indikator'][] = $indi;
        }
        // dd($mhs);
        $data = [
            'indikator' => $groupedData,
            'mahasiswa' => $mhs
        ];
        // $mahasiswa = $mahasiswaNim->where('id_user', $id_mhs)->get()->getRow()->nim;
        return view('penilaianproposal/create', $data);
    }

    public function store()
    {
        // dd(session()->get('user_id'));
        $penilaian = new PenilaianProposalModel();
        $detail = new PenilaianProposalDetailModel();

        $indikator_ids = $this->request->getPost('indikator'); // Array of indikator IDs
        $nilai = $this->request->getPost('nilai');
        $rilis = $this->request->getPost('id_rilis_jadwal');

        $total = 0; // Inisialisasi total nilai

        foreach ($indikator_ids as $id_indikator) {
            $nilai_indikator = isset($nilai[$id_indikator]) ? $nilai[$id_indikator] : 0; // Jika nilai tidak ada, gunakan 0

            // Tambahkan nilai indikator ke total
            $total += $nilai_indikator;
        }

        $data = [
            'id_staf' => session()->get('user_id'),
            'id_mhs' => $this->request->getPost('id_mhs'),
            'nilai_total' => $total,
            'id_rilis_jadwal' => $rilis,
        ];
        // dd($data);
        $insert = $penilaian->insert($data);

        if ($insert) {
            // Insert detail penilaian
            foreach ($indikator_ids as $id_indikator) {
                $nilai_indikator = isset($nilai[$id_indikator]) ? $nilai[$id_indikator] : null;
    
                // Data untuk detail penilaian
                $detail_data = [
                    'id_penilaian_proposal' => $insert,
                    'id_indikator' => $id_indikator,
                    'nilai' => $nilai_indikator,
                ];
    
                // Insert detail penilaian ke dalam database
                $detail_insert = $detail->insert($detail_data);
    
                if (!$detail_insert) {
                    // Jika gagal memasukkan detail penilaian, maka batalkan penilaian utama
                    $penilaian->delete($insert);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan detail penilaian']);
                }
            }
    
            return redirect()->to('penilaianproposal');
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

    public function edit($id = null)
    {
        $model = (new PenilaianProposalDetailModel())->where('id_penilaian_proposal', $id)->getDetail();

        if (!$model) {
            // Handle case when no data is found, e.g., redirect or show an error
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $groupedData = [];
        foreach ($model as $indi) {
            $id_kriteria = $indi['id_kri'];
            if (!isset($groupedData[$id_kriteria])) {
                $groupedData[$id_kriteria] = [
                    'kri' => $indi['kri'],
                    'indi' => []
                ];
            }
            $groupedData[$id_kriteria]['indi'][] = $indi;
        }

        // Extract relevant data for the view
        $data = [
            'mhs' => [
                'peng_id_mhs' => $model[0]['peng_id_mhs'],  // Ensure this key exists in the $model array
                'mhs_nama' => $model[0]['mhs_nama'],
                'nim' => $model[0]['nim'],
                'prodi' => $model[0]['prodi'],
                'judul_judul_acc' => $model[0]['judul_judul_acc'],
                'nilai' => $groupedData,
            ],
        ];
        // dd($groupedData);

        return view('penilaianproposal/edit', $data);
    }

    public function update()
    {
        $penilaian = new PenilaianProposalModel();
        $detail = new PenilaianProposalDetailModel();
        
        $id_penilaian_detail = $this->request->getPost('id_penilaian_detail');
        $indikator_ids = $this->request->getPost('indikator'); // Array of indikator IDs
        $nilai = $this->request->getPost('nilai');
        $id_penilaian = $this->request->getPost('id_penilaian_proposal');
        // dd($id_penilaian);

        $total = 0; // Inisialisasi total nilai

        foreach ($indikator_ids as $id_indikator) {
            $nilai_indikator = isset($nilai[$id_indikator]) ? $nilai[$id_indikator] : 0; // Jika nilai tidak ada, gunakan 0

            // Tambahkan nilai indikator ke total
            $total += $nilai_indikator;
        }


        $data = [
            'nilai_total' => $total,
        ];
        $update = $penilaian->update($id_penilaian, $data);

        if ($update) {
            // Insert detail penilaian
            foreach ($id_penilaian_detail as $index => $id_detail) {
                $detailData = [
                    'nilai' => $nilai[$indikator_ids[$index]]
                ];
                $detail->update($id_detail, $detailData);
            }
    
            return redirect()->to('penilaianproposal');
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

    public function delete($id)
    {
        $penilaian = new PenilaianProposalModel();
        $penilaian->delete($id);
        return redirect()->to('penilaianproposal');
    }

}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Models\IndikatorSidangModel;
use App\Models\JadwalSidangModel;
use App\Models\PengajuanJudulModel;
use App\Models\PengajuanUjianProposalModel;
use App\Models\PenilaianSidangDetailModel;
use App\Models\PenilaianSidangModel;
use TCPDF;

class RekapNilaiController extends BaseController
{

    public function create($id = null)
    {
        // dd($id);
        $mahasiswa = new  JadwalSidangModel();
        $mhs = $mahasiswa->where('id_rilis_jadwal_sidang', $id)->getJadwal();
        $indikator = new IndikatorSidangModel();
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
        return view('penilaiansidang/create', $data);
    }

    public function store()
    {
        // dd( $this->request->getPost());
        // dd(session()->get('user_id'));
        $penilaian = new PenilaianSidangModel();
        $detail = new PenilaianSidangDetailModel();

        $indikator_ids = $this->request->getPost('indikator'); // Array of indikator IDs
        $nilai = $this->request->getPost('nilai');
        $rilis = $this->request->getPost('id_rilis_jadwal_sidang');

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
                    'id_penilaian_sidang' => $insert,
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
    
            return redirect()->to('penilaiansidang');
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

}

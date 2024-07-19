<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaBimbinganModel;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    // public function index()
    // {
    //     $operation['title'] = 'Home';
    //     $operation['sub_title'] = 'Sistem Informasi Manajemen Tugas Akhir';
    //     return view("dashboard/index", $operation);
    // }
    // public function dashboard()
    // {
    //     $operation['title'] = 'Dashboard';
    //     $operation['sub_title'] = 'Places for your business';
    //     return view("dashboard/index", $operation);
    // }

    public function index()
    {
        $model = new MahasiswaBimbinganModel();
        $dosenId = session()->get('user_id');
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getUserByDosen($dosenId, $tahun);
        
        // Debugging data
        error_log(print_r($data, true));

        if ($data) {
            foreach ($data as $item) {
                $dataString = '<b>' . htmlspecialchars($item['mahasiswa_nama']) . '</b>, ';
                $dataString .= 'sudah melakukan  <b>' . htmlspecialchars($item['tracking']) . '</b>';
                // Add other fields as needed
                session()->setFlashdata('alert_message_' . htmlspecialchars($item['mahasiswa_nama']), $dataString);
            }
        }

        $operation['title'] = 'Home';
        $operation['sub_title'] = 'Sistem Informasi Manajemen Tugas Akhir';

        return view("dashboard/index", $operation);
    }
}

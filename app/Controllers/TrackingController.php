<?php

namespace App\Controllers;

use App\Models\MahasiswaBimbinganModel;
use App\Controllers\BaseController;

class TrackingController extends BaseController
{
    public function table()
    {
        $this->setNotifications();
        
        $model = new MahasiswaBimbinganModel();
        $dosenId = session()->get('user_id');
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        
        // Pastikan nilai sesi sesuai dengan yang diharapkan
        $role = session()->get('role');
        $nama = session()->get('nama');
        
        error_log('Role: ' . $role);
        error_log('Nama: ' . $nama);
        
        // Ambil data sesuai dengan role dan nama
        if ($role == 'Dosen' || $nama == 'Masbahah') {
            $data = $model->getAllMahasiswaBimbingan();
        } else {
            $data = []; // Atau data yang relevan jika role atau nama tidak sesuai
        }

        // Debugging data
        error_log(print_r($data, true));

        $operation['data'] = $data;
        $operation['tahun'] = $tahun;
        $operation['title'] = 'Mahasiswa Bimbingan';
        $operation['sub_title'] = 'Daftar Mahasiswa Bimbingan Tugas Akhir';

        return view("tracking/index", $operation);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TimelineModel;
use CodeIgniter\HTTP\ResponseInterface;

class TimelineController extends BaseController
{
    public function table()
    {
        $timelineModel = new TimelineModel();
        $tahun = $this->request->getGet('tahun'); // Ambil data dari parameter GET

        if ($tahun) {
            $data = $timelineModel->where('tahun', $tahun)->asArray()->findAll();
        } else {
            $data = $timelineModel->asArray()->findAll();
        }

        $tahunList = $timelineModel->select('tahun')->distinct()->findAll();
        $tahunOptions = array_column($tahunList, 'tahun');

        $operation['data'] = $data;
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        $operation['tahun_options'] = $tahunOptions;
        $operation['selectedTahun'] = $tahun;
        
        return view("timeline/index", $operation);
    }
    
    public function create()
    {
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        return view('timeline/create', $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $timeline = new TimelineModel();
        $timeline->save($data);
        return redirect()->to('timeline');
    }

    public function edit($id)
    {
        $timeline = new TimelineModel();
        $dataForm = $timeline->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Timeline';
        $operation['sub_title'] = 'Setting timeline setiap periode Tugas Akhir';
        return view('timeline/create', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $timeline = new TimelineModel();
        $timeline->update($id, $data);
        return redirect()->to('timeline');
    }

    public function delete($id)
    {
        $timeline = new TimelineModel();
        $timeline->delete($id);
        return redirect()->to('timeline');
    }
}

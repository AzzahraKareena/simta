<?php


// namespace App\Controllers;

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";


// use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
// use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\RESTful\ResourceController;
use chriskacerguis\RestServer\RestController;

class ApiPengajuanJudul extends RestController
{

    protected $modelName = 'App\Models\PengajuanJudulModel';
    
    public function __construct()
    {
        $this->model = new PengajuanJudulModel();
    }
    public function table()
    {
        $data = (new PengajuanJudulModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'PengajuanJudul';
        // $operation['sub_title'] = '';
        return view("pengajuanjudul/index", $operation);
    }

    public function index()
    {
        $data = $this->model->findAll();
        // return $this->respond($data);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    
    public function create()
    {
        $data['title'] = 'Ajukan Judul';
        return view('pengajuanjudul/create', $data);
    }

    public function store()
    {
        // $data = $this->request->getPost();
        // $pengajuanJudulModel = new PengajuanJudulModel();
        // $pengajuanJudulModel->save($data);
        // return redirect()->to('pengajuanjudul');

        $data = [
            // 'id_pengajuanjudul' => $this->request->getVar('id_pengajuanjudul'),
            'id_mhs'  => $this->request->getVar('id_mhs'),
            'nama_judul1'  => $this->request->getVar('nama_judul1'),
            'deskripsi_sistem1'  => $this->request->getVar('deskripsi_sistem1'), 
        ];

        $insert = $this->model->insert($data);

        // if ($insert) {
        //     return $this->respondCreated($data, 'Resource deleted successfully.');
        // } else {
        //     return $this->failNotFound('Resource not found.');
        // }

        if ($insert) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // public function edit($id)
    // {
    //     $pengajuanjudul = new PengajuanJudulModel();
    //     $data['pengajuanJudul'] = $pengajuanjudul->find($id);
    //     $data['dataForm'] = $dataForm;
    //     $data['title'] = 'Edit Pengajuan Judul';
    //     return view('pengajuanjudul/create', $data);
    // }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $pengajuanjudul = new PengajuanJudulModel();
        $pengajuanjudul->update($id, $data);
        return redirect()->to('pengajuanjudul');
    }

    public function delete($id = null)
    {
        $pengajuanjudul = new PengajuanJudulModel();
        $pengajuanjudul->delete($id);
        return redirect()->to('pengajuanjudul');
    }
}

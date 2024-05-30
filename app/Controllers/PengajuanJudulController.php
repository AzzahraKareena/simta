<?php

namespace App\Controllers;

// use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\MahasiswaModel;
use App\Models\StafModels;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
// use chriskacerguis\RestServer\RestController;

class PengajuanJudulController extends ResourceController
{

    protected $modelName = 'App\Models\PengajuanJudulModel';
    protected $format    = 'json';
    
    public function __construct()
    {
        $this->model = new PengajuanJudulModel();
        // $staff = new StafModels();

        // $this->request->setHeader('Content-Type', 'application/json');
    }
    
    public function table()
    {

        $indikatorModel = new PengajuanJudulModel();
        $operation = $indikatorModel->getPengajuan();
        
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($operation as $bimbingan) {
            if (session()->get('role') == 'Mahasiswa') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($bimbingan['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                if ($bimbingan['id_rekom_dospem1'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }elseif ($bimbingan['id_rekom_dospem2'] == session()->get('user_id')) {
                    $getData[] = $bimbingan; // Tambahkan ke array
                }
            }
        }

         // Cek apakah mahasiswa yang login sudah memiliki data pengajuan
            $mahasiswaId = session()->get('user_id');
            // dd($mahasiswaId);
            $mahasiswaSudahMengajukan = false;
            foreach ($operation as $item) {
                if ($item['id_mhs'] == $mahasiswaId) {
                    $mahasiswaSudahMengajukan = true;
                    break;
                }
            }
        $operation['pengajuan'] = $getData;
        $operation['title'] = 'PengajuanJudul';
        $operation['mahasiswaSudahMengajukan'] = $mahasiswaSudahMengajukan;
        // Load the view with the prepared data
        return view("pengajuanjudul/index", $operation);
    }
    
    public function updateStatus($id)
    {
        // Get the new status from the form submission
        $newStatus = $this->request->getPost('status_pj');

        // Load the PengajuanJudulModel
        $pengajuanJudulModel = new PengajuanJudulModel();

        // Fetch the pengajuan judul data based on the provided ID
        $pengajuanJudul = $pengajuanJudulModel->find($id);

        if ($pengajuanJudul) {
            // Update the status_pj field with the new status
            $pengajuanJudulModel->update($id, ['status_pj' => $newStatus]);
        }

        // Redirect back to the page where the form was submitted
        return redirect()->back();
    }


    public function index()
    {
        // $data = $this->model->findAll();
        $data = (new PengajuanJudulModel())->asArray()->findAll();
        return $this->respond($data);
    }

    public function getStaf()
    {
        // $data = $staff->findAll();
        $data = (new StafModels())->asArray()->findAll();
        return $this->respond($data);
    }
    
    public function create()
    {
        // $data['title'] = 'Ajukan Judul';
        $data['rekomendasi_dosen'] = (new StafModels())->asArray()->findAll();
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
            'id_mhs'  => session()->get('user_id'),
            'nama_judul1'  => $this->request->getVar('nama_judul1'),
            'deskripsi_sistem1'  => $this->request->getVar('deskripsi_sistem1'), 
            'nama_judul2'  => $this->request->getVar('nama_judul2'), 
            'deskripsi_sistem2'  => $this->request->getVar('deskripsi_sistem2'), 
            'nama_judul3'  => $this->request->getVar('nama_judul3'), 
            'deskripsi_sistem3'  => $this->request->getVar('deskripsi_sistem3'), 
            'catatan'  => $this->request->getVar('catatan'), 
            'id_rekom_dospem1'  => $this->request->getVar('id_rekom_dospem1'), 
            'id_rekom_dospem2'  => $this->request->getVar('id_rekom_dospem2'), 
        ];
        // dd($data);
        $insert = $this->model->insert($data);
        
        if($insert){
            return redirect()->to('pengajuanjudul');
        } else {
            return $this->fail($this->model->errors());
        }

        // if ($insert) {
        //     return $this->respondCreated($data, 'Resource deleted successfully.');
        // } else {
        //     return $this->failNotFound('Resource not found.');
        // }

        // if ($insert) {
        //     $this->response([
        //         'status' => true,
        //         'data' => $data
        //     ], RestController::HTTP_CREATED);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data tidak ditemukan'
        //     ], RestController::HTTP_NOT_FOUND);
        // }
    }

    // public function edit($id)
    // {
    //     $pengajuanjudul = new PengajuanJudulModel();
    //     $data['pengajuanJudul'] = $pengajuanjudul->find($id);
    //     $data['dataForm'] = $dataForm;
    //     $data['title'] = 'Edit Pengajuan Judul';
    //     return view('pengajuanjudul/create', $data);
    // }

    public function editStatus($id)
    {
        $pengajuanjudul = new PengajuanJudulModel();
        $data = [
            'dataForm' => $pengajuanjudul->find($id),
            'rekomendasi_dosen' => (new StafModels())->asArray()->findAll()
        ];
        // $dataForm = $pengajuanjudul->find($id);
        return view('pengajuanjudul/acc-dosen', $data);
    }

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

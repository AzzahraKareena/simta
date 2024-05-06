<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BerkasTAModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class BerkasTAController extends BaseController
{
    use ResponseTrait;

    public function upload()
    {
        // Handle file upload
        $file = $this->request->getFile('file_berkas');

        if ($file->isValid() && $file->getExtension() === 'pdf') {
            $nama_berkas = $this->request->getPost('nama_berkas');

            $berkasModel = new BerkasTAModel();
            $berkasModel->insert([
                'nama_berkas' => $nama_berkas,
                'file_berkas' => $file->getName()
            ]);

            $file->move(WRITEPATH . 'uploads');
            // write path in public/asset
            // $file->move(ROOTPATH . 'public/assets/berkas');
            return $this->respondCreated(['message' => 'File uploaded successfully']);
        } else {
            return $this->failValidationError('Invalid file format or file not uploaded');
        }
    }

    public function download($id)
    {
        $berkasModel = new BerkasTAModel();
        $berkas = $berkasModel->find($id);

        if (!$berkas) {
            return $this->failNotFound('File not found');
        }

        $file = WRITEPATH . 'uploads/' . $berkas['file_berkas'];

        return $this->response->download($file, null);
    }

    public function table()
    {
        $data = (new BerkasTAModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Berkas TA ';
        $operation['sub_title'] = 'Berkas TA';
        return view("berkasTA/index", $operation);
    }
    public function index()
    {
        $berkasTAModel = new BerkasTAModel();
        $data['berkasTA'] = $berkasTAModel->findAll();
        return view('berkasTA/index', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Upload Berkas TA';
        return view('berkasTA/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $berkasTAModel = new BerkasTAModel();
        $berkasTAModel->save($data);
        return redirect()->to('berkasTA');
    }

    public function edit($id)
    {
        $berkasTAModel = new BerkasTAModel();
        $data['berkasTA'] = $berkasTAModel->find($id);
        $data['title'] = 'Edit Berkas TA';
        return view('berkasTA/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $berkasTAModel = new BerkasTAModel();
        $berkasTAModel->update($id, $data);
        return redirect()->to('berkasTA');
    }

    public function delete($id)
    {
        $berkasTAModel = new BerkasTAModel();
        $berkasTAModel->delete($id);
        return redirect()->to('berkasTA');
    }
}

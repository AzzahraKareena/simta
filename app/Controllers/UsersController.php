<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;

class UsersController extends ResourceController
{
    protected $modelName = 'App\Models\UsersModel';
    
    public function __construct()
    {
        $this->model = new UsersModel();
    }
    public function table()
    {
        // $usersModel = new UsersModel();
        $data = (new UsersModel())->asArray()->findAll();
        
        $operation['data'] = $data;
        $operation['title'] = 'Users';
        $operation['sub_title'] = 'Manage Users';
        return view("users/index", $operation);
    }

    // GET all users
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    // GET single user
    public function show($id = null)
    {
        $data = $this->model->getUserById($id);
        return $this->respond($data);
    }

    // POST create user
    public function store()
    {
        $model = new UsersModel();
        $data = [
            'email' => $this->request->getVar('email'),
            'username'  => $this->request->getVar('username'),
            'password_hash'  => password_hash ($this->request->getVar('password'), PASSWORD_BCRYPT)
            
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data users berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
      
    }
    public function create()
    {
        $operation['title'] = 'Users';
        $operation['sub_title'] = 'Add New User';
        return view('users/create', $operation);
    }
    // PUT update user
    public function update($id = null)
    {
        $rules = [
            'email' => 'required|valid_email',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]',
            'password_hash' => 'required',
            'role' => 'required',
            'group_id' => 'required|numeric' // Assuming 'group_id' is provided in request
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON();
        $this->model->updateUser($id, (array) $data);
        return $this->respond(['message' => 'User updated successfully']);
    }

    // DELETE user
    public function delete($id = null)
    {
        $users = new UsersModel();
        $users->delete($id);
        return redirect()->to('users');
    }
}

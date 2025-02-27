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

    public function edit($id = null)
{
    $user = $this->model->find($id);
    if (!$user) {
        return $this->failNotFound('User  not found');
    }

    $operation['user'] = $user;
    $operation['title'] = 'Edit User';
    $operation['sub_title'] = 'Update User Details';
    return view('users/create', $operation);
}
public function update($id = null)
{
    $rules = [
        'email' => 'required|valid_email',
        'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]',
        'password' => 'permit_empty|min_length[6]', // Allow empty password
    ];

    if (!$this->validate($rules)) {
        return $this->failValidationErrors($this->validator->getErrors());
    }

    $data = $this->request->getPost(); // Use getPost() to retrieve form data

    // Only hash the password if it's provided
    if (!empty($data['password'])) {
        $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
    } else {
        unset($data['password']); // Remove password if not provided
    }

    // Update the user using the built-in update method
    $this->model->update($id, $data);
    return redirect()->to('users');
}

    // DELETE user
    public function delete($id = null)
    {
        $users = new UsersModel();
        $users->delete($id);
        return redirect()->to('users');
    }
}

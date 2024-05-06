<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        $operation['title'] = 'Home';
        $operation['sub_title'] = 'Places for your business';
        return view("dashboard/index", $operation);
    }
    // public function dashboard()
    // {
    //     $operation['title'] = 'Dashboard';
    //     $operation['sub_title'] = 'Places for your business';
    //     return view("dashboard/index", $operation);
    // }

}

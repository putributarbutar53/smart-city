<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Dashboard extends BaseController
{
    var $model, $pemilih, $data, $cpdpt;
    function __construct()
    {
        $this->model = new AdminModel();
    }
    public function index()
    {
        echo view("admin/dashboard");
    }
    public function getdata()
    {
        $data = [];
        return view('admin/dashboard', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    var $category, $validation;
    function __construct()
    {
        $this->category = new KategoriModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function index()
    {
        $data['kategori'] = $this->category->getKategori(); // Mengambil semua kategori
        return view('web/index', $data);
    }
}

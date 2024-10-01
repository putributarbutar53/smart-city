<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\KuisionerModel;
use App\Models\SubDimensiModel;
use CodeIgniter\API\ResponseTrait;

class Hasil extends BaseController
{
    var $kategori, $model, $dimensi, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KuisionerModel();
        $this->kategori = new KategoriModel();
        $this->dimensi = new SubDimensiModel();
        $this->validation = \Config\Services::validation();
    }
    function index()
    {
        $data['kategori'] = $this->kategori->findAll();
        echo view('admin/hasil/index', $data);
    }
    public function detail($id_kategori)
    {
        $detail = $this->kategori->find($id_kategori);
        $data['detail'] = $detail;
        session()->set('id_kategori', $id_kategori);
        $data['sub_dimensi'] = $this->dimensi->where('id_kategori', $id_kategori)->findAll();
        $data['kuisioner'] = $this->model->where('id_kategori', $id_kategori)->findAll();
        echo view('admin/hasil/detail', $data);
    }
    public function detailkuisioner($id)
    {
        $kuisioner = $this->model->find($id);

        if (!$kuisioner) {
            return redirect()->to('/admin2053/hasil')->with('error', 'Kuisioner tidak ditemukan.');
        }

        $subDimensi = $this->dimensi->where('id_kategori', $kuisioner['id_kategori'])->findAll();

        $data = [
            'kuisioner' => $kuisioner,
            'sub_dimensi' => $subDimensi
        ];

        return view('admin/hasil/detail_kuisioner', $data);
    }
}

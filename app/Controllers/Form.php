<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\LayananModel;
use App\Models\SasaranModel;
use CodeIgniter\API\ResponseTrait;

class Form extends BaseController
{
    use ResponseTrait;
    var $category, $layanan, $sasaran, $validation;
    function __construct()
    {
        $this->category = new KategoriModel();
        $this->layanan = new LayananModel();
        $this->sasaran = new SasaranModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function index($id = null)
    {
        if ($id) {
            // Ambil kategori berdasarkan ID
            $data['kategori'] = $this->category->getKategoriById($id);

            // Jika kategori tidak ditemukan
            if (!$data['kategori']) {
                return redirect()->to('error_page');
            }

            // Ambil layanan berdasarkan id_kategori yang dipilih
            $data['layanan'] = $this->layanan->getLayananByKategoriId($id); // Gantilah model sesuai dengan yang Anda gunakan

            // Ambil sasaran berdasarkan id_kategori yang dipilih
            $data['sasaran'] = $this->sasaran->getSasaranByKategoriId($id); // Ambil dari model SasaranModel

        } else {
            // Ambil semua kategori jika tidak ada ID
            $data['kategori'] = $this->category->getAllKategori();
        }

        return view('web/form/index', $data);
    }
}

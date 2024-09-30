<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubDimensiModel;
use CodeIgniter\API\ResponseTrait;

class Category extends BaseController
{
    var $model, $subdimensi, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KategoriModel();
        $this->subdimensi = new SubDimensiModel();
        $this->validation = \Config\Services::validation();
    }
    function index()
    {
        echo view('admin/category/index');
    }
    // function bagian($id_kategori)
    // {
    //     $detail = $this->model->find($id_kategori);
    //     $data['detail'] = $detail;

    //     echo view('admin/dimensi/index', $data);
    // }
    public function bagian($id_kategori)
    {
        $detail = $this->model->find($id_kategori);
        $data['detail'] = $detail;

        // Mengambil data dari model SubDimensiModel berdasarkan id_kategori
        $data['sub_dimensi'] = $this->subdimensi->where('id_kategori', $id_kategori)->findAll();

        echo view('admin/dimensi/index', $data);
    }


    function loaddata()
    {

        $request = service('request');

        $draw = $request->getVar('draw');
        $row = $request->getVar('start');
        $rowperpage = $request->getVar('length');

        $columnIndex = $request->getVar('order')[0]['column'];
        $columnName = $request->getVar('columns')[$columnIndex]['data'];

        $columnSortOrder = $request->getVar('order')[0]['dir'];
        // $columnSortOrder = ($request->getVar('order')[0]['dir'] == 'asc') ? 'desc' : 'asc';
        $searchValue = $request->getVar('search')['value'];

        $db = db_connect();

        // Total Records without Filtering
        $totalRecords = $db->table('kategori')->countAll();

        // Total Records with Filtering
        $totalRecordsWithFilter = $db->table('kategori')
            ->where('id !=', '0')
            ->like('nama', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $db->table('kategori')
            ->select('*')
            ->where('id !=', '0')
            ->like('nama', $searchValue)
            ->orderBy($orderBy)
            ->limit($rowperpage, $row)
            ->get()
            ->getResult();


        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecordsWithFilter,
            'iTotalDisplayRecords' => $totalRecords,
            'aaData' => $data
        ];

        return $this->response->setJSON($response);
    }

    function add()
    {
        $data['title'] = "Tambah Category";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah Category";
        echo view('admin/category/form', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit Data Category";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['alert'] = "";
        $data['tombol'] = "Update Data";

        echo view('admin/category/form', $data);
    }
    function detail($id)
    {
        $detail = $this->model->find($id);
        $data['title'] = "Detail Data User";
        $data['detail'] = $detail;
        $data['action'] = "update";
        $data['tombol'] = "Update Data";

        echo view('admin/category/detail', $data);
    }
    function submitdata()
    {
        $action = $this->request->getVar('action');

        // Validasi input
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama harus diisi'
                ]
            ],
            'img' => [
                'rules' => 'max_size[img,2048]|ext_in[img,jpg,jpeg,png]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar, maksimal 2MB',
                    'ext_in' => 'Tipe file harus berupa gambar (jpg, jpeg, png)'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan kesalahan dalam bentuk JSON
            $errors = $this->validator->getErrors();
            return $this->respond(['errors' => $errors], 400);
        }

        // Ambil data dari request
        $requestData = $this->request->getPost();

        // Escape data untuk menghindari injection
        $requestData = esc($requestData);

        // Proses gambar
        $image = $this->request->getFile('img');
        if ($image && $image->isValid()) {
            // Generate nama acak untuk gambar
            $newName = $image->getRandomName();
            // Pindahkan file ke direktori yang ditentukan
            $image->move(ROOTPATH . 'public/' . getenv('dir.uploads.category'), $newName);
            // Simpan nama file ke dalam array data
            $requestData['img'] = esc($newName);
        }

        switch ($action) {
            case "add":
                // Simpan data baru
                $this->model->insert($requestData);

                // Kembalikan respon sukses
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan'
                ], 200);

            case "update":
                $detail = $this->model->find($this->request->getPost('id'));

                if (!$detail) {
                    return $this->respond([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan'
                    ], 404);
                }

                // Perbarui data yang ada
                $this->model->update($detail['id'], $requestData);

                // Kembalikan respon sukses
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui'
                ], 200);
        }
    }

    function delete($id)
    {
        $deleted = $this->model->delete($id);
        if ($deleted) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ], 200);
        } else {
            return $this->respond([
                'message' => 'Ops! Id tidak valid'
            ], 400);
        }
    }
}

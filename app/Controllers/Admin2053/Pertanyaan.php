<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubDimensiModel;
use App\Models\PertanyaanModel;
use CodeIgniter\API\ResponseTrait;

class Pertanyaan extends BaseController
{
    var $model, $subdimensi, $validation, $pertanyaan;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KategoriModel();
        $this->subdimensi = new SubDimensiModel();
        $this->pertanyaan = new PertanyaanModel();
        $this->validation = \Config\Services::validation();
    }
    function index($id)
    {
        $detail = $this->subdimensi->find($id);
        $data['detail'] = $detail;
        session()->set('id', $id);

        $data['pertanyaan'] = $this->pertanyaan->where('id_subdimensi', $id)->findAll();


        echo view('admin/pertanyaan/index', $data);
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
        session()->set('id_kategori', $id_kategori);

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

    function add($id)
    {
        $data['title'] = "Tambah Pertanyaan";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['id_subdimensi'] = $this->subdimensi->find($id);
        $data['tombol'] = "+ Tambah Pertanyaan";
        echo view('admin/pertanyaan/form', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit Data Category";
        $data['detail'] = $this->pertanyaan->find($id);
        $data['action'] = "update";
        $data['alert'] = "";
        $data['tombol'] = "Update Data";

        echo view('admin/pertanyaan/form', $data);
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
            'pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pertanyaan harus diisi'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan kesalahan dalam bentuk JSON
            $errors = $this->validator->getErrors();
            return $this->respond(['errors' => $errors], 400);
        }

        switch ($action) {
            case "add":
                $rulesadd = [
                    'pertanyaan' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'field pertanyaan harus diisi'
                        ]
                    ],
                ];
                if (!$this->validate($rulesadd)) {
                    $errorsadd = $this->validator->getErrors();
                    return $this->respond(['errors' => $errorsadd], 400);
                }
                $requestData = array(
                    'id_subdimensi' => $this->request->getVar('id_subdimensi'),
                    'pertanyaan' => $this->request->getVar('pertanyaan'),
                    'option_1' => $this->request->getVar('option_1'),
                    'option_2' => $this->request->getVar('option_2'),
                    'option_3' => $this->request->getVar('option_3'),
                    'option_4' => $this->request->getVar('option_4'),
                    'option_9' => $this->request->getVar('option_9'),
                );

                // Simpan data baru
                $this->pertanyaan->insert($requestData);

                // Kembalikan respon sukses
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan'
                ], 200);

            case "update":

                $requestData = array(
                    'id_subdimensi' => $this->request->getVar('id_subdimensi'),
                    'pertanyaan' => $this->request->getVar('pertanyaan'),
                    'option_1' => $this->request->getVar('option_1'),
                    'option_2' => $this->request->getVar('option_2'),
                    'option_3' => $this->request->getVar('option_3'),
                    'option_4' => $this->request->getVar('option_4'),
                    'option_9' => $this->request->getVar('option_9'),
                );

                $detail = $this->pertanyaan->find($this->request->getPost('id'));

                // Perbarui data yang ada
                $this->pertanyaan->update($detail['id'], $requestData);
                // Kembalikan respon sukses
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui'
                ], 200);
        }
    }

    function delete($id)
    {
        $deleted = $this->pertanyaan->delete($id);
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

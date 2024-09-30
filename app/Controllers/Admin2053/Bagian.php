<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubDimensiModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\LayananModel;
use App\Models\SasaranModel;

class Bagian extends BaseController
{
    var $model, $kategori, $layanan, $validation, $sasaran;
    use ResponseTrait;
    function __construct()
    {
        $this->kategori = new KategoriModel();
        $this->model = new SubDimensiModel();
        $this->layanan = new LayananModel();
        $this->sasaran = new SasaranModel();
        $this->validation = \Config\Services::validation();
    }
    function loaddata()
    {
        $request = service('request');

        // Mendapatkan id_kategori dari request
        $id_kategori = $request->getVar('id_kategori'); // Sesuaikan ini sesuai dengan metode pengiriman

        $draw = $request->getVar('draw');
        $row = $request->getVar('start');
        $rowperpage = $request->getVar('length');

        $columnIndex = $request->getVar('order')[0]['column'];
        $columnName = $request->getVar('columns')[$columnIndex]['data'];

        $columnSortOrder = $request->getVar('order')[0]['dir'];
        $searchValue = $request->getVar('search')['value'];

        $db = db_connect();

        // Total Records without Filtering
        $totalRecords = $db->table('sub_dimensi')->where('id_kategori', $id_kategori)->countAll();

        // Total Records with Filtering
        $totalRecordsWithFilter = $db->table('sub_dimensi')
            ->where('id_kategori', $id_kategori)
            ->where('id !=', '0')
            ->like('sub_dimensi', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $db->table('sub_dimensi')
            ->select('*')
            ->where('id_kategori', $id_kategori) // Filter by id_kategori
            ->where('id !=', '0')
            ->like('sub_dimensi', $searchValue)
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


    public function add($id_kategori = null)
    {
        $data['title'] = "Tambah Category";
        $data['detail'] = $id_kategori ? $this->kategori->find($id_kategori) : []; // Mengambil detail kategori jika id_kategori ada
        $data['action'] = "add"; // Atur aksi yang sesuai (tambah/edit)
        $data['alert'] = ""; // Pesan alert, jika ada
        $data['tombol'] = "+ Tambah Category"; // Teks tombol
        echo view('admin/dimensi/form', $data); // Tampilkan view form
    }

    function edit($id)
    {
        $data['title'] = "Edit Data Category";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['alert'] = "";
        $data['tombol'] = "Update Data";

        echo view('admin/dimensi/form', $data);
    }
    function detail($id)
    {
        $detail = $this->model->find($id);
        $data['title'] = "Detail Data User";
        $data['detail'] = $detail;
        $data['action'] = "update";
        $data['tombol'] = "Update Data";

        echo view('admin/dimensi/detail', $data);
    }
    function submitdata()
    {
        $action = $this->request->getVar('action');
        $rules = [
            'sub_dimensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sub Dimensi harus diisi'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // If validation fails, return the validation errors as JSON
            $errors = $this->validator->getErrors();
            return $this->respond(['errors' => $errors], 400);
        }


        switch ($action) {
            case "add":
                $rulesAdd = [
                    'sub_dimensi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nama harus diisi'
                        ]
                    ],
                ];

                if (!$this->validate($rulesAdd)) {
                    // If validation fails, return the validation errors as JSON
                    $errorsAdd = $this->validator->getErrors();
                    return $this->respond(['errors' => $errorsAdd], 400);
                }

                // Get the data from the request, such as POST data
                $requestData = array(
                    'sub_dimensi' => $this->request->getVar('sub_dimensi'),
                );

                // Insert the data into the database using the model
                $this->model->insert($requestData);

                // Return a JSON response
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                ], 200);

            case "update":
                // Get the data from the request, such as POST data
                $requestData = [
                    'sub_dimensi' => $this->request->getVar('sub_dimensi'),
                ];

                $detail = $this->model->find($this->request->getVar('id'));

                $rules = [
                    'sub_dimensi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nama harus diisi'
                        ]
                    ],
                ];

                if ($detail['sub_dimensi'] != $requestData['sub_dimensi']) {
                    $rules['sub_dimensi']['rules'] .= '|is_unique[sub_dimensi.sub_dimensi]';
                }

                if (!$this->validate($rules)) {
                    // If validation fails, return the validation errors as JSON
                    $errorsUpdate = $this->validator->getErrors();
                    return $this->respond(['errors' => $errorsUpdate], 400);
                }

                // Update the data in the database using the model
                $this->model->update($detail['id'], $requestData);

                // Return a JSON response
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
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

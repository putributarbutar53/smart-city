<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\LayananModel;

class Layanan extends BaseController
{
    var $model, $layanan, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KategoriModel();
        $this->layanan = new LayananModel();
        $this->validation = \Config\Services::validation();
    }
    function index()
    {
        $data = [
            'kategori' => $this->model->findAll()
        ];
        echo view('admin/layanan/index', $data);
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
        $searchValue = $request->getVar('search')['value'];

        $db = db_connect();

        // Total Records without Filtering
        $totalRecords = $db->table('layanan')->countAll();

        // Total Records with Filtering
        $totalRecordsWithFilter = $db->table('layanan')
            ->join('kategori', 'layanan.id_kategori = kategori.id')
            ->like('layanan.n_layanan', $searchValue)
            ->orLike('kategori.nama', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'layanan.id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $db->table('layanan')
            ->select('layanan.*, kategori.nama as kategori_nama')
            ->join('kategori', 'layanan.id_kategori = kategori.id')
            ->like('layanan.n_layanan', $searchValue)
            ->orLike('kategori.nama', $searchValue)
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
        $data['title'] = "Tambah Layanan";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['kategori'] = $this->model->findAll();
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah Layanan";
        echo view('admin/layanan/form', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit Data Category";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['kategori'] = $this->model->findAll();
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
        $rules = [
            'n_layanan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
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
                    'n_layanan' => [
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
                    'id_kategori' => $this->request->getVar('id_kategori'),
                    'n_layanan' => $this->request->getVar('n_layanan'),
                );

                // Insert the data into the database using the model
                $this->layanan->insert($requestData);

                // Return a JSON response
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                ], 200);

            case "update":
                // Get the data from the request, such as POST data
                $requestData = [
                    'id_kategori' => $this->request->getVar('id_kategori'),
                    'n_layanan' => $this->request->getVar('n_layanan'),
                ];

                $detail = $this->layanan->find($this->request->getVar('id'));

                $rules = [
                    'n_layanan' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nama harus diisi'
                        ]
                    ],
                ];

                if ($detail['name'] != $requestData['name']) {
                    $rules['name']['rules'] .= '|is_unique[kategori.name]';
                }

                if (!$this->validate($rules)) {
                    // If validation fails, return the validation errors as JSON
                    $errorsUpdate = $this->validator->getErrors();
                    return $this->respond(['errors' => $errorsUpdate], 400);
                }

                // Update the data in the database using the model
                $this->layanan->update($detail['id'], $requestData);

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

<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\LayananModel;
use App\Models\SasaranModel;

class Sasaran extends BaseController
{
    var $model,$layanan,$validation,$sasaran;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KategoriModel();
        $this->layanan = new LayananModel();
        $this->sasaran = new SasaranModel();
        $this->validation = \Config\Services::validation();
    }
    function index()
    {
        echo view('admin/sasaran/index');
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
        $totalRecords = $db->table('sasaran')->countAll();

        // Total Records with Filtering
        $totalRecordsWithFilter = $db->table('sasaran')
            ->where('id !=', '0')
            ->like('n_sasaran', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $db->table('sasaran')
            ->select('*')
            ->where('id !=', '0')
            ->like('n_sasaran', $searchValue)
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
        $rules = [
            'name' => [
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
                    'name' => [
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
                    'name' => $this->request->getVar('name'),
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
                    'name' => $this->request->getVar('name'),
                ];

                $detail = $this->model->find($this->request->getVar('id'));

                $rules = [
                    'name' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nama harus diisi'
                        ]
                    ],
                ];

                if ($detail['name'] != $requestData['name']) {
                    $rules['name']['rules'] .= '|is_unique[sasaran.name]';
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

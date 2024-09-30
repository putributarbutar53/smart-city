<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubDimensiModel;
use CodeIgniter\API\ResponseTrait;

class Question extends BaseController
{
    var $kategori, $dimensi, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->kategori = new KategoriModel();
        $this->dimensi = new SubDimensiModel();
        $this->validation = \Config\Services::validation();
    }
    function index()
    {
        $data['kategori'] = $this->kategori->findAll();
        echo view('admin/tanya/index', $data);
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

        // Total Records without Filtering
        $totalRecords = $this->kategori->countAll();
        $totalRecordsWithFilter = $this->kategori
            ->where('id !=', '0')
            ->like('question', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $this->kategori
            ->select('*')
            ->where('id !=', '0')
            ->like('question', $searchValue)
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
        $data['title'] = "Tambah SKPD";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah SKPD";
        echo view('admin/tanya/form', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit SKPD";
        $data['detail'] = $this->kategori->find($id);
        $data['action'] = "update";
        $data['tombol'] = "Update SKPD";

        echo view('admin/tanya/form', $data);
    }
    function submitdata()
    {

        $action = $this->request->getVar('action');
        switch ($action) {
            case "add":
                $requestData = $this->request->getPost();
                $this->kategori->insert($requestData);
                return $this->respond(['status' => 'success', 'message' => 'Data inserted successfully'], 200);


            case "update":
                $requestData = $this->request->getPost();
                unset($requestData['id']);
                $detail = $this->kategori->find($this->request->getVar('id'));

                $this->kategori->update($detail['id'], $requestData);
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                ], 200);
        }
    }
    function delete($id)
    {
        $deleted = $this->kategori->delete($id);
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

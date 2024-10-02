<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\KuisionerModel;
use App\Models\SubDimensiModel;
use App\Models\PertanyaanModel;
use App\Models\JawabanModel;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Hasil extends BaseController
{
    var $kategori, $model, $tanya, $jawaban, $dimensi, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KuisionerModel();
        $this->tanya = new PertanyaanModel();
        $this->kategori = new KategoriModel();
        $this->dimensi = new SubDimensiModel();
        $this->jawaban = new JawabanModel();
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

        foreach ($subDimensi as &$dimensi) {
            $dimensi['pertanyaan'] = $this->tanya->where('id_subdimensi', $dimensi['id'])->findAll();

            foreach ($dimensi['pertanyaan'] as &$pertanyaan) {
                $jawaban = $this->jawaban->where([
                    'kuisioner_id' => $kuisioner['id'],
                    'pertanyaan_id' => $pertanyaan['id']
                ])->first();

                $pertanyaan['jawaban'] = $jawaban ? $jawaban['jawaban'] : null;
            }
        }

        $data = [
            'kuisioner' => $kuisioner,
            'sub_dimensi' => $subDimensi
        ];

        return view('admin/hasil/detail_kuisioner', $data);
    }
    public function exportToExcel()
    {
        $data = $this->model->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Kolom 1');
        $sheet->setCellValue('B1', 'Kolom 2');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['nama']);
            $sheet->setCellValue('B' . $row, $item['email']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}

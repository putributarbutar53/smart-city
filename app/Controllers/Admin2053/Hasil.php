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
    public function exportExcel()
    {
        $kuisionerModel = new KuisionerModel();
        $data = $kuisionerModel->findAll();

        // Buat instance spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID Kategori');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Umur');
        $sheet->setCellValue('F1', 'Pekerjaan');
        $sheet->setCellValue('G1', 'Nama Layanan');
        $sheet->setCellValue('H1', 'Sasaran Layanan');

        // Inisialisasi baris data
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_kategori']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['email']);
            $sheet->setCellValue('D' . $row, $item['jenis_kelamin']);
            $sheet->setCellValue('E' . $row, $item['umur']);
            $sheet->setCellValue('F' . $row, $item['pekerjaan']);
            $sheet->setCellValue('G' . $row, $item['nama_layanan']);
            $sheet->setCellValue('H' . $row, $item['sasaran_layanan']);

            // Tambahkan pertanyaan dan pilihan yang dipilih user
            $sheet->setCellValue('I' . $row, $item['pertanyaan']);
            $sheet->setCellValue('J' . $row, $item['option']);

            $row++;
        }

        // Buat file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'kuisioner_export.xlsx';

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
    public function diagram($id)
    {
        $data['detail'] = $this->kategori->find($id);

        if (!$data['detail']) {
            return redirect()->to('/some/error/page')->with('error', 'Data tidak ditemukan.');
        }

        $data['sub_dimensi'] = $this->dimensi->where('id_kategori', $id)->findAll();
        $data['kuisioner'] = $this->model->where('id_kategori', $id)->findAll();
        $data['pertanyaan'] = $this->tanya->findAll();
        $data['sub_dimensi'] = $this->dimensi->getSubDimensiByKategoriId($id);
        foreach ($data['sub_dimensi'] as $key => $dimensi) {
            $data['sub_dimensi'][$key]['pertanyaan'] = $this->tanya->getPertanyaanBySubDimensiId($dimensi['id']);

            foreach ($data['sub_dimensi'][$key]['pertanyaan'] as $index => $pertanyaan) {
                $jawaban = $this->jawaban->where('pertanyaan_id', $pertanyaan['id'])->findAll();
                $data['sub_dimensi'][$key]['pertanyaan'][$index]['jawaban'] = $jawaban;

                $jumlahJawaban = [];
                foreach ($jawaban as $j) {
                    $jawabanOption = $j['jawaban'];
                    if (isset($jumlahJawaban[$jawabanOption])) {
                        $jumlahJawaban[$jawabanOption]++;
                    } else {
                        $jumlahJawaban[$jawabanOption] = 1;
                    }
                }
                $data['sub_dimensi'][$key]['pertanyaan'][$index]['jumlah_jawaban'] = $jumlahJawaban;
            }
        }

        $data['jumlah_kelamin'] = [
            'P' => 0,
            'L' => 0
        ];

        foreach ($data['kuisioner'] as $k) {
            if ($k['jenis_kelamin'] === 'P') {
                $data['jumlah_kelamin']['P']++;
            } elseif ($k['jenis_kelamin'] === 'L') {
                $data['jumlah_kelamin']['L']++;
            }
        }

        $data['jumlah_umur'] = [];

        foreach ($data['kuisioner'] as $k) {
            $umur = $k['umur'];
            if (isset($data['jumlah_umur'][$umur])) {
                $data['jumlah_umur'][$umur]++;
            } else {
                $data['jumlah_umur'][$umur] = 1;
            }
        }

        $data['jumlah_pekerjaan'] = [];

        foreach ($data['kuisioner'] as $k) {
            $pekerjaan = $k['pekerjaan'];
            if (isset($data['jumlah_pekerjaan'][$pekerjaan])) {
                $data['jumlah_pekerjaan'][$pekerjaan]++;
            } else {
                $data['jumlah_pekerjaan'][$pekerjaan] = 1;
            }
        }

        $data['jumlah_layanan'] = [];

        foreach ($data['kuisioner'] as $k) {
            $layananList = explode(',', $k['nama_layanan']);
            foreach ($layananList as $layanan) {
                $layanan = trim($layanan);
                if (isset($data['jumlah_layanan'][$layanan])) {
                    $data['jumlah_layanan'][$layanan]++;
                } else {
                    $data['jumlah_layanan'][$layanan] = 1;
                }
            }
        }
        $data['jumlah_sasaran'] = [];

        foreach ($data['kuisioner'] as $k) {
            $sasaranList = explode(',', $k['sasaran_layanan']);
            foreach ($sasaranList as $sasaran) {
                $sasaran = trim($sasaran);
                if (isset($data['jumlah_sasaran'][$sasaran])) {
                    $data['jumlah_sasaran'][$sasaran]++;
                } else {
                    $data['jumlah_sasaran'][$sasaran] = 1;
                }
            }
        }

        echo view('admin/hasil/diagram', $data);
    }
}

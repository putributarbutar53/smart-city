<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\LayananModel;
use App\Models\SasaranModel;
use App\Models\SubDimensiModel;
use App\Models\PertanyaanModel;
use App\Models\KuisionerModel;
use App\Models\JawabanModel;
use CodeIgniter\API\ResponseTrait;


class Form extends BaseController
{
    use ResponseTrait;
    var $model, $jawaban, $category, $dimensi, $pertanyaan, $layanan, $sasaran, $validation;
    function __construct()
    {
        $this->model = new KuisionerModel();
        $this->jawaban = new JawabanModel();
        $this->category = new KategoriModel();
        $this->layanan = new LayananModel();
        $this->sasaran = new SasaranModel();
        $this->dimensi = new SubDimensiModel();
        $this->pertanyaan = new PertanyaanModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function index($id = null)
    {
        helper('RomanHelper');
        if ($id) {
            // Ambil kategori berdasarkan ID
            $data['kategori'] = $this->category->getKategoriById($id);

            // Jika kategori tidak ditemukan
            if (!$data['kategori']) {
                return redirect()->to('error_page');
            }

            // Ambil layanan berdasarkan id_kategori yang dipilih
            $data['layanan'] = $this->layanan->getLayananByKategoriId($id);

            // Ambil sasaran berdasarkan id_kategori yang dipilih
            $data['sasaran'] = $this->sasaran->getSasaranByKategoriId($id);

            // Ambil sub dimensi berdasarkan id_kategori yang dipilih
            $data['sub_dimensi'] = $this->dimensi->getSubDimensiByKategoriId($id);

            // Loop untuk setiap sub dimensi dan ambil pertanyaannya
            foreach ($data['sub_dimensi'] as $key => $dimensi) {
                $data['sub_dimensi'][$key]['pertanyaan'] = $this->pertanyaan->getPertanyaanBySubDimensiId($dimensi['id']);
            }
        } else {
            // Ambil semua kategori jika tidak ada ID
            $data['kategori'] = $this->category->getAllKategori();
        }

        return view('web/form/index', $data);
    }

    public function submit()
    {
        $kuisionerModel = new KuisionerModel();
        $jawabanModel = new JawabanModel();

        // Ambil data dari request
        $requestData = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nama_layanan' => implode(',', $this->request->getPost('nama_layanan')),
            'sasaran_layanan' => implode(',', $this->request->getPost('sasaran_layanan')),
        ];

        // Mengupload file selfie
        $selfieImage = $this->request->getFile('selfie_data');
        if ($selfieImage && $selfieImage->isValid()) {
            // Generate nama acak untuk gambar selfie
            $selfieName = $selfieImage->getRandomName();
            // Pindahkan file ke direktori yang ditentukan
            $selfieImage->move(ROOTPATH . 'public/' . getenv('dir.uploads.selfie'), $selfieName);
            // Simpan nama file selfie ke dalam array data
            $requestData['selfie_data'] = esc($selfieName);
        }

        // Mengupload file tanda tangan
        $signatureImage = $this->request->getFile('signature_data');
        if ($signatureImage && $signatureImage->isValid()) {
            // Generate nama acak untuk gambar tanda tangan
            $signatureName = $signatureImage->getRandomName();
            // Pindahkan file ke direktori yang ditentukan
            $signatureImage->move(ROOTPATH . 'public/' . getenv('dir.uploads.ttd'), $signatureName);
            // Simpan nama file tanda tangan ke dalam array data
            $requestData['signature_data'] = esc($signatureName);
        }

        // Simpan data kuisioner ke dalam database
        $kuisionerId = $kuisionerModel->insert($requestData); // Simpan dan ambil ID kuisioner

        // Simpan jawaban
        $pertanyaanIds = $this->request->getPost('pertanyaan_ids'); // Misalnya array dari ID pertanyaan
        $jawabanArray = $this->request->getPost('jawaban'); // Misalnya array dari jawaban

        foreach ($pertanyaanIds as $index => $pertanyaanId) {
            $jawabanModel->saveAnswer($kuisionerId, $pertanyaanId, $jawabanArray[$index], $this->request->getPost('id_subdimensi'));
        }

        return redirect()->to('/thank-you'); // Arahkan ke halaman terima kasih
    }
}

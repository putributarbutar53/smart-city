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
        if ($id) {
            $data['kategori'] = $this->category->getKategoriById($id);
            if (!$data['kategori']) {
                return redirect()->to('error_page');
            }
            $data['layanan'] = $this->layanan->getLayananByKategoriId($id);

            $data['sasaran'] = $this->sasaran->getSasaranByKategoriId($id);

            $data['sub_dimensi'] = $this->dimensi->getSubDimensiByKategoriId($id);

            foreach ($data['sub_dimensi'] as $key => $dimensi) {
                $data['sub_dimensi'][$key]['pertanyaan'] = $this->pertanyaan->getPertanyaanBySubDimensiId($dimensi['id']);
            }
        } else {
            $data['kategori'] = $this->category->getAllKategori();
        }

        return view('web/form/index', $data);
    }

    public function submit()
    {
        $kuisionerModel = new KuisionerModel();
        $jawabanModel = new JawabanModel();

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

        $selfieDataUrl = $this->request->getPost('selfie_data');
        if ($selfieDataUrl) {
            list($type, $data) = explode(';', $selfieDataUrl);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $selfieName = uniqid() . '.png';
            if (file_put_contents(ROOTPATH . 'public/' . getenv('dir.uploads.selfie') . '/' . $selfieName, $data)) {
                $requestData['selfie_data'] = esc($selfieName);
            } else {
                log_message('error', 'Selfie upload failed.');
            }
        }

        $signatureDataUrl = $this->request->getPost('signature_data');
        if ($signatureDataUrl) {
            list($type, $data) = explode(';', $signatureDataUrl);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $signatureName = uniqid() . '.png';
            if (file_put_contents(ROOTPATH . 'public/' . getenv('dir.uploads.ttd') . '/' . $signatureName, $data)) {
                $requestData['signature_data'] = esc($signatureName);
            } else {
                log_message('error', 'Signature upload failed.');
            }
        }

        try {
            $kuisionerId = $kuisionerModel->insert($requestData);
        } catch (\Exception $e) {
            log_message('error', 'Database insert failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kuisioner.');
        }

        $idSubdimensiArray = $this->request->getPost('id_subdimensi');

        $pertanyaanData = $this->pertanyaan->getPertanyaanData();
        $pertanyaanPerSubdimensi = [];

        foreach ($pertanyaanData as $pertanyaan) {
            $idSubdimensi = $pertanyaan['id_subdimensi'];
            $idPertanyaan = $pertanyaan['id'];

            if (!isset($pertanyaanPerSubdimensi[$idSubdimensi])) {
                $pertanyaanPerSubdimensi[$idSubdimensi] = [];
            }

            $pertanyaanPerSubdimensi[$idSubdimensi][] = $idPertanyaan;
        }

        if (!empty($idSubdimensiArray)) {
            foreach ($idSubdimensiArray as $idSubdimensi) {
                foreach ($this->request->getPost() as $key => $jawaban) {
                    if (strpos($key, 'pertanyaan_') === 0) {
                        $pertanyaanId = str_replace('pertanyaan_', '', $key);

                        if (!empty($jawaban)) {
                            if (in_array($pertanyaanId, $pertanyaanPerSubdimensi[$idSubdimensi])) {
                                $jawabanModel->saveAnswer($kuisionerId, $pertanyaanId, $jawaban, $idSubdimensi);
                            }
                        }
                    }
                }
            }
        }

        return redirect()->to('/thank-you');
    }
}

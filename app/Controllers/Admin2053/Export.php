<?php

namespace App\Controllers\Admin2053;

use App\Controllers\BaseController;
use App\Models\JawabanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\KuisionerModel;
use App\Models\PertanyaanModel;

class Export extends BaseController
{
    var $model, $question, $answer;
    function __construct()
    {
        $this->model = new KuisionerModel();
        $this->question = new PertanyaanModel();
        $this->answer = new JawabanModel();
    }

    public function exportExcel($id)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header kolom
        $sheet->setCellValue('A1', 'TimeStamp');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Umur');
        $sheet->setCellValue('F1', 'Pekerjaan');
        $sheet->setCellValue('G1', 'Nama Layanan');
        $sheet->setCellValue('H1', 'Sasaran Layanan');

        // Ambil semua pertanyaan dan jawaban berdasarkan kuisioner_id
        $jawabanData = $this->answer->getJawabanWithPertanyaan($id);
        var_dump($jawabanData); // Menampilkan hasil query
        exit;

        // Pastikan $jawabanData bukan null
        if (!$jawabanData) {
            return "Tidak ada data yang ditemukan untuk kuisioner ID: " . $id;
        }

        // Menambahkan pertanyaan ke header kolom (I1, J1, dst.)
        $columnIndex = 'I'; // Mulai dari kolom I
        foreach ($jawabanData as $data) {
            $sheet->setCellValue($columnIndex . '1', $data['pertanyaan']); // Ubah 'teks_pertanyaan' ke 'pertanyaan'
            $columnIndex++; // Pindah ke kolom berikutnya
        }

        // Menambahkan data jawaban ke baris berikutnya
        $row = 2; // Mulai dari baris kedua setelah header
        foreach ($jawabanData as $data) {
            $sheet->setCellValue('A' . $row, $data['created_at']);
            $sheet->setCellValue('B' . $row, $data['nama']);
            $sheet->setCellValue('C' . $row, $data['email']);
            $sheet->setCellValue('D' . $row, $data['jenis_kelamin']);
            $sheet->setCellValue('E' . $row, $data['umur']);
            $sheet->setCellValue('F' . $row, $data['pekerjaan']);
            $sheet->setCellValue('G' . $row, $data['nama_layanan']);
            $sheet->setCellValue('H' . $row, $data['sasaran_layanan']);

            // Menambahkan jawaban ke kolom yang sesuai
            $columnIndex = 'I';
            $sheet->setCellValue($columnIndex . $row, $data['jawaban']); // Isi kolom jawaban

            $row++; // Pindah ke baris berikutnya
        }

        // Menyimpan file sebagai Excel (.xlsx)
        $writer = new Xlsx($spreadsheet);
        $fileName = 'kuisioner_export.xlsx';

        // Set header untuk mendownload file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        header('Cache-Control: max-age=0');

        // Simpan dan kirim ke output
        $writer->save('php://output');
        exit;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KuisionerModel extends Model
{
    protected $table = 'kuisioner';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_kategori',
        'nama',
        'email',
        'jenis_kelamin',
        'umur',
        'pekerjaan',
        'nama_layanan',
        'sasaran_layanan',
        'selfie_data',
        'signature_data',
        'created_at'
    ];

    public function saveAnswer($kuisionerId, $pertanyaanId, $jawaban, $idSubdimensi)
    {
        $data = [
            'kuisioner_id' => $kuisionerId,
            'pertanyaan_id' => $pertanyaanId,
            'jawaban' => $jawaban,
            'id_subdimensi' => $idSubdimensi,
        ];
        return $this->insert($data); // Menyimpan ke database
    }
    public function getKuisionerByKategori($idKategori)
    {
        return $this->where('id_kategori', $idKategori)->findAll();
    }

    public function getKuisionerWithJawaban()
    {
        return $this->select('kuisioner.*, pertanyaan.id AS pertanyaan_id, pertanyaan.pertanyaan, jawaban.jawaban')
            ->join('jawaban', 'jawaban.  = kuisioner.id', 'left')
            ->join('pertanyaan', 'pertanyaan.id = jawaban.pertanyaan_id', 'left')
            ->findAll();
    }
}

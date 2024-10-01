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
}

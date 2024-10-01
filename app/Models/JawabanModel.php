<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kuisioner_id',
        'pertanyaan_id',
        'id_subdimensi',
        'jawaban',
    ];

    public function saveAnswer($kuisionerId, $pertanyaanId, $jawaban, $idSubdimensi = null)
    {
        // Buat array data untuk disimpan
        $data = [
            'kuisioner_id' => $kuisionerId,
            'pertanyaan_id' => $pertanyaanId,
            'jawaban' => $jawaban,
        ];

        // Tambahkan id_subdimensi jika ada
        if ($idSubdimensi !== null) {
            $data['id_subdimensi'] = $idSubdimensi;
        }

        // Menyimpan jawaban ke database
        return $this->insert($data); // Kembalikan ID dari jawaban yang disimpan
    }
}

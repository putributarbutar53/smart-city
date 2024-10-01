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
        'created_at',  // Menambahkan kolom created_at
        'updated_at',  // Menambahkan kolom updated_at
    ];

    protected $useTimestamps = true; // Mengaktifkan penggunaan timestamps

    public function saveAnswer(
        $kuisionerId,
        $pertanyaanId,
        $jawaban,
        $idSubdimensi
    ) {
        $data = [
            'kuisioner_id' => $kuisionerId,
            'pertanyaan_id' => $pertanyaanId,
            'jawaban' => $jawaban,
            'id_subdimensi' => $idSubdimensi,
        ];

        // Pastikan untuk memanggil insert() pada model ini
        return $this->insert($data);
    }
}

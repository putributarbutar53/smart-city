<?php

namespace App\Models;

use CodeIgniter\Model;

class PertanyaanModel extends Model
{
    protected $table = 'pertanyaan';  // Nama tabel di database
    protected $primaryKey = 'id';  // Primary key dari tabel

    // Fields yang diizinkan untuk diisi
    protected $allowedFields = [
        'id_subdimensi',
        'pertanyaan',
        'option_1',
        'option_2',
        'option_3',
        'option_4'
    ];

    // Menentukan tipe data yang dikembalikan
    protected $returnType = 'array';

    /**
     * Fungsi untuk mendapatkan semua pertanyaan berdasarkan id_subdimensi.
     *
     * @param int $id_subdimensi
     * @return array
     */
    public function getPertanyaanBySubDimensi($id_subdimensi)
    {
        return $this->where('id_subdimensi', $id_subdimensi)->findAll();
    }

    /**
     * Fungsi untuk mendapatkan pertanyaan berdasarkan ID.
     *
     * @param int $id
     * @return array
     */
    public function getPertanyaanById($id)
    {
        return $this->find($id);
    }
}

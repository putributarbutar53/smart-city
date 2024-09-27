<?php

namespace App\Models;

use CodeIgniter\Model;

class SasaranModel extends Model
{
    protected $table = 'sasaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kategori', 'n_sasaran'];

    // Untuk menambahkan validasi (jika diperlukan)
    protected $validationRules = [
        'id_kategori' => 'required|is_not_unique[kategori.id]',
        'n_sasaran'   => 'required|min_length[3]|max_length[255]',
    ];

    protected $validationMessages = [
        'id_kategori' => [
            'required' => 'ID Kategori harus diisi',
            'is_not_unique' => 'ID Kategori tidak valid',
        ],
        'n_sasaran' => [
            'required' => 'Nama sasaran harus diisi',
            'min_length' => 'Nama sasaran minimal 3 karakter',
            'max_length' => 'Nama sasaran maksimal 255 karakter',
        ],
    ];
    public function getSasaranByKategoriId($id_kategori)
    {
        return $this->where('id_kategori', $id_kategori)->findAll();
    }

    // Anda bisa menambahkan metode tambahan sesuai kebutuhan
}

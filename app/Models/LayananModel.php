<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = 'layanan';              // Nama tabel
    protected $primaryKey = 'id';               // Primary key tabel
    protected $allowedFields = ['id_kategori', 'n_layanan']; // Field yang bisa diisi

    // Untuk menambahkan validasi (jika diperlukan)
    protected $validationRules = [
        'id_kategori' => 'required|is_not_unique[kategori.id]',
        'n_layanan'   => 'required|min_length[3]|max_length[255]',
    ];

    protected $validationMessages = [
        'id_kategori' => [
            'required' => 'ID Kategori harus diisi',
            'is_not_unique' => 'ID Kategori tidak valid',
        ],
        'n_layanan' => [
            'required' => 'Nama layanan harus diisi',
            'min_length' => 'Nama layanan minimal 3 karakter',
            'max_length' => 'Nama layanan maksimal 255 karakter',
        ],
    ];

    // Anda bisa menambahkan metode tambahan sesuai kebutuhan
}

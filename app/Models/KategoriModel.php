<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['nama', 'desc', 'img']; // Field yang dapat diisi

    // Menambahkan validasi (opsional)
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[255]',
        'desc' => 'permit_empty|max_length[65535]',
        'img' => 'permit_empty|max_length[255]|is_unique[kategori.img]',
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama kategori harus diisi.',
            'min_length' => 'Nama kategori minimal 3 karakter.',
            'max_length' => 'Nama kategori maksimal 255 karakter.',
        ],
        'img' => [
            'is_unique' => 'Gambar sudah ada di kategori lain.',
        ],
    ];

    // Jika perlu menambahkan fungsi custom
    public function getKategori($id = false)
    {
        if ($id === false) {
            return $this->findAll(); // Mengembalikan semua kategori
        }

        return $this->find($id); // Mengembalikan kategori berdasarkan id
    }
    public function getAllKategori()
    {
        return $this->findAll(); // Mengambil semua kategori
    }

    public function getKategoriById($id)
    {
        return $this->find($id); // Mengambil kategori berdasarkan id
    }
}

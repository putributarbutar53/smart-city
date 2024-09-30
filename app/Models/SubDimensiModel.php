<?php

namespace App\Models;

use CodeIgniter\Model;

class SubDimensiModel extends Model
{
    protected $table = 'sub_dimensi'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['id_kategori', 'sub_dimensi']; // Kolom yang diizinkan untuk diisi

    // Nonaktifkan pengaturan timestamps
    protected $useTimestamps = false; // Set false agar tidak menggunakan timestamps

    /**
     * Method to get all sub-dimensi by kategori
     *
     * @param int $id_kategori
     * @return array
     */
    public function getSubDimensiByKategori($id_kategori)
    {
        return $this->where('id_kategori', $id_kategori)->findAll(); // Mengambil sub dimensi berdasarkan kategori
    }
    public function getSubDimensiByKategoriId($id_kategori)
    {
        return $this->where('id_kategori', $id_kategori)->findAll(); // Sesuaikan dengan nama kolom dan logika yang Anda gunakan
    }
}

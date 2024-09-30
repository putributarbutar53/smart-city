<?php

namespace App\Models;

use CodeIgniter\Model;

class SubDimensiModel extends Model
{
    protected $table = 'sub_dimensi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kategori', 'sub_dimensi'];

    // Optional: if you want to enable automatic handling of timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Method to get all sub-dimensi by kategori
     *
     * @param int $id_kategori
     * @return array
     */
    public function getSubDimensiByKategori($id_kategori)
    {
        return $this->where('id_kategori', $id_kategori)->findAll();
    }
}

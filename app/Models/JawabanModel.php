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

    public function getJawabanWithPertanyaan($kuisionerId)
    {
        log_message('info', 'Mencari jawaban untuk kuisioner_id: ' . $kuisionerId);
        
        $query = $this->db->table('jawaban')
            ->select('jawaban.*, pertanyaan.pertanyaan, kuisioner.nama, kuisioner.email, kuisioner.jenis_kelamin, kuisioner.umur, kuisioner.pekerjaan, kuisioner.nama_layanan, kuisioner.sasaran_layanan')
            ->join('pertanyaan', 'jawaban.pertanyaan_id = pertanyaan.id', 'left')
            ->join('kuisioner', 'jawaban.kuisioner_id = kuisioner.id', 'left')
            ->where('jawaban.kuisioner_id', $kuisionerId)
            ->get();
    
        $result = $query->getResultArray(); // Kembalikan hasil sebagai array
    
        // Debugging: tampilkan hasil query
        log_message('info', 'Hasil Query: ' . print_r($result, true));
    
        // Debug
        if (empty($result)) {
            log_message('error', 'Data tidak ditemukan untuk kuisioner_id: ' . $kuisionerId);
        }
    
        return $result;
    }
    

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

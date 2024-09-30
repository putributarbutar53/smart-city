<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOption9ToPertanyaan extends Migration
{
    public function up()
    {
        // Tambahkan kolom option_9 ke tabel pertanyaan
        $this->forge->addColumn('pertanyaan', [
            'option_9' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,  // Optional: Allow NULL values if needed
            ],
        ]);
    }

    public function down()
    {
        // Hapus kolom option_9 jika terjadi rollback
        $this->forge->dropColumn('pertanyaan', 'option_9');
    }
}

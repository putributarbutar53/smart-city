<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameSubdimensiTable extends Migration
{
    public function up()
    {
        // Ganti nama tabel subdimensi menjadi nama yang baru, misalnya dimensi
        $this->forge->renameTable('subdimensi', 'pertanyaan');
    }

    public function down()
    {
        // Kembalikan nama tabel ke subdimensi jika terjadi rollback
        $this->forge->renameTable('pertanyaan', 'subdimensi');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropPertanyaanTable extends Migration
{
    public function up()
    {
        // Hapus tabel pertanyaan
        $this->forge->dropTable('pertanyaan', true);
    }

    public function down()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_subdimensi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'pertanyaan' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_subdimensi', 'subdimensi', 'id_subdimensi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pertanyaan');
    }
}

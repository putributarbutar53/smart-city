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
        // Jika rollback, buat ulang tabel pertanyaan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'id_subdimensi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'pertanyaan' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'option_1' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option_2' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option_3' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option_4' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option_9' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pertanyaan');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pertanyaanlalap extends Migration
{
    public function up()
    {
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

        // Menambahkan primary key pada kolom id
        $this->forge->addPrimaryKey('id');

        // Buat ulang tabel pertanyaan
        $this->forge->createTable('pertanyaan');
    }

    public function down()
    {
        $this->forge->dropTable('pertanyaan');
    }
}

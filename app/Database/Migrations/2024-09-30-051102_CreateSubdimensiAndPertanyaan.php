<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubdimensiAndPertanyaan extends Migration
{
    public function up()
    {
        // Tabel subdimensi
        $this->forge->addField([
            'id_subdimensi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
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
        ]);
        $this->forge->addKey('id_subdimensi', true);
        $this->forge->createTable('subdimensi');

        // Tabel pertanyaan
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

    public function down()
    {
        // Hapus tabel jika di-down
        $this->forge->dropTable('pertanyaan');
        $this->forge->dropTable('subdimensi');
    }
}

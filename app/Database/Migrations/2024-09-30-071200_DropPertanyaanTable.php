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
        // Jika ingin mengembalikan tabel, definisikan struktur tabelnya kembali
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
        $this->forge->createTable('pertanyaan');
    }
}

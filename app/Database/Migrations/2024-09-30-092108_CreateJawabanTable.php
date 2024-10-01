<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJawabanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'kuisioner_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'pertanyaan_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_subdimensi' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jawaban' => [
                'type' => 'TEXT',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('jawaban');
    }

    public function down()
    {
        $this->forge->dropTable('jawaban');
    }
}

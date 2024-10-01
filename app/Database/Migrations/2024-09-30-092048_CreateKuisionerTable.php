<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKuisionerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['L', 'P'], // L untuk laki-laki, P untuk perempuan
            ],
            'umur' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_layanan' => [
                'type' => 'TEXT',
            ],
            'sasaran_layanan' => [
                'type' => 'TEXT',
            ],
            'selfie_data' => [
                'type' => 'TEXT',
            ],
            'signature_data' => [
                'type' => 'TEXT',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('kuisioner');
    }

    public function down()
    {
        $this->forge->dropTable('kuisioner');
    }
}

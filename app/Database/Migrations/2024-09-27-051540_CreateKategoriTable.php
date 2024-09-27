<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriTable extends Migration
{
    public function up()
    {
        // Membuat tabel kategori
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'desc' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'img' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        // Menambahkan primary key
        $this->forge->addPrimaryKey('id');
        // Membuat tabel
        $this->forge->createTable('kategori');
    }

    public function down()
    {
        // Menghapus tabel kategori
        $this->forge->dropTable('kategori');
    }
}

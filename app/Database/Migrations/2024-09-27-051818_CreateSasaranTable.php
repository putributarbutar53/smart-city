<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSasaranTable extends Migration
{
    public function up()
    {
        // Membuat tabel sasaran
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kategori' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'n_sasaran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        // Menambahkan primary key
        $this->forge->addPrimaryKey('id');
        // Menambahkan foreign key
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id', 'CASCADE', 'CASCADE');
        // Membuat tabel
        $this->forge->createTable('sasaran');
    }

    public function down()
    {
        // Menghapus tabel sasaran
        $this->forge->dropTable('sasaran');
    }
}

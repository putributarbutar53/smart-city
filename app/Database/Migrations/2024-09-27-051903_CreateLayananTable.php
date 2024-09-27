<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLayananTable extends Migration
{
    public function up()
    {
        // Membuat tabel layanan
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
            'n_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        // Menambahkan primary key
        $this->forge->addPrimaryKey('id');
        // Menambahkan foreign key
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id', 'CASCADE', 'CASCADE');
        // Membuat tabel
        $this->forge->createTable('layanan');
    }

    public function down()
    {
        // Menghapus tabel layanan
        $this->forge->dropTable('layanan');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubDimensiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_kategori' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'sub_dimensi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Set foreign key for id_kategori (assuming you have a categories table)
        $this->forge->addForeignKey('id_kategori', 'categories', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('sub_dimensi');
    }

    public function down()
    {
        // Drop the table when rolling back
        $this->forge->dropTable('sub_dimensi');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangayListTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'unit' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false
            ],
            'barangay' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('barangay_list');
    }

    public function down()
    {
        $this->forge->dropTable('barangay_list');
    }
}

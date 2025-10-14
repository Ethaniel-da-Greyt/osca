<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterlistTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'middle_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'suffix' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'sex' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => false,
            ],
            'barangay' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'unit' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'birthdate' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'age' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'osca_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'date_issued' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'date_applied' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'isDelete' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('masterlist');
    }

    public function down()
    {
        $this->forge->dropTable('masterlist');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DbMigrate extends Migration
{
    public function up()
    {
        /**
         * barangay_list table
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'unit' => [
                'type' => 'INT',
                'null' => false,
            ],
            'barangay' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('barangay');
        $this->forge->createTable('barangay_list', true);

        /**
         * masterlist table
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
            ],
            'barangay' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'unit' => [
                'type' => 'INT',
                'null' => false,
            ],
            'birthdate' => [
                'type' => 'DATE',
            ],
            'age' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'osca_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 300,
            ],
            'date_issued' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'date_applied' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'qrcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'isDelete' => [
                'type'    => 'TINYINT',
                'null'    => false,
                'default' => 0,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('masterlist', true);

        /**
         * users table
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default'    => 'user',
            ],
            'isDelete' => [
                'type'    => 'TINYINT',
                'default' => 0,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('masterlist', true);
        $this->forge->dropTable('barangay_list', true);
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'npm' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'instansi_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'status' => [
                'type'           => 'INT',
                'constraint'     => 5, // status 1 aktif, status 2 tidak aktif
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'level' => [
                'type'           => 'INT',
                'constraint'     => 5, // level 1 admin, level 2 users, level 0 pimpinan
            ],
            'ktm' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'image' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'periodeawal' => [
                'type'           => 'DATE',
            ],
            'periodeakhir' => [
                'type'           => 'DATE',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

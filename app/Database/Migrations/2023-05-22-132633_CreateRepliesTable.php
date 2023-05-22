<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRepliesTable extends Migration
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
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,

            ],
            'nama_surat' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'file_replies' => [
                'type'           => 'TEXT',
            ],
            'status' => [
                'type'           => 'INT',
                'constraint'     => 1, // status 0 => belum verifikasi, status 1 => verifikasi
            ],
            'type' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50, // type PKL, type KKN, type Penelitian
            ],
            'tgl_diunggah' => [
                'type'           => 'DATE',
            ],
            'tgl_diupdate' => [
                'type'           => 'DATE',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('replies');
    }

    public function down()
    {
        $this->forge->dropTable('replies');
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'  => 'Administrator',
                'email'  => 'admin@gmail.com',
                'telp'  => '082289030919',
                'instansi_name'  => 'Politeknik Negeri Lampung',
                'status'    => 1, // status 1 => active, status 0 => not active
                'password'  =>  password_hash(12345, PASSWORD_DEFAULT),
                'level'     => 1, // level 1 => admin, level 2, dst => users
                'ktm'     => 'profile1.jpg',
                'image'     => 'profile1.jpg',
            ],
            [
                'name'  => 'Adeset',
                'email'  => 'adsttt00@gmail.com',
                'telp'  => '082289030919',
                'instansi_name'  => 'Politeknik Negeri Lampung',
                'status'    => 1, // status 1 => active, status 0 => not active
                'password'  =>  password_hash(12345, PASSWORD_DEFAULT),
                'level'     => 2, // level 1 => admin, level 2, dst => users
                'ktm'     => 'profile2.jpg',
                'image'     => 'profile3.jpg',

            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}

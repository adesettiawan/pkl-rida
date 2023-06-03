<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['npm', 'name', 'email', 'telp', 'instansi_name', 'status', 'password', 'level', 'ktm', 'image'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_active_user()
    {
        $data = $this->db->table('users')
            ->where('status', '1')
            ->get()->getResultArray();

        return $data;
    }

    public function get_user_admin()
    {
        $data = $this->table('users')
            ->where('id', 1)
            ->get()->getRowArray();

        return $data;
    }

    public function get_user_byLogin()
    {
        $data = $this->table('users')
            ->where('id', session()->get('id'))
            ->get()->getRowArray();

        return $data;
    }
}

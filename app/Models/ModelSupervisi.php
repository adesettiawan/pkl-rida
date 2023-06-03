<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupervisi extends Model
{
    protected $table = 'supervisis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'tgl_supervisi', 'jam_supervisi', 'status', 'type', 'tgl_diunggah', 'tgl_diupdate'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';
    protected $createdField  = 'tgl_diunggah';
    protected $updatedField  = 'tgl_diupdate';
    protected $deletedField  = 'deleted_at';

    public function get_all_supervisi()
    {
        $data = $this->select('supervisis.*, users.name AS nama_ketua, users.instansi_name AS nama_instansi')->table('supervisis')
            ->join('users', 'users.id = supervisis.user_id')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byUser_supervisi()
    {
        $data = $this->select('supervisis.*, users.name AS nama_ketua, users.instansi_name AS nama_instansi')->table('supervisis')
            ->join('users', 'users.id = supervisis.user_id')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_supervisi($id)
    {
        $data = $this->select('supervisis.*, users.name AS nama_ketua,users.email AS email_ketua')->table('supervisis')
            ->join('users', 'users.id = supervisis.user_id')
            ->where('supervisis.id', $id)
            ->get()->getRowArray();

        return $data;
    }
}

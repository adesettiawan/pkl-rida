<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRequest extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama_peserta', 'nama_instansi', 'no_surat', 'nama_surat', 'asal_surat', 'file_surat', 'status', 'type', 'tgl_diterima', 'tgl_diunggah', 'tgl_diupdate'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';
    protected $createdField  = 'tgl_diunggah';
    protected $updatedField  = 'tgl_diupdate';
    protected $deletedField  = 'deleted_at';

    public function get_all_pkl()
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'PKL')
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_pkl($id)
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'PKL')
            ->where('requests.id', $id)
            ->get()->getRowArray();

        return $data;
    }
}

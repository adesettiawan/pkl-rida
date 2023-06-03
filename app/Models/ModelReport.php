<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelReport extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'filename', 'file_reports', 'status', 'type', 'tgl_diunggah', 'tgl_diupdate'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';
    protected $createdField  = 'tgl_diunggah';
    protected $updatedField  = 'tgl_diupdate';
    protected $deletedField  = 'deleted_at';

    public function get_all_pkl()
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            // ->join('requests', 'requests.user_id = reports.user_id')
            ->where('reports.type', 'PKL')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byUser_pkl()
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            // ->join('requests', 'requests.user_id = reports.user_id')
            ->where('reports.type', 'PKL')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_pkl($id)
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi, users.email AS email_ketua')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            ->where('type', 'PKL')
            ->where('reports.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_all_kkn()
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            ->where('type', 'KKN')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byUser_kkn()
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            // ->join('requests', 'requests.user_id = reports.user_id')
            ->where('reports.type', 'KKN')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_kkn($id)
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi, users.email AS email_ketua')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            ->where('type', 'KKN')
            ->where('reports.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_all_penelitian()
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            ->where('type', 'Penelitian')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byUser_penelitian()
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            // ->join('requests', 'requests.user_id = reports.user_id')
            ->where('reports.type', 'Penelitian')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_penelitian($id)
    {
        $data = $this->select('reports.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi, users.email AS email_ketua')->table('reports')
            ->join('users', 'users.id = reports.user_id')
            ->where('type', 'Penelitian')
            ->where('reports.id', $id)
            ->get()->getRowArray();

        return $data;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelReplies extends Model
{
    protected $table = 'replies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'no_surat', 'nama_surat', 'file_replies', 'status', 'type', 'tgl_diunggah', 'tgl_diupdate'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';
    protected $createdField  = 'tgl_diunggah';
    protected $updatedField  = 'tgl_diupdate';
    protected $deletedField  = 'deleted_at';

    public function get_all_pkl()
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            // ->join('requests', 'requests.user_id = replies.user_id')
            ->where('replies.type', 'PKL')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byStatus_pkl()
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            // ->join('requests', 'requests.user_id = replies.user_id')
            ->where('replies.type', 'PKL')
            ->where('replies.status', 1)
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_pkl($id)
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            ->where('type', 'PKL')
            ->where('replies.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_all_kkn()
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            ->where('type', 'KKN')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byStatus_kkn()
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            // ->join('requests', 'requests.user_id = replies.user_id')
            ->where('replies.type', 'KKN')
            ->where('replies.status', 1)
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_kkn($id)
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            ->where('type', 'KKN')
            ->where('replies.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_all_penelitian()
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            ->where('type', 'Penelitian')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byStatus_penelitian()
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            // ->join('requests', 'requests.user_id = replies.user_id')
            ->where('replies.type', 'Penelitian')
            ->where('replies.status', 1)
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_penelitian($id)
    {
        $data = $this->select('replies.*, users.name AS nama_ketua,users.instansi_name AS nama_instansi')->table('replies')
            ->join('users', 'users.id = replies.user_id')
            ->where('type', 'Penelitian')
            ->where('replies.id', $id)
            ->get()->getRowArray();

        return $data;
    }
}

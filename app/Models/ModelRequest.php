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

    public function get_byUser_pkl()
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'PKL')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_pkl($id)
    {
        $data = $this->select('requests.*, users.name AS nama_ketua,users.email AS email_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'PKL')
            ->where('requests.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_all_kkn()
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'KKN')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byUser_kkn()
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'KKN')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_kkn($id)
    {
        $data = $this->select('requests.*, users.name AS nama_ketua,users.email AS email_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'KKN')
            ->where('requests.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_all_penelitian()
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'Penelitian')
            ->get()->getResultArray();

        return $data;
    }

    public function get_byUser_penelitian()
    {
        $data = $this->select('requests.*, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'Penelitian')
            ->where('users.id', session()->get('id'))
            ->get()->getResultArray();

        return $data;
    }

    public function get_detail_penelitian($id)
    {
        $data = $this->select('requests.*, users.name AS nama_ketua,users.email AS email_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'Penelitian')
            ->where('requests.id', $id)
            ->get()->getRowArray();

        return $data;
    }

    public function get_chart_pkl_byInstitusi()
    {
        $data = $this->select('requests.*, COUNT(requests.id) AS jumlah, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'PKL')
            ->where('requests.status', '3')
            ->groupBy('requests.nama_instansi')
            ->get()->getResultArray();

        return $data;
    }

    public function get_chart_kkn_byInstitusi()
    {
        $data = $this->select('requests.*, COUNT(requests.id) AS jumlah, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'KKN')
            ->where('requests.status', '3')
            ->groupBy('requests.nama_instansi')
            ->get()->getResultArray();

        return $data;
    }

    public function get_chart_penelitian_byInstitusi()
    {
        $data = $this->select('requests.*, COUNT(requests.id) AS jumlah, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'Penelitian')
            ->where('requests.status', '3')
            ->groupBy('requests.nama_instansi')
            ->get()->getResultArray();

        return $data;
    }

    public function get_chart_pkl_byYear()
    {
        $data = $this->select('requests.*, COUNT(requests.id) AS jumlah, YEAR(requests.tgl_diterima) AS tahun, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'PKL')
            ->where('requests.status', '3')
            ->groupBy('YEAR(requests.tgl_diterima)')
            ->get()->getResultArray();

        return $data;
    }

    public function get_chart_kkn_byYear()
    {
        $data = $this->select('requests.*, COUNT(requests.id) AS jumlah, YEAR(requests.tgl_diterima) AS tahun, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'KKN')
            ->where('requests.status', '3')
            ->groupBy('YEAR(requests.tgl_diterima)')
            ->get()->getResultArray();

        return $data;
    }

    public function get_chart_penelitian_byYear()
    {
        $data = $this->select('requests.*, COUNT(requests.id) AS jumlah, YEAR(requests.tgl_diterima) AS tahun, users.name AS nama_ketua')->table('requests')
            ->join('users', 'users.id = requests.user_id')
            ->where('type', 'Penelitian')
            ->where('requests.status', '3')
            ->groupBy('YEAR(requests.tgl_diterima)')
            ->get()->getResultArray();

        return $data;
    }
}

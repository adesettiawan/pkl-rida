<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelRequest;

class Request extends BaseController
{
    protected $permohonan;

    public function __construct()
    {
        $this->permohonan = new ModelRequest();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Surat Permohonan - PKL Bidang RIDA',
            'data_permohonan' => $this->permohonan->get_all_pkl()
        ];
        return view('backend/request/pkl/index', $data);
    }
}

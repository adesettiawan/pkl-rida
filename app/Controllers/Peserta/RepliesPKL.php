<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelReplies;

class RepliesPKL extends BaseController
{
    protected $balasan, $user;

    public function __construct()
    {
        $this->balasan = new ModelReplies();
        $this->user = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Surat Balasan - PKL Bidang RIDA',
            'data_balasan' => $this->balasan->get_byStatus_pkl(),
        ];
        return view('peserta/replies/pkl/index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Surat Balasan - PKL Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'balasan' => $this->balasan->get_detail_pkl($id),
        ];
        return view('peserta/replies/pkl/show', $data);
    }
}

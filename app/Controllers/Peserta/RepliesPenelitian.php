<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelReplies;

class RepliesPenelitian extends BaseController
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
            'title' => 'Surat Balasan - Penelitian Bidang RIDA',
            'data_balasan' => $this->balasan->get_byUser_penelitian(),
        ];
        return view('peserta/replies/penelitian/index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Surat Balasan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'balasan' => $this->balasan->get_detail_penelitian($id),
        ];
        return view('peserta/replies/penelitian/show', $data);
    }
}

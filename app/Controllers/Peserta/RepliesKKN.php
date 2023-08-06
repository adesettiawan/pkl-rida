<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelReplies;

class RepliesKKN extends BaseController
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
            'title' => 'Surat Balasan - KKN Bidang RIDA',
            'data_balasan' => $this->balasan->get_byUser_kkn(),
        ];
        return view('peserta/replies/kkn/index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Surat Balasan - KKN Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'balasan' => $this->balasan->get_detail_kkn($id),
        ];
        return view('peserta/replies/kkn/show', $data);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Dashboard extends BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'PKL Bidang RIDA',
            'user' => $this->auth->get_user_byLogin(),
        ];

        return view('backend/dashboard/index', $data);
    }
}

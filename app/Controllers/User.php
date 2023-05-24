<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class User extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Data User - PKL Bidang RIDA',
            'data_user' => $this->user->findAll()
        ];
        return view('backend/user/index', $data);
    }
}

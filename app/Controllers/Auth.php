<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login - PKL Bidang RIDA',
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register - PKL Bidang RIDA',
        ];

        return view('auth/register', $data);
    }
}

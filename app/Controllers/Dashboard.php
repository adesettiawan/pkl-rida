<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'PKL Bidang RIDA',
        ];

        return view('backend/dashboard/index', $data);
    }
}

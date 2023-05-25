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

    public function add()
    {
        $data = [
            'title' => 'Data User - PKL Bidang RIDA',
        ];
        return view('backend/user/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} required',
                    'matches' => '{field} is not the same!'
                ]
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $this->model->insert([
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'image' => 'profile.jpg'
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_users');
    }
}

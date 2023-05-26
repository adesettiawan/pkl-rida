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
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'instansi_name' => [
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
            'status' => [
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

        $pw = $this->request->getPost('password');
        $this->user->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'telp' => $this->request->getPost('telp'),
            'instansi_name' => $this->request->getPost('instansi_name'),
            'level' => $this->request->getPost('level'),
            'status' => $this->request->getPost('status'),
            'npm' => $this->request->getPost('npm'),
            'ktm' => $this->request->getPost('ktm'),
            'password' => password_hash($pw, PASSWORD_DEFAULT),
            'image' => 'profile.jpg'
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_users');
    }
}

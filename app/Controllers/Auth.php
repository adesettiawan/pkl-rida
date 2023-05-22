<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
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
            'title' => 'Login - PKL Bidang RIDA',
        ];

        return view('auth/login', $data);
    }

    // processed login user
    public function login_processed()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi..!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi..!',
                ],
            ]
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $row = $this->auth->where('email', $email)->first();

            if ($row == NULL) {
                session()->setFlashdata('messages', 'Email not found, please contact your admin..!');
                return redirect()->to('/');
            }
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $data = [
                        'is_login' => TRUE,
                        'id' => $row['id'],
                        'npm' => $row['npm'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'telp' => $row['telp'],
                        'instansi_name' => $row['instansi_name'],
                        'status' => $row['status'],
                        'level' => $row['level'],
                        'ktm' => $row['ktm'],
                        'image' => $row['image'],
                    ];
                    session()->set($data);
                    session()->setFlashdata('message', 'Login successfully');
                    if (session()->get('level') == 1) {
                        return redirect()->to('admin');
                    } elseif (session()->get('level') == 2) {
                        return redirect()->to('user');
                    }
                } else {
                    session()->setFlashdata('messages', 'Login failed, wrong email or password, please check again..!');
                    return redirect()->to('/');
                }
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/'));
        }
    }

    public function logout()
    {
        $data = [
            'is_login',
            'id',
            'npm',
            'name',
            'email',
            'telp',
            'instansi_name',
            'status',
            'level',
            'ktm',
            'image',
        ];
        session()->setFlashdata('message', 'Logout successfully');
        session()->remove($data);
        session()->destroy();

        return redirect()->to('/');
    }

    public function register()
    {
        $data = [
            'title' => 'Register - PKL Bidang RIDA',
        ];

        return view('auth/register', $data);
    }
}

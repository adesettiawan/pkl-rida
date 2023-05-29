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
            'ktm' => $this->request->getPost('ktm') != '' ? $this->request->getPost('ktm') : '',
            'password' => password_hash($pw, PASSWORD_DEFAULT),
            'image' => 'profile.jpg'
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_users');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Data User - PKL Bidang RIDA',
            'user' => $this->user->find($id),
        ];
        return view('backend/user/edit', $data);
    }


    public function update($id)
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
            'ktm' => [
                'mime_in[ktm, ktm/png, ktm/jpg,ktm/jpeg, ktm/gif]',
                'max_size[ktm, 4096]',
            ],
            // 'image' => [
            //     'mime_in[image, image/png, image/jpg,image/jpeg, image/gif]',
            //     'max_size[image, 4096]',
            // ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $profile = $this->user->find($id);
        $old_profile = $profile['image'];
        $path = '../public/assets/img/';
        $old_ktm = $profile['ktm'];
        $pathktm = '../public/assets/ktm/';

        $image = $this->request->getFile('image');
        $ktm = $this->request->getFile('ktm');

        // image profile
        if ($image->isValid() && !$image->hasMoved()) {
            if (file_exists($path . $old_profile)) {
                @unlink($path . $old_profile);
            }
            $new_image = $image->getName();
            $image->move(ROOTPATH . 'public/assets/img');
        } else {
            $new_image = $old_profile;
        }

        // ktm profile
        if ($ktm->isValid() && !$ktm->hasMoved()) {
            if (file_exists($pathktm . $old_ktm)) {
                @unlink($pathktm . $old_ktm);
            }
            $new_ktm = $ktm->getName();
            $ktm->move(ROOTPATH . 'public/assets/ktm');
        } else {
            $new_ktm = $old_ktm;
        }

        $this->user->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'telp' => $this->request->getPost('telp'),
            'instansi_name' => $this->request->getPost('instansi_name'),
            'level' => $this->request->getPost('level'),
            'status' => $this->request->getPost('status'),
            'npm' => $this->request->getPost('npm'),
            'ktm' => $new_ktm,
            'image' => $new_image
        ]);

        session()->setFlashdata('message', 'Update data successfully!..');
        return redirect()->to('admin/data_users');
    }

    function delete($id)
    {
        $data_user = $this->user->find($id);
        if (empty($data_user)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User data not found!');
        }
        $this->user->delete($id);
        session()->setFlashdata('messages', 'Delete data sucessfully!..');
        return redirect()->to('admin/data_users');
    }

    public function changePassword($id)
    {
        $data = [
            'title' => 'Data User - PKL Bidang RIDA',
            'user' => $this->user->find($id),
        ];
        return view('backend/user/changePassword', $data);
    }

    public function changePasswordProcessed($id)
    {
        if (!$this->validate([
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

        $this->user->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),

        ]);

        session()->setFlashdata('message', 'Update data successfully!..');
        return redirect()->to('admin/data_users');
    }
}

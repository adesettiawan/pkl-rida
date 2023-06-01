<?php

namespace App\Controllers;

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
            'data_balasan' => $this->balasan->get_all_penelitian(),
        ];
        return view('backend/replies/penelitian/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Surat Balasan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('backend/replies/penelitian/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'user_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'no_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'nama_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'file_replies' => [
                'uploaded[file_replies]',
                // 'mime_in[file_replies, application/pdf]',
                'max_size[file_replies, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $file_replies = $this->request->getFile('file_replies');
        if ($file_replies != '') {
            $file_replies->move(ROOTPATH . 'public/assets/file_replies/penelitian');
        }

        $this->balasan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'status' => 1,
            'file_replies' => $file_replies->getName(),
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_balasan_penelitian');
    }

    public function verifikasiStatus($id)
    {
        $this->balasan->update($id, [
            'status' => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('message', 'Update status successfully!..');
        return redirect()->to('admin/data_balasan_penelitian');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Surat Balasan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'balasan' => $this->balasan->get_detail_penelitian($id),
        ];
        return view('backend/replies/penelitian/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'user_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'no_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'nama_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'file_replies' => [
                // 'uploaded[file_replies]',
                // 'mime_in[file_replies, application/pdf]',
                'max_size[file_replies, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $file_reply = $this->request->getFile('file_replies');
        $file_replies = $this->balasan->find($id);
        $old_file_replies = $file_replies['file_replies'];
        $path = '../public/assets/file_replies/penelitian/';


        // file_replies
        if ($file_reply->isValid() && !$file_reply->hasMoved()) {
            if (file_exists($path . $old_file_replies)) {
                @unlink($path . $old_file_replies);
            }
            $new_file_replies = $file_reply->getName();
            $file_reply->move(ROOTPATH . 'public/assets/file_replies/penelitian');
        } else {
            $new_file_replies = $old_file_replies;
        }

        $this->balasan->update($id, [
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'file_replies' => $new_file_replies,
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_balasan_penelitian');
    }

    public function delete($id)
    {
        $file_replies = $this->balasan->find($id);
        $this->balasan->delete($id);
        $f_replies = $file_replies['file_replies'];
        $path = '../public/assets/file_replies/penelitian/';
        @unlink($path . $f_replies);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/data_balasan_penelitian'));
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelRequest;

class Request extends BaseController
{
    protected $permohonan, $user;

    public function __construct()
    {
        $this->permohonan = new ModelRequest();
        $this->user = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Surat Permohonan - PKL Bidang RIDA',
            'data_permohonan' => $this->permohonan->get_all_pkl(),
        ];
        return view('backend/request/pkl/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Surat Permohonan - PKL Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('backend/request/pkl/add', $data);
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
            'nama_peserta' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'nama_instansi' => [
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
            'asal_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'file_surat' => [
                'uploaded[file_surat]',
                // 'mime_in[file_surat, application/pdf]',
                'max_size[file_surat, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $file_surat = $this->request->getFile('file_surat');
        if ($file_surat != '') {
            $file_surat->move(ROOTPATH . 'public/assets/file_surat');
        }

        $this->permohonan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'nama_peserta' => serialize($this->request->getPost('nama_peserta')),
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'asal_surat' => $this->request->getPost('asal_surat'),
            'status' => 2,
            'file_surat' => $file_surat->getName(),
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_permohonan_pkl');
    }

    public function verifikasiStatus($id)
    {
        $tgl_diterima = $this->request->getPost('tgl_diterima');

        $this->permohonan->update($id, [
            'status' => $this->request->getPost('status'),
            'tgl_diterima' => date('Y-m-d', strtotime($tgl_diterima)),
        ]);

        session()->setFlashdata('message', 'Update status successfully!..');
        return redirect()->to('admin/data_permohonan_pkl');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Surat Permohonan - PKL Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'permohonan' => $this->permohonan->get_detail_pkl($id),
        ];
        return view('backend/request/pkl/edit', $data);
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
            'nama_peserta' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'nama_instansi' => [
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
            'asal_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'file_surat' => [
                // 'uploaded[file_surat]',
                // 'mime_in[file_surat, application/pdf]',
                'max_size[file_surat, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $file_surats = $this->request->getFile('file_surat');
        $file_surat = $this->permohonan->find($id);
        $old_file_surat = $file_surat['file_surat'];
        $path = '../public/assets/file_surat/';


        // file_surat
        if ($file_surats->isValid() && !$file_surats->hasMoved()) {
            if (file_exists($path . $old_file_surat)) {
                @unlink($path . $old_file_surat);
            }
            $new_file_surat = $file_surats->getName();
            $file_surats->move(ROOTPATH . 'public/assets/file_surat');
        } else {
            $new_file_surat = $old_file_surat;
        }

        $this->permohonan->update($id, [
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'nama_peserta' => serialize($this->request->getPost('nama_peserta')),
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'asal_surat' => $this->request->getPost('asal_surat'),
            'file_surat' => $new_file_surat,
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/data_permohonan_pkl');
    }

    public function delete($id)
    {
        $file_surat = $this->permohonan->find($id);
        $this->permohonan->delete($id);
        $f_surat = $file_surat['file_surat'];
        $path = '../public/assets/file_surat/';
        @unlink($path . $f_surat);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/data_permohonan_pkl'));
    }
}

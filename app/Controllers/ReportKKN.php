<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelReport;

class ReportKKN extends BaseController
{
    protected $laporan, $user;

    public function __construct()
    {
        $this->laporan = new ModelReport();
        $this->user = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan - KKN Bidang RIDA',
            'laporan' => $this->laporan->get_all_kkn(),
        ];
        return view('backend/report/kkn/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Laporan - KKN Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('backend/report/kkn/add', $data);
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
            'filename' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'file_reports' => [
                'uploaded[file_reports]',
                // 'mime_in[file_reports, application/pdf]',
                'max_size[file_reports, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $file_reports = $this->request->getFile('file_reports');
        if ($file_reports != '') {
            $file_reports->move(ROOTPATH . 'public/assets/file_reports/kkn');
        }

        $this->laporan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'filename' => $this->request->getPost('filename'),
            'status' => 2,
            'file_reports' => $file_reports->getName(),
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/laporan_kkn');
    }

    public function verifikasiStatus($id)
    {
        $this->laporan->update($id, [
            'status' => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('message', 'Update status successfully!..');
        return redirect()->to('admin/laporan_kkn');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Laporan - KKN Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'laporan' => $this->laporan->get_detail_kkn($id),
        ];
        return view('backend/report/kkn/edit', $data);
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
            'filename' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'file_reports' => [
                // 'uploaded[file_reports]',
                // 'mime_in[file_reports, application/pdf]',
                'max_size[file_reports, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $file_rpt = $this->request->getFile('file_reports');
        $file_reports = $this->laporan->find($id);
        $old_file_reports = $file_reports['file_reports'];
        $path = '../public/assets/file_reports/kkn/';


        // file_reports
        if ($file_rpt->isValid() && !$file_rpt->hasMoved()) {
            if (file_exists($path . $old_file_reports)) {
                @unlink($path . $old_file_reports);
            }
            $new_file_reports = $file_rpt->getName();
            $file_rpt->move(ROOTPATH . 'public/assets/file_reports/kkn');
        } else {
            $new_file_reports = $old_file_reports;
        }

        $this->laporan->update($id, [
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'filename' => $this->request->getPost('filename'),
            'file_reports' => $new_file_reports,
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/laporan_kkn');
    }

    public function delete($id)
    {
        $file_reports = $this->laporan->find($id);
        $this->laporan->delete($id);
        $f_rpt = $file_reports['file_reports'];
        $path = '../public/assets/file_reports/kkn/';
        @unlink($path . $f_rpt);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/laporan_kkn'));
    }
}

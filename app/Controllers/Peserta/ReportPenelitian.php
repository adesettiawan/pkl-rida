<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelReport;
//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ReportPenelitian extends BaseController
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
            'title' => 'Laporan - Penelitian Bidang RIDA',
            'laporan' => $this->laporan->get_byUser_penelitian(),
            'user_admin' => $this->user->get_user_admin(),
        ];
        return view('peserta/report/penelitian/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Laporan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('peserta/report/penelitian/add', $data);
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
            $file_reports->move(ROOTPATH . 'public/assets/file_reports/penelitian');
        }

        $this->laporan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'filename' => $this->request->getPost('filename'),
            'status' => 2,
            'file_reports' => $file_reports->getName(),
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('user/laporan_penelitian');
    }

    public function verifikasiToAdmin($id)
    {

        $data = $this->laporan->get_detail_penelitian($id);
        // dd($data);
        $message = "Perkenalkan Saya " . $data['nama_ketua'] . " Ingin menginformasikan telah mengajukan Laporan " . $data['type'] . ". Terimakasih!";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 1;

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'adsttt00@gmail.com';
        $mail->Password = 'hmpdidyptlgjebum';

        $mail->setFrom($data['email_ketua'], 'Pengajuan Laporan ' . $data['type']);
        $mail->addAddress('adsttt00@gmail.com', 'Pemberitahuan Pengajuan Laporan ' . $data['type']);
        $mail->isHTML(true);
        $mail->Subject = "Pengajuan Laporan " . $data['type'];
        $mail->Body = $message;

        $mail->AltBody = 'HTML messaging not supported';

        if (!$mail->send()) {
            echo 'Email not sent an error was encountered';
        } else {
            echo 'Email message has been sent.';
        }

        $mail->smtpClose();

        session()->setFlashdata('message', 'Permintaan verifikasi by Email successfully!..');
        return redirect()->to('user/laporan_penelitian');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Laporan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'laporan' => $this->laporan->get_detail_penelitian($id),
        ];
        return view('peserta/report/penelitian/edit', $data);
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
        $path = '../public/assets/file_reports/penelitian/';


        // file_reports
        if ($file_rpt->isValid() && !$file_rpt->hasMoved()) {
            if (file_exists($path . $old_file_reports)) {
                @unlink($path . $old_file_reports);
            }
            $new_file_reports = $file_rpt->getName();
            $file_rpt->move(ROOTPATH . 'public/assets/file_reports/penelitian');
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
        return redirect()->to('user/laporan_penelitian');
    }

    public function delete($id)
    {
        $file_reports = $this->laporan->find($id);
        $this->laporan->delete($id);
        $f_rpt = $file_reports['file_reports'];
        $path = '../public/assets/file_reports/penelitian/';
        @unlink($path . $f_rpt);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('user/laporan_penelitian'));
    }
}

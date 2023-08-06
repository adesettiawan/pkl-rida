<?php

namespace App\Controllers;

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
            'laporan' => $this->laporan->get_all_penelitian(),
        ];
        return view('backend/report/penelitian/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Laporan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('backend/report/penelitian/add', $data);
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

        $status = 1;

        $this->laporan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'filename' => $this->request->getPost('filename'),
            'status' => $status,
            'file_reports' => $file_reports->getName(),
        ]);

        if ($status == 1) {
            $admin = $this->user->get_user_admin();
            $pimpinan = $this->user->get_user_pimpinan();
            $data = $this->laporan->get_detail_penelitian($this->request->getPost('user_id'));

            $message = "PKL Bidang RIDA : " . $admin['name'] . " Ingin menginformasikan telah menerima pengajuan laporan " . $this->request->getPost('type') . " " . $data['nama_ketua'] . ". Silahkan Pimpinan melakukan verifikasi disetujui/ditolak. Terimakasih!";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 1;

            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'naprindaamelita@gmail.com';
            $mail->Password = 'xipvlnozduofpysf';

            $mail->setFrom($admin['email'], 'Pengajuan laporan ' . $this->request->getPost('type'));
            $mail->addAddress($pimpinan['email'], 'Pemberitahuan Pengajuan laporan ' . $this->request->getPost('type'));
            $mail->isHTML(true);
            $mail->Subject = "Pengajuan laporan " . $this->request->getPost('type');
            $mail->Body = $message;

            $mail->AltBody = 'HTML messaging not supported';

            if (!$mail->send()) {
                echo 'Email not sent an error was encountered';
            } else {
                echo 'Email message has been sent.';
            }

            $mail->smtpClose();
        }

        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('admin/laporan_penelitian');
    }

    public function verifikasiStatus($id)
    {
        $status = $this->request->getPost('status');

        $this->laporan->update($id, [
            'status' => $status,
        ]);

        if ($status == 1) {
            $admin = $this->user->get_user_admin();
            $pimpinan = $this->user->get_user_pimpinan();
            $data = $this->laporan->get_detail_penelitian($id);

            $message = "PKL Bidang RIDA : " . $admin['name'] . " Ingin menginformasikan telah menerima pengajuan laporan " . $data['type'] . " " . $data['nama_ketua'] . ". Silahkan Pimpinan melakukan verifikasi disetujui/ditolak. Terimakasih!";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 1;

            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'naprindaamelita@gmail.com';
            $mail->Password = 'xipvlnozduofpysf';

            $mail->setFrom($admin['email'], 'Pengajuan laporan ' . $data['type']);
            $mail->addAddress($pimpinan['email'], 'Pemberitahuan Pengajuan laporan ' . $data['type']);
            $mail->isHTML(true);
            $mail->Subject = "Pengajuan laporan " . $data['type'];
            $mail->Body = $message;

            $mail->AltBody = 'HTML messaging not supported';

            if (!$mail->send()) {
                echo 'Email not sent an error was encountered';
            } else {
                echo 'Email message has been sent.';
            }

            $mail->smtpClose();
        }

        session()->setFlashdata('message', 'Update status successfully!..');
        return redirect()->to('admin/laporan_penelitian');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Laporan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'laporan' => $this->laporan->get_detail_penelitian($id),
        ];
        return view('backend/report/penelitian/edit', $data);
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
        return redirect()->to('admin/laporan_penelitian');
    }

    public function delete($id)
    {
        $file_reports = $this->laporan->find($id);
        $this->laporan->delete($id);
        $f_rpt = $file_reports['file_reports'];
        $path = '../public/assets/file_reports/penelitian/';
        @unlink($path . $f_rpt);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/laporan_penelitian'));
    }

    public function exportPDF()
    {
        $data = [
            'title' => 'Rekapitulasi Laporan Penelitian - Bidang RIDA',
            'data_laporan' => $this->laporan->get_all_penelitian(),
        ];

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('backend/rekap/penelitian/laporan', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream(date('d-m-Y') . "-rekap-laporan-penelitian.pdf", array('Attachment' => 0));
    }
}

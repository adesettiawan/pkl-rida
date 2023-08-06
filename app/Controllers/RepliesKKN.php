<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelReplies;

//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RepliesKKN extends BaseController
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
            'title' => 'Surat Balasan - KKN Bidang RIDA',
            'data_balasan' => $this->balasan->get_all_kkn(),
        ];
        return view('backend/replies/kkn/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Surat Balasan - KKN Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('backend/replies/kkn/add', $data);
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
                'rules' => 'required|is_unique[replies.no_surat]',
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
            $file_replies->move(ROOTPATH . 'public/assets/file_replies/kkn');
        }

        $status = 1;

        $this->balasan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'status' => $status,
            'file_replies' => $file_replies->getName(),
        ]);

        if ($status == 1) {
            $admin = $this->user->get_user_admin();
            $pimpinan = $this->user->get_user_pimpinan();
            $data = $this->balasan->get_detail_kkn($this->request->getPost('user_id'));

            $message = "PKL Bidang RIDA : " . $admin['name'] . " Ingin menginformasikan telah membuat surat balasan " . $this->request->getPost('type') . " " . $data['nama_ketua'] . ". Silahkan Pimpinan melakukan verifikasi disetujui/ditolak. Terimakasih!";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 1;

            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'naprindaamelita@gmail.com';
            $mail->Password = 'xipvlnozduofpysf';

            $mail->setFrom($admin['email'], 'Pengajuan surat balasan ' . $this->request->getPost('type'));
            $mail->addAddress($pimpinan['email'], 'Pemberitahuan Pengajuan surat balasan ' . $this->request->getPost('type'));
            $mail->isHTML(true);
            $mail->Subject = "Pengajuan surat balasan " . $this->request->getPost('type');
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
        return redirect()->to('admin/data_balasan_kkn');
    }

    public function verifikasiStatus($id)
    {
        $status = $this->request->getPost('status');

        $this->balasan->update($id, [
            'status' => $status,
        ]);

        if ($status == 1) {
            $admin = $this->user->get_user_admin();
            $pimpinan = $this->user->get_user_pimpinan();
            $data = $this->balasan->get_detail_kkn($id);

            $message = "PKL Bidang RIDA : " . $admin['name'] . " Ingin menginformasikan telah membuat surat balasan " . $data['type'] . " " . $data['nama_ketua'] . ". Silahkan Pimpinan melakukan verifikasi disetujui/ditolak. Terimakasih!";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 1;

            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'naprindaamelita@gmail.com';
            $mail->Password = 'xipvlnozduofpysf';

            $mail->setFrom($admin['email'], 'Pengajuan surat balasan ' . $data['type']);
            $mail->addAddress($pimpinan['email'], 'Pemberitahuan Pengajuan surat balasan ' . $data['type']);
            $mail->isHTML(true);
            $mail->Subject = "Pengajuan surat balasan " . $data['type'];
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
        return redirect()->to('admin/data_balasan_kkn');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Surat Balasan - KKN Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'balasan' => $this->balasan->get_detail_kkn($id),
        ];
        return view('backend/replies/kkn/edit', $data);
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
        $path = '../public/assets/file_replies/kkn/';


        // file_replies
        if ($file_reply->isValid() && !$file_reply->hasMoved()) {
            if (file_exists($path . $old_file_replies)) {
                @unlink($path . $old_file_replies);
            }
            $new_file_replies = $file_reply->getName();
            $file_reply->move(ROOTPATH . 'public/assets/file_replies/kkn');
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
        return redirect()->to('admin/data_balasan_kkn');
    }

    public function delete($id)
    {
        $file_replies = $this->balasan->find($id);
        $this->balasan->delete($id);
        $f_replies = $file_replies['file_replies'];
        $path = '../public/assets/file_replies/kkn/';
        @unlink($path . $f_replies);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/data_balasan_kkn'));
    }

    public function exportPDF()
    {
        $data = [
            'title' => 'Rekapitulasi Surat Balasan KKN - Bidang RIDA',
            'data_balasan' => $this->balasan->get_all_kkn(),
        ];

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('backend/rekap/kkn/balasan', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream(date('d-m-Y') . "-rekap-surat-balasan-kkn.pdf", array('Attachment' => 0));
    }
}

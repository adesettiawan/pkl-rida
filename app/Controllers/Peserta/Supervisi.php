<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelSupervisi;

//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Supervisi extends BaseController
{
    protected $supervisi, $user;

    public function __construct()
    {
        $this->supervisi = new ModelSupervisi();
        $this->user = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Supervisi - Bidang RIDA',
            'supervisi' => $this->supervisi->get_byUser_supervisi(),
            'user_admin' => $this->user->get_user_admin(),
        ];
        return view('peserta/supervisi/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Supervisi - Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('peserta/supervisi/add', $data);
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
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'tgl_supervisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'jam_supervisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ]

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }


        $this->supervisi->insert([
            'user_id' => $this->request->getPost('user_id'),
            'title' => $this->request->getPost('title'),
            'tgl_supervisi' => date('Y-m-d', strtotime($this->request->getPost('tgl_supervisi'))),
            'jam_supervisi' => $this->request->getPost('jam_supervisi'),
            'type' => $this->request->getPost('type'),
            'status' => 2,
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('user/supervisi');
    }

    public function verifikasiToAdmin($id)
    {

        $data = $this->supervisi->get_detail_supervisi($id);
        // dd($data);
        $message = "Perkenalkan Saya " . $data['nama_ketua'] . " Ingin menginformasikan telah mengajukan tanggal untuk supervisi " . $data['type'] . ". Terimakasih!";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 1;

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'naprindaamelita@gmail.com';
        $mail->Password = 'xipvlnozduofpysf';

        $mail->setFrom($data['email_ketua'], 'Pengajuan Supervisi ' . $data['type']);
        $mail->addAddress('naprindaamelita@gmail.com', 'Pemberitahuan Pengajuan Supervisi ' . $data['type']);
        $mail->isHTML(true);
        $mail->Subject = "Pengajuan Supervisi " . $data['type'];
        $mail->Body = $message;

        $mail->AltBody = 'HTML messaging not supported';

        if (!$mail->send()) {
            echo 'Email not sent an error was encountered';
        } else {
            echo 'Email message has been sent.';
        }

        $mail->smtpClose();

        session()->setFlashdata('message', 'Permintaan verifikasi by Email successfully!..');
        return redirect()->to('user/supervisi');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Supervisi - Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'supervisi' => $this->supervisi->get_detail_supervisi($id),
        ];
        return view('peserta/supervisi/edit', $data);
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
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'tgl_supervisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'jam_supervisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ]

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $this->supervisi->update($id, [
            'user_id' => $this->request->getPost('user_id'),
            'title' => $this->request->getPost('title'),
            'tgl_supervisi' => date('Y-m-d', strtotime($this->request->getPost('tgl_supervisi'))),
            'jam_supervisi' => $this->request->getPost('jam_supervisi'),
            'type' => $this->request->getPost('type'),
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('user/supervisi');
    }

    public function delete($id)
    {
        $this->supervisi->delete($id);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('user/supervisi'));
    }
}

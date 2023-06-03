<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelRequest;

//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class RequestPKL extends BaseController
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
            'data_permohonan' => $this->permohonan->get_byUser_pkl(),
            'user_admin' => $this->user->get_user_admin(),

        ];
        return view('peserta/request/pkl/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Surat Permohonan - PKL Bidang RIDA',
        ];
        return view('peserta/request/pkl/add', $data);
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
            // 'nama_peserta' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} required!'
            //     ]
            // ],
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
            $file_surat->move(ROOTPATH . 'public/assets/file_surat/pkl');
        }

        $this->permohonan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'nama_peserta' => $this->request->getPost('nama_peserta') != '' ? serialize($this->request->getPost('nama_peserta')) : '',
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'asal_surat' => $this->request->getPost('asal_surat'),
            'status' => 2,
            'file_surat' => $file_surat->getName(),
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('user/data_permohonan_pkl');
    }

    public function verifikasiToAdmin($id)
    {

        $data = $this->permohonan->get_detail_pkl($id);
        // dd($data);
        $message = "Perkenalkan Saya " . $data['nama_ketua'] . " Ingin menginformasikan telah mengajukan permohonan " . $data['type'] . ". Terimakasih!";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 1;

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'adsttt00@gmail.com';
        $mail->Password = 'hmpdidyptlgjebum';

        $mail->setFrom($data['email_ketua'], 'Surat Permohonan ' . $data['type']);
        $mail->addAddress('adsttt00@gmail.com', 'Pemberitahuan Permohonan ' . $data['type']);
        $mail->isHTML(true);
        $mail->Subject = "Surat Permohonan " . $data['type'];
        $mail->Body = $message;

        $mail->AltBody = 'HTML messaging not supported';

        if (!$mail->send()) {
            echo 'Email not sent an error was encountered';
        } else {
            echo 'Email message has been sent.';
        }

        $mail->smtpClose();

        session()->setFlashdata('message', 'Permintaan verifikasi by Email successfully!..');
        return redirect()->to('user/data_permohonan_pkl');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Surat Permohonan - PKL Bidang RIDA',
            'permohonan' => $this->permohonan->get_detail_pkl($id),
        ];
        return view('peserta/request/pkl/edit', $data);
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
            // 'nama_peserta' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} required!'
            //     ]
            // ],
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
        $path = '../public/assets/file_surat/pkl/';


        // file_surat
        if ($file_surats->isValid() && !$file_surats->hasMoved()) {
            if (file_exists($path . $old_file_surat)) {
                @unlink($path . $old_file_surat);
            }
            $new_file_surat = $file_surats->getName();
            $file_surats->move(ROOTPATH . 'public/assets/file_surat/pkl');
        } else {
            $new_file_surat = $old_file_surat;
        }

        $this->permohonan->update($id, [
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'nama_peserta' => $this->request->getPost('nama_peserta') != '' ? serialize($this->request->getPost('nama_peserta')) : '',
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'asal_surat' => $this->request->getPost('asal_surat'),
            'file_surat' => $new_file_surat,
        ]);
        session()->setFlashdata('message', 'Save data successfully!..');
        return redirect()->to('user/data_permohonan_pkl');
    }

    public function delete($id)
    {
        $file_surat = $this->permohonan->find($id);
        $this->permohonan->delete($id);
        $f_surat = $file_surat['file_surat'];
        $path = '../public/assets/file_surat/pkl/';
        @unlink($path . $f_surat);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('user/data_permohonan_pkl'));
    }
}

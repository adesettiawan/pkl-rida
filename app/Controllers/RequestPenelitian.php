<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelRequest;

//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class RequestPenelitian extends BaseController
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
            'title' => 'Surat Permohonan - Penelitian Bidang RIDA',
            'data_permohonan' => $this->permohonan->get_all_penelitian(),
        ];
        return view('backend/request/penelitian/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Surat Permohonan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
        ];
        return view('backend/request/penelitian/add', $data);
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
                'rules' => 'required|is_unique[requests.no_surat]',
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
            $file_surat->move(ROOTPATH . 'public/assets/file_surat/penelitian');
        }

        $status = 1;
        $this->permohonan->insert([
            'type' => $this->request->getPost('type'),
            'user_id' => $this->request->getPost('user_id'),
            'nama_peserta' => $this->request->getPost('nama_peserta') != '' ? serialize($this->request->getPost('nama_peserta')) : '',
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'no_surat' => $this->request->getPost('no_surat'),
            'nama_surat' => $this->request->getPost('nama_surat'),
            'asal_surat' => $this->request->getPost('asal_surat'),
            'status' => $status,
            'tgl_diterima' => date('Y-m-d'),
            'file_surat' => $file_surat->getName(),
        ]);

        if ($status == 1) {
            $admin = $this->user->get_user_admin();
            $pimpinan = $this->user->get_user_pimpinan();
            $data = $this->permohonan->get_detail_penelitian($this->request->getPost('user_id'));

            $message = "PKL Bidang RIDA : " . $admin['name'] . " Ingin menginformasikan telah menerima pengajuan surat permohonan " . $this->request->getPost('type') . " " . $data['nama_ketua'] . ". Silahkan Pimpinan melakukan verifikasi disetujui/ditolak. Terimakasih!";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 1;

            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'naprindaamelita@gmail.com';
            $mail->Password = 'xipvlnozduofpysf';

            $mail->setFrom($admin['email'], 'Pengajuan surat permohonan ' . $this->request->getPost('type'));
            $mail->addAddress($pimpinan['email'], 'Pemberitahuan Pengajuan surat permohonan ' . $this->request->getPost('type'));
            $mail->isHTML(true);
            $mail->Subject = "Pengajuan surat permohonan " . $this->request->getPost('type');
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
        return redirect()->to('admin/data_permohonan_penelitian');
    }

    public function verifikasiStatus($id)
    {
        $tgl_diterima = $this->request->getPost('tgl_diterima');
        $status = $this->request->getPost('status');

        $this->permohonan->update($id, [
            'status' => $status,
            'tgl_diterima' => date('Y-m-d', strtotime($tgl_diterima)),
        ]);

        if ($status == 1) {
            $admin = $this->user->get_user_admin();
            $pimpinan = $this->user->get_user_pimpinan();
            $data = $this->permohonan->get_detail_penelitian($id);

            $message = "PKL Bidang RIDA : " . $admin['name'] . " Ingin menginformasikan telah menerima pengajuan surat permohonan " . $data['type'] . " " . $data['nama_ketua'] . ". Silahkan Pimpinan melakukan verifikasi disetujui/ditolak. Terimakasih!";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 1;

            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'naprindaamelita@gmail.com';
            $mail->Password = 'xipvlnozduofpysf';

            $mail->setFrom($admin['email'], 'Pengajuan surat permohonan ' . $data['type']);
            $mail->addAddress($pimpinan['email'], 'Pemberitahuan Pengajuan surat permohonan ' . $data['type']);
            $mail->isHTML(true);
            $mail->Subject = "Pengajuan surat permohonan " . $data['type'];
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
        return redirect()->to('admin/data_permohonan_penelitian');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Surat Permohonan - Penelitian Bidang RIDA',
            'users' => $this->user->get_active_user(),
            'permohonan' => $this->permohonan->get_detail_penelitian($id),
        ];
        return view('backend/request/penelitian/edit', $data);
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
        $path = '../public/assets/file_surat/penelitian/';


        // file_surat
        if ($file_surats->isValid() && !$file_surats->hasMoved()) {
            if (file_exists($path . $old_file_surat)) {
                @unlink($path . $old_file_surat);
            }
            $new_file_surat = $file_surats->getName();
            $file_surats->move(ROOTPATH . 'public/assets/file_surat/penelitian');
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
        return redirect()->to('admin/data_permohonan_penelitian');
    }

    public function delete($id)
    {
        $file_surat = $this->permohonan->find($id);
        $this->permohonan->delete($id);
        $f_surat = $file_surat['file_surat'];
        $path = '../public/assets/file_surat/penelitian/';
        @unlink($path . $f_surat);

        session()->setFlashdata('message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/data_permohonan_penelitian'));
    }

    public function exportPDF()
    {
        $data = [
            'title' => 'Rekapitulasi Surat Permohonan Penelitian - Bidang RIDA',
            'data_permohonan' => $this->permohonan->get_all_penelitian(),
        ];

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('backend/rekap/penelitian/permohonan', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream(date('d-m-Y') . "-rekap-surat-permohonan-penelitian.pdf", array('Attachment' => 0));
    }
}

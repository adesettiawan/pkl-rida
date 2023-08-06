<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Auth extends BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new ModelAuth();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Login - PKL Bidang RIDA',
        ];

        return view('auth/login', $data);
    }

    // processed login user
    public function login_processed()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi..!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi..!',
                ],
            ]
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $row = $this->auth->where('email', $email)->first();

            if ($row == NULL) {
                session()->setFlashdata('messages', 'Email not found, please contact your admin..!');
                return redirect()->to('/');
            }
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $data = [
                        'is_login' => TRUE,
                        'id' => $row['id'],
                        'npm' => $row['npm'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'telp' => $row['telp'],
                        'instansi_name' => $row['instansi_name'],
                        'status' => $row['status'],
                        'level' => $row['level'],
                        'ktm' => $row['ktm'],
                        'periodeawal' => $row['periodeawal'],
                        'periodeakhir' => $row['periodeakhir'],
                        'image' => $row['image'],
                    ];
                    session()->set($data);
                    if (session()->get('level') == 1) {
                        session()->setFlashdata('message', 'Login successfully');
                        return redirect()->to('admin/dashboard');
                    } elseif (session()->get('level') == 0 && session()->get('status') == 1) {
                        session()->setFlashdata('message', 'Login successfully');
                        return redirect()->to('admin/dashboard');
                    } elseif (session()->get('level') == 2 && session()->get('status') == 1) {
                        session()->setFlashdata('message', 'Login successfully');
                        return redirect()->to('user/dashboard');
                    } else {
                        session()->setFlashdata('messages', 'Login failed, account not actived, please contact your admin..!');
                        return redirect()->to('/');
                    }
                } else {
                    session()->setFlashdata('messages', 'Login failed, wrong email or password, please check again..!');
                    return redirect()->to('/');
                }
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/'));
        }
    }

    public function logout()
    {
        $data = [
            'is_login',
            'id',
            'npm',
            'name',
            'email',
            'telp',
            'instansi_name',
            'status',
            'level',
            'ktm',
            'periodeawal',
            'periodeakhir',
            'image',
        ];
        session()->setFlashdata('message', 'Logout successfully');
        session()->remove($data);
        session()->destroy();

        return redirect()->to('/');
    }

    public function register()
    {
        $data = [
            'title' => 'Register - PKL Bidang RIDA',
        ];

        return view('auth/register', $data);
    }

    public function register_processed()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
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
            'npm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
            'ktm' => [
                'uploaded[ktm]',
                // 'mime_in[ktm, image/png, image/jpg,image/jpeg, image/gif]',
                'max_size[ktm, 4096]',
            ],

        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $ktm = $this->request->getFile('ktm');
        if ($ktm != '') {
            $ktm->move(ROOTPATH . 'public/assets/ktm/');
            $imgKtm = $ktm->getName();
        } else {
            $imgKtm = '';
        }

        $pw = $this->request->getPost('password');
        $this->auth->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'telp' => $this->request->getPost('telp'),
            'instansi_name' => $this->request->getPost('instansi_name'),
            'password' => password_hash($pw, PASSWORD_DEFAULT),
            'npm' => $this->request->getPost('npm'),
            'image' => '',
            'level' => 2,
            'status' => 2,
            'ktm' => $imgKtm,
        ]);

        $message = "Perkenalkan Saya " . $this->request->getPost('name') . ", asal instansi " . $this->request->getPost('instansi_name') . " Ingin menginformasikan telah melakukan register dan meminta untuk aktivasi akun login. Terimakasih!";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 1;

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'naprindaamelita@gmail.com';
        $mail->Password = 'xipvlnozduofpysf';

        $mail->setFrom($this->request->getPost('email'), 'Surat Permohonan Aktivasi Akun');
        $mail->addAddress('naprindaamelita@gmail.com', 'Pemberitahuan Permohonan Aktivasi Akun');
        $mail->isHTML(true);
        $mail->Subject = "Surat Permohonan  Aktivasi Akun";
        $mail->Body = $message;

        $mail->AltBody = 'HTML messaging not supported';

        if (!$mail->send()) {
            echo 'Email not sent an error was encountered';
        } else {
            echo 'Email message has been sent.';
        }

        $mail->smtpClose();
        session()->setFlashdata('message', 'Register successfully!..');
        return redirect()->to('/');
    }

    public function profile($id)
    {
        $data = [
            'title' => 'Profile - Bidang RIDA',
            'profile' => $this->auth->find($id),
        ];
        return view('backend/profile/edit', $data);
    }

    public function updateProfileUser($id)
    {
        if (!$this->validate([
            'name' => [
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
            'image' => [
                // 'mime_in[image, image/png, image/jpg,image/jpeg, image/gif]',
                'max_size[image, 4096]',
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $profile = $this->auth->find($id);
        $old_profile = $profile['image'];
        $path = '../public/assets/img/';

        $image = $this->request->getFile('image');

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

        $periodeawal = $this->request->getPost('periodeawal');
        $periodeakhir = $this->request->getPost('periodeakhir');

        $this->auth->update($id, [
            'name' => $this->request->getPost('name'),
            'telp' => $this->request->getPost('telp'),
            'periodeawal' => date('Y-m-d', strtotime($periodeawal)),
            'periodeakhir' => date('Y-m-d', strtotime($periodeakhir)),
            'image' => $new_image
        ]);

        session()->setFlashdata('message', 'Update profile successfully!..');
        return redirect()->to('profile/' . session()->get('id'));
    }

    public function changePasswordProfile($id)
    {
        $data = [
            'title' => 'Data User - Bidang RIDA',
            'profile' => $this->auth->find($id),
        ];
        return view('backend/profile/changePassword', $data);
    }

    public function changePasswordProfileProcessed($id)
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

        $pw = $this->request->getPost('password');
        $this->auth->update($id, [
            'name' => $this->request->getPost('name'),
            'password' => password_hash($pw, PASSWORD_DEFAULT),

        ]);

        session()->setFlashdata('message', 'Update password successfully!..');
        return redirect()->to('profile/' . session()->get('id'));
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Forgot Password - PKL Bidang RIDA',
        ];

        return view('auth/forgot', $data);
    }

    public function forgot_password_processed()
    {

        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required!'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $email = $this->request->getPost('email');

        $findemail = $this->auth->forgotPassword($email);
        if ($findemail) {
            $this->auth->sendPassword($findemail);
            session()->setFlashdata('message', 'Send Link Forgot password successfully!..');
            return redirect()->to('forgot-password');
        } else {
            session()->setFlashdata('messages', 'Email not found!..');
            return redirect()->to('forgot-password');
        }
    }

    public function new_password($email)
    {
        $data = [
            'title' => 'Reset Password - PKL Bidang RIDA',
            'user' => $this->auth->forgotPassword($email),

        ];

        return view('auth/newpassword', $data);
    }

    public function new_password_processed($email)
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


        $newPw = $this->request->getPost('password');
        $newPassword = password_hash($newPw, PASSWORD_DEFAULT);

        $this->auth->updatePassword($email, $newPassword);

        session()->setFlashdata('message', 'Update password successfully!..');
        return redirect()->to('/');
    }
}

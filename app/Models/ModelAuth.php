<?php

namespace App\Models;

use CodeIgniter\Model;

//PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ModelAuth extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['npm', 'name', 'email', 'telp', 'instansi_name', 'status', 'password', 'level', 'ktm', 'image', 'periodeawal', 'periodeakhir'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_active_user()
    {
        $data = $this->db->table('users')
            ->where('status', '1')
            ->get()->getResultArray();

        return $data;
    }

    public function get_user_admin()
    {
        $data = $this->table('users')
            ->where('id', 1)
            ->get()->getRowArray();

        return $data;
    }

    public function get_user_pimpinan()
    {
        $data = $this->table('users')
            ->where('level', 0)
            ->get()->getRowArray();

        return $data;
    }

    public function get_user_byLogin()
    {
        $data = $this->table('users')
            ->where('id', session()->get('id'))
            ->get()->getRowArray();

        return $data;
    }

    function forgotPassword($email)
    {
        $data = $this->table('users')
            ->where('email', $email)
            ->get()->getRowArray();

        return $data;
    }

    function sendPassword($data)
    {
        $email = $data['email'];
        $user = $this->table('users')
            ->where('email', $email)
            ->get()->getRowArray();


        $message = "<p>Anda melakukan permintaan reset password!</p><br>
        <a href='" . base_url('new-password/' . $user['email']) . "'>Klik reset password</a><br>
        <p>Silahkan update password kamu!</p><p>Terimakasih!<p>";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 0;

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'naprindaamelita@gmail.com';
        $mail->Password = 'xipvlnozduofpysf';

        $mail->setFrom('naprindaamelita@gmail.com', 'Reset Password Request');
        $mail->addAddress($user['email'], 'Pemberitahuan Reset Password Request');
        $mail->isHTML(true);
        $mail->Subject = "Reset Password Request";
        $mail->Body = $message;

        $mail->AltBody = 'HTML messaging not supported';

        if (!$mail->send()) {
            session()->setFlashdata('messages', 'Email not sent an error was encountered');
        } else {
            session()->setFlashdata('message', 'Send Link Forgot password successfully!..');
        }

        $mail->smtpClose();
        return redirect()->to('forgot-password');
    }

    function updatePassword($email, $pw)
    {
        $this->table('users')
            ->where('email', $email)
            ->set('password', $pw)->update();

        return true;
    }
}

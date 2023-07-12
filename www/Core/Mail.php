<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class Mail
{
    public $mail;
    public function verif_account(string $email, string $verif_code)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //To load the French version
        $mail->setLanguage('fr', '/optional/path/to/language/directory/');

        try {
            //Server settings               //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'e2fb6f6d81487d';
            $mail->Password = 'c51b837de4f1c3';               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('waveflow278@gmail.com', 'Waveflow');
            $mail->addAddress($email, 'Salut mec');     //DESTINATAIRE

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML


            $mail->Subject = 'Email verification code';
            $mail->Body = 'Your verification code is: ' . $verif_code . '<br><br>Click <a href="http://localhost/verify_account">here</a> to verify your account.';

            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $mail->smtpClose();
            echo 'Le Message a bien été envoyé <br>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error:";
        }
    }

    public function pwd_forgot(string $email, string $pwd)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //To load the French version
        $mail->setLanguage('fr', '/optional/path/to/language/directory/');

        try {
            //Server settings               //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'e2fb6f6d81487d';
            $mail->Password = 'c51b837de4f1c3';               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('waveflow278@gmail.com', 'Waveflow');
            $mail->addAddress($email, 'Salut mec');     //DESTINATAIRE

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Réinitialisation de votre mot de passe";
            $mail->Body    =
                '
                Vous avez entamé une procédure de réinitialisation de votre mot de passe
                <b> Un mot de passe temporaire vous a été assigné : 
                <br>
                    <h1 style="color:red;">' . $pwd . '</h1>
                </b>
                <a href="' . SITENAME . '/login"> Connectez vous avec votre nouveau mot de passe : </a>
                <h2> Si vous n\'êtes pas à l\'origine de cette procédure : <a href="' . SITENAME . '/contact">Nous contacter</a></h2>
            '; // href a modifier lors du déploiement
            $mail->send();
            $mail->smtpClose();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error:";
        }
    }
}

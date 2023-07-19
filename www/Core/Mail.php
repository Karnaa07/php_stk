<?php

namespace App\Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Controllers\Auth;   

require_once __DIR__ . '/../vendor/autoload.php';

class Mail {
    public $mail;
    public function send_mail() {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //To load the French version
        $mail->setLanguage('fr', '/optional/path/to/language/directory/');

        try { 
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'waveflow278@gmail.com';              //SMTP username
            $mail->Password   = 'waveflow1234';                        //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;             //Enable implicit TLS encryption
            $mail->Port       = 587;                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('waveflow278@gmail.com', 'Waveflow');
            $mail->addAddress('waveflow278@gmail.com', 'Salut mec');     //DESTINATAIRE

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML

            
            $mail->Subject = 'Email verification code';
            $mail->Body    = 'Your verification code is: ' . '123456';

            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $mail->smtpClose();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error:";
        }
    }
    public function pwd_forget_mail(string $email, string $pwd) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //To load the French version
        $mail->setLanguage('fr', '/optional/path/to/language/directory/');

        try { 
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'waveflow.cjq@gmail.com';              //SMTP username
            $mail->Password   = 'WLS-85srmEv!q:T';                       //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('waveflow.cjq@gmail.com', SITENAME);
            $mail->addAddress($email, '');     //DESTINATAIRE

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Réinitialisation de votre mot de passe";
            $mail->Body    = 
            '
                Vous avez entamé une procédure de réinitialisation de votre mot de passe
                <b> Un mot de passe temporaire vous a été assigné : 
                <br>
                    <h1 style="color:red;">'.$pwd.'</h1>
                </b>
                <a href="'.SITENAME.'/login"> Connectez vous avec votre nouveau mot de passe : </a>
                <h2> Si vous n\'êtes pas à l\'origine de cette procédure : <a href="'.SITENAME.'/contact">Nous contacter</a></h2>
            ';// href a modifier lors du déploiement
            $mail->send();
            $mail->smtpClose();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error:";
        }
    }
    public function verif_account(string $email, string $name, string $token) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //To load the French version
        $mail->setLanguage('fr', '/optional/path/to/language/directory/');

        try { 
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'waveflow.cjq@gmail.com';              //SMTP username
            $mail->Password   = 'WLS-85srmEv!q:T';                        //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('waveflow.cjq@gmail.com', 'Waveflow CORP');
            $mail->addAddress($email, '');     //DESTINATAIRE

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Validation";
            // AJOUTER UNE VARIABLE GLOBAL AVEC LE NOM DU SITE
            $mail->Body    = 
            '
                // Bonjour '.$name.' tu as crée ton compte chez '.SITENAME.' et nous t\'en remercions 
                Plus qu\'un pas pour accèder a la formation de l\'année
                il te suffit de cliquer sur le lien ci-dessous pour valider ton compte
                <a href="localhost/accountActivated?tkn='.$token.'&email='.$email.'">Je confirme mon compte</a></h2>
                <h2> Si vous n\'êtes pas à l\'origine de cette procédure : <a href="'.SITENAME.'/contact">Nous contacter</a></h2>
            ';// href a modifier lors du déploiement
            $mail->send();
            $mail->smtpClose();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error:";
        }
    }
    
}
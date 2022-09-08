<?php

namespace Application\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\HttpFoundation\Request;

class mailController
{
    public function mailer()
    {
        $mail = new PHPMailer(true);
        try {
            //config
            $mail->SMTPDebug  =  SMTP::DEBUG_SERVER;                    
            //SMTP
            $mail->isSMTP();
            $mail->Host = "localhost";
            $mail->Port = 1025;
            //Charset
            $mail->CharSet = "utf-8";
            //Destinataire
            $mail->addAddress("exemple@site.fr");
            //Expéditeur
            $mail->setFrom("no-reply@site.fr");
            //Contenu
            $mail->Subject = "Sujet du message";
            $mail->Body = "message";            
            //Envoie
            $mail->send();            
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


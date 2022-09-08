<?php

namespace Application\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\HttpFoundation\Request;

class HomepageController
{
    public function execute()
    {
        include 'templates/homepage.php';
    }

    public function mailer()
    {
        $request = Request::createFromGlobals();
        $input = $request->request->all();
        $mail = new PHPMailer(true);
        if ($input !== null) {
            $name = null;
            $email = null;
            $message = null;
            if (!empty($input['name']) && !empty($input['email']) && !empty($input['message'])) {
                $name= $input['name'];
                $email = $input['email'];
                $message = $input['message'];    
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
                    $mail->setFrom($email);
                    //Contenu
                    $mail->Subject = "Sujet du message";
                    $mail->Body = $name." vous a envoyé un message : ".$message;            
                    //Envoie
                    $mail->send();            
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
}

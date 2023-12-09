<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{

    public function send(string $toEmail, string $toName = 'User')
    {
        $mail = new PHPMailer;

        echo "Config " . Env::get('MAIL_HOST') . ":" . Env::get('MAIL_PORT') . "\n";

        $mail->SMTPDebug = true;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = Env::get('MAIL_HOST');                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = Env::get('MAIL_USERNAME');                     // SMTP username
        $mail->Password   = Env::get('MAIL_PASSWORD');                                // SMTP password
        $mail->SMTPSecure = Env::get('MAIL_ENCRYPTION'); ;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = Env::get('MAIL_PORT');

        echo "Mail body \n";

        $mail->From = Env::get('MAIL_FROM_ADDRESS');
        $mail->FromName = Env::get('MAIL_FROM_NAME');
        $mail->addAddress($toEmail, $toName);//Recipient name is optional
        $mail->isHTML(true);
        $mail->Subject = "Subject Text";
        $mail->Body = "<i>Mail body in HTML</i>";
        $mail->AltBody = "This is the plain text version of the email content";

        echo "Mail start send \n";

        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else { echo "Message has been sent successfully";
        }
        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            echo "Message has been sent successfully";
        }

    }

}

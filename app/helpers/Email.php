<?php
declare (strict_types = 1);
namespace App\Helpers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    private PHPMailer $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer(true);

    }

    public  function sendEmail(array $serverSetting, array $recipients, array $content)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $this->setServerSetting($serverSetting);
            //Recipients
            $this->setRecipients($recipients);
            //Content
            $this->setContent($content);
            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function setServerSetting(array $serverSetting)
    {
        // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $this->mail->isSMTP(); //Send using SMTP
        $this->mail->Host = $serverSetting["server"]; //Set the SMTP server to send through
        $this->mail->SMTPAuth = true; //Enable SMTP authentication
        $this->mail->Username = $serverSetting["username"]; //SMTP username
        $this->mail->Password = $serverSetting["password"] ; //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $this->mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }

    private function setRecipients(array $recipients) {
        $this->mail->setFrom($recipients["fromEmail"], $recipients["fromName"]);
        $this->mail->addAddress($recipients["recipientEmail"], $recipients["recipientName"] ); //Add a recipient
        $this->mail->addAddress($recipients["recipientEmail"]); //Name is optional
        $this->mail->addReplyTo('no-reply@gmail.com', 'No reply');
    }

    private function setContent(array $content) {
        $this->mail->isHTML(true); //Set email format to HTML
        $this->mail->Subject = $content["subject"];
        $this->mail->Body = $content["body"];
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

}

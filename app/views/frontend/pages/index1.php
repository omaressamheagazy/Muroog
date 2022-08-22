<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'omaressamhegazy6@gmail.com'; //SMTP username
    $mail->Password = 'ecptqitbflkjfubc'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('omaressamhegazy6@gmail.com', 'Muroog Support');
    $mail->addAddress('omaressamhegazy6@gmail.com', 'Muroog Admin'); //Add a recipient
    $mail->addAddress('omaressamhegazy6@gmail.com'); //Name is optional
    $mail->addReplyTo('no-reply@gmail.com', 'No reply');


    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'reset password';
    $mail->Body = 'Click the <a>link</a> to reset your password';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

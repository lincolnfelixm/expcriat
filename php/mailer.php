<?php

include 'token.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function sendTokenEmail($toEmail)
{
    $mail = new PHPMailer();

    // Configuration
    $mail->Mailer = "smtp";
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;

    // Email sending details
    $mail->Username = 'myLaboratory';
    $mail->Password = "szkbcnvbbdfyhwpe";
    $mail->SetFrom("lincoln.felixm@gmail.com");
    $mail->addAddress($toEmail);
    $mail->Subject = "Recovery Token.";

    // Message
    $token = generateToken(8);
    $message = "<h1> Token </h1>";
    $message .= "<h3> $token </h3>";

    $mail->msgHTML($message);
    $mail->send();
}
?>

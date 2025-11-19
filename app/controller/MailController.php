<?php
require_once(__DIR__.'/../util/config.php');
require_once(__DIR__.'/Aplicacao/vendor/phpmailer/src/PHPMailer.php');

$mail = new PHPMailer();
$mail->isSMTP();               // Enable SMTP
$mail->Host = 'smtp.protonmail.com'; // ProtonMail SMTP server
$mail->Port = 587;             // Port for TLS
$mail->SMTPSecure = 'tls';     // Enable TLS encryption
$mail->SMTPAuth = true;        // Enable SMTP authentication
$mail->Username = MAIL_HOST;   // SMTP username (from config)
$mail->Password = MAIL_PASSWORD; // SMTP password (from config)

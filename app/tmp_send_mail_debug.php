<?php
// Script temporário para testar envio via PHPMailer com debug SMTP verbose
require_once __DIR__ . '/util/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$to = 'a@bugado.tw';
$subject = 'Teste debug via CLI';
$body = 'Olá, este é um teste com debug SMTP.';

try {
    $mail = new PHPMailer(true);

    // Habilitar debug (verbose)
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function($str, $level) {
        // Envia para stdout
        echo $str;
    };

    // Configurações SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.protonmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_HOST;
    $mail->Password = MAIL_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Evitar problemas de certificado em ambiente local (apenas para debug)
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->setFrom(MAIL_HOST, APP_NAME);
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    echo "Tentando enviar e-mail para: $to\n";

    if ($mail->send()) {
        echo "Resultado: E-mail enviado com sucesso.\n";
    } else {
        echo "Resultado: Falha ao enviar: " . $mail->ErrorInfo . "\n";
    }

} catch (Exception $e) {
    echo "Exceção: " . $e->getMessage() . "\n";
}

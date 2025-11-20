<?php
// Controller responsável por envios de e-mail
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/util/config.php");

// Carrega o autoloader do Composer (garante carregamento do PHPMailer)
require_once(__DIR__ . '/../../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailController extends Controller {

    public function __construct() {
        // Delegar o controle de ações ao Controller base
        $this->handleAction();
    }

    /**
     * Action de teste: enviar um e-mail simples
     * Chamada: controller/MailController.php?action=sendTest&to=destino@exemplo.com&subject=teste&body=mensagem
     */
    protected function sendTest() {
        $to = isset($_GET['to']) ? trim($_GET['to']) : null;
        $subject = isset($_GET['subject']) ? trim($_GET['subject']) : 'Teste ' . APP_NAME;
        $body = isset($_GET['body']) ? trim($_GET['body']) : '<p>Este é um e-mail de teste.</p>';

        if(empty($to)) {
            echo 'Parâmetro "to" é obrigatório. Ex: ?action=sendTest&to=usuario@dominio';
            return;
        }

        try {
            $mail = new PHPMailer(true);

            // Configurações SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.protonmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_HOST;
            $mail->Password = MAIL_PASSWORD;
            // Usar STARTTLS na porta 587
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // De/para
            $mail->setFrom(MAIL_HOST, APP_NAME);
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            if($mail->send()) {
                echo 'E-mail de teste enviado para: ' . htmlspecialchars($to);
            } else {
                echo 'Falha ao enviar e-mail: ' . $mail->ErrorInfo;
            }

        } catch (\Exception $e) {
            echo 'Exceção ao enviar e-mail: ' . $e->getMessage();
        }
    }

}

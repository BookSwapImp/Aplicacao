<?php
// Script temporário para testar envio via MailController
$_GET = [
    'action' => 'sendTest',
    'to' => 'a@bugado.tw',
    'subject' => 'Teste via CLI',
    'body' => 'Olá, este é um teste enviado pelo MailController.'
];

include __DIR__ . '/controller/MailController.php';

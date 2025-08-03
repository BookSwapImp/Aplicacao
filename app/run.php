<?php

require_once(__DIR__."/service/ArquivoService.php");

$arquivoService = new ArquivoService();

// Testar se o diretório de uploads existe
$diretorioUploads = __DIR__ . '/arquivos/basePfp.jpeg';
if (is_dir($diretorioUploads)) {
    echo "Diretório de uploads existe: " . $diretorioUploads;
} else {
    echo "Diretório de uploads não existe";
}

// Testar com o arquivo basePfp.jpeg
$arquivoTeste = [
    'name' => 'basePfp.jpeg',
    'type' => 'image/jpeg',
    'tmp_name' => __DIR__ . '/arquivos/basePfp.jpeg',
    'error' => 0,
    'size' => filesize(__DIR__ . '/arquivos/basePfp.jpeg')
];

echo "<br><br>Testando com arquivo: " . $arquivoTeste['tmp_name'];

if (file_exists($arquivoTeste['tmp_name'])) {
    echo "<br>Arquivo existe!";
    $arquivoService->salvarArquivo($arquivoTeste);
} else {
    echo "<br>Arquivo não encontrado!";
}

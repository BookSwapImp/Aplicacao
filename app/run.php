<?php
require_once(__DIR__."/util/config.php");
require_once(__DIR__."/service/ArquivoService.php");
$arquivoService = new ArquivoService();
$arquivo = 'arquivo_689a87ff390bb_1754957823.png';
$caminhoArquivo = PATH_ARQUIVOS . DIRECTORY_SEPARATOR . $arquivo;

if (is_file($caminhoArquivo)) {
    echo 'Arquivo encontrado: ' . $caminhoArquivo . "\n";
    $arquivoService->excluirArquivo($arquivo);
    echo "Arquivo removido com sucesso!";
} else {
    throw new Exception("Arquivo não encontrado: " . $caminhoArquivo . ' ' . $arquivo);
}
<?php
// Teste final para validar upload usando basePfp.jpg do diretório arquivos

require_once(__DIR__."/service/ArquivoService.php");

echo "=== TESTE FINAL - UPLOAD COM basePfp.jpg ===\n\n";

// Configuração do arquivo de teste
$arquivoTeste = __DIR__ . '/../arquivos/basePfp.jpeg';

// Verificar existência do arquivo
if (!file_exists($arquivoTeste)) {
    echo "❌ ERRO: basePfp.jpg não encontrado em $arquivoTeste\n";
    exit;
}

// Simular estrutura $_FILES com basePfp.jpg
$arquivoSimulado = [
    'name' => 'download (2).jpg',
    'type' => 'image/jpg',
    'tmp_name' => $arquivoTeste,
    'error' => 0,
    'size' => filesize($arquivoTeste)
];

echo "✅ Arquivo  localizado\n";
echo "   Tamanho: " . $arquivoSimulado['size'] . " bytes\n";

// Testar método salvarArquivo
$arquivoService = new ArquivoService();
$resultado = $arquivoService->salvarArquivo($arquivoSimulado);


if ($resultado) {
    echo "✅ SUCESSO: Arquivo salvo como '$resultado'\n";
    echo "   Caminho completo: " . __DIR__ . '/../arquivos/' . $resultado . "\n";
} else {
    echo $resultado;
    echo "❌ FALHA: Não foi possível salvar o arquivo\n";
}

echo "\n=== TESTE FINALIZADO ===\n";
?>

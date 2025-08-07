<?php 
//Classe service para salvar arquivos na base de dados
require_once(__DIR__ . "/../util/config.php");

class ArquivoService {

    //Salvar um arquivo
    // Versão melhorada com validações adicionais
public function salvarArquivo(array $arquivo) {
    // Validar erro de upload
    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Erro no upload do arquivo: código " . $arquivo['error']);
    }
    else{
        echo("upload_sucees" . $arquivo['error']);
    }

    // Validar tamanho
    if ($arquivo['size'] <= 0) {
        throw new Exception("Arquivo com tamanho inválido ou vazio.");
    }
    else{
        echo("upload_sucees" . $arquivo['size']);
    }

    // Extrair extensão de forma mais segura
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    // Validar extensão permitida
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extensao, $extensoesPermitidas)) {
        throw new Exception("Extensão de arquivo não permitida.");
    }
    else{
        echo("extensaoAprov" . $extensao);
    }

    // Gerar nome único com hash
    $nomeUnico = uniqid('arquivo_') . '_' . time();
    $nomeArquivo = $nomeUnico . '.' . $extensao;

    // Verificar se diretório existe, senão cria
    if (!is_dir(PATH_ARQUIVOS)) {
        if (!mkdir(PATH_ARQUIVOS, 0755, true)) {
            throw new Exception("Falha ao criar diretório: " . PATH_ARQUIVOS);
        }
    }

    // Salvar arquivo
    $destino = PATH_ARQUIVOS . DIRECTORY_SEPARATOR . $nomeArquivo;
    echo "TMP: " . $arquivo['tmp_name'] . " DEST: " . $destino . "\n";
    if (!file_exists($arquivo['tmp_name'])) {
        throw new Exception("Arquivo temporário não encontrado: " . $arquivo['tmp_name']);
    }

    // Se for upload HTTP, usa move_uploaded_file. Se for teste/CLI, usa copy
    if (is_uploaded_file($arquivo['tmp_name'])) {
        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return $nomeArquivo;
        }
    } else {
        if (copy($arquivo['tmp_name'], $destino)) {
            return $nomeArquivo;
        }
    }

    throw new Exception("Falha ao mover/copiar o arquivo para o destino. TMP: " . $arquivo['tmp_name'] . " DEST: " . $destino);
}


}
<?php

use function PHPSTORM_META\type;

require_once(__DIR__."/dao/EnderecoDAO.php");

$EnderecoDAO = new EnderecoDAO();
$enderecos = $EnderecoDAO->listEnderecosByUsuarioId(1);

echo "\nDebug - Tipo de retorno: " . gettype($enderecos);
if (is_object($enderecos)) {
    echo "\nÉ um objeto da classe: " . get_class($enderecos);
} elseif (is_array($enderecos)) {
    echo "\nÉ um array com " . count($enderecos) . " elementos";
}

printf("<pre>%s</pre>", print_r($enderecos, true));

echo "\nEndereços encontrados:\n";
if (empty($enderecos)) {
    echo "Nenhum endereço encontrado.";
} else {
    // Handle both single object and array scenarios
    if (is_array($enderecos)) {
        // If it's an array of objects
        foreach ($enderecos as $endereco) {
            echo "ID: " . $endereco->getId() . "\n";
            echo "Nome: " . $endereco->getNome() . "\n";
            echo "Rua: " . $endereco->getRua() . "\n";
            echo "Cidade: " . $endereco->getCidade() . "\n";
            echo "Estado: " . $endereco->getEstado() . "\n";
            echo "CEP: " . $endereco->getCep() . "\n";
            echo "Número: " . $endereco->getNumb() . "\n";
            echo "------------------------\n";
        }
    } else {
        // If it's a single object (current buggy behavior)
        echo "ID: " . $enderecos->getId() . "\n";
        echo "Nome: " . $enderecos->getNome() . "\n";
        echo "Rua: " . $enderecos->getRua() . "\n";
        echo "Cidade: " . $enderecos->getCidade() . "\n";
        echo "Estado: " . $enderecos->getEstado() . "\n";
        echo "CEP: " . $enderecos->getCep() . "\n";
        echo "Número: " . $enderecos->getNumb() . "\n";
    }
}

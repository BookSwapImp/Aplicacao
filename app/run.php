<?php

use function PHPSTORM_META\type;

require_once(__DIR__."/dao/EnderecoDAO.php");

$EnderecoDAO = new EnderecoDAO();
$enderecos = $EnderecoDAO->listEnderecosByUsuarioId(1);

// Análise do foreach atual - está correto!
echo "<h2>Análise do foreach atual:</h2>";
echo "<p>O foreach está corretamente implementado, iterando sobre os endereços e exibindo as propriedades.</p>";

// Teste do foreach atual
echo "<h3>Teste do foreach atual:</h3>";
if (empty($enderecos)) {
    echo "Nenhum endereço encontrado.";
} else {
    echo "Endereços encontrados:<br>";
    foreach ($enderecos as $e) {
        echo "ID: " . $e->getId() . "<br>";
        echo "Nome: " . $e->getNome() . "<br>";
        echo "Rua: " . $e->getRua() . "<br>";
        echo "Cidade: " . $e->getCidade() . "<br>";
        echo "Estado: " . $e->getEstado() . "<br>";
        echo "CEP: " . $e->getCep() . "<br>";
        echo "Número: " . $e->getNumb() . "<br>";
        echo "<hr>";
    }
}

// Exemplo com dois foreach aninhados
echo "<h2>Exemplo com dois foreach aninhados:</h2>";

// Simulando dados para demonstrar dois foreach
$usuarios = [
    ['id' => 1, 'nome' => 'João', 'enderecos' => $enderecos],
    ['id' => 2, 'nome' => 'Maria', 'enderecos' => $enderecos]
];

echo "<h3>Usuários e seus endereços:</h3>";
foreach ($usuarios as $usuario) {
    echo "<h4>Usuário: " . $usuario['nome'] . " (ID: " . $usuario['id'] . ")</h4>";
    
    foreach ($usuario['enderecos'] as $endereco) {
        echo "Endereço: " . $endereco->getRua() . ", " . $endereco->getCidade() . "<br>";
    }
    echo "<br>";
}

// Exemplo com índices
echo "<h2>Exemplo com índices:</h2>";
$contador = 0;
foreach ($usuarios as $indiceUsuario => $usuario) {
    echo "Usuário " . ($indiceUsuario + 1) . ": " . $usuario['nome'] . "<br>";
    
    foreach ($usuario['enderecos'] as $indiceEndereco => $endereco) {
        echo "  Endereço " . ($indiceEndereco + 1) . ": " . $endereco->getRua() . "<br>";
    }
    echo "<br>";
}

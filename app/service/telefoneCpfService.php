<?php
# Nome do arquivo: telefoneCpfService.php
# Objetivo: Serviço para validação de CPF e telefone brasileiro

require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class TelefoneCpfService {
    private $usuarioDAO;
    
    function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }
    
    /**
     * Valida um CPF brasileiro
     * @param string $cpf CPF a ser validado
     * @param int|null $idUsuario ID do usuário para ignorar na verificação de duplicidade (opcional)
     * @return array Array com mensagens de erro
     */
    public function validarCPF(string $cpf, ?int $idUsuario = null): array {
        $erros = [];
        
        if (!$cpf) {
            $erros[] = "O campo [CPF] é obrigatório.";
            return $erros;
        }
        
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Validações básicas
        if (strlen($cpf) != 11) {
            $erros[] = "O CPF deve ter 11 dígitos.";
            return $erros;
        }
        
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $erros[] = "O CPF é inválido.";
            return $erros;
        }
        
        // Validação dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $erros[] = "O CPF é inválido.";
                break;
            }
        }
        
        // Verifica duplicidade no banco
        if (empty($erros)) {
            $cpfInt = (int)$cpf;
            $usuarioExistente = $this->usuarioDAO->findByCpf($cpfInt);
            
            // Se encontrou um usuário e não é o mesmo que está sendo editado
            if ($usuarioExistente === false && ($idUsuario === null || $this->usuarioDAO->findById($idUsuario)->getCpf() != $cpfInt)) {
                $erros[] = "Este CPF já está cadastrado no sistema.";
            }
        }
        
        return $erros;
    }
    
    /**
     * Valida um telefone brasileiro
     * @param string $telefone Telefone a ser validado
     * @param int|null $idUsuario ID do usuário para ignorar na verificação de duplicidade (opcional)
     * @return array Array com mensagens de erro
     */
    public function validarTelefone(string $telefone, ?int $idUsuario = null): array {
        $erros = [];
        
        if (!$telefone) {
            return $erros; // Telefone é opcional
        }
        
        // Remove todos os caracteres não numéricos
        $telefoneLimpo = preg_replace('/[^0-9]/', '', $telefone);
        
        // Verifica se tem 10 ou 11 dígitos (com DDD)
        if (strlen($telefoneLimpo) < 10 || strlen($telefoneLimpo) > 11) {
            $erros[] = "O telefone deve ter 10 ou 11 dígitos (com DDD).";
            return $erros;
        }
        
        // Verifica DDD válido (11 a 99)
        $ddd = substr($telefoneLimpo, 0, 2);
        if ($ddd < 11 || $ddd > 99) {
            $erros[] = "DDD inválido.";
            return $erros;
        }
        
        // Verifica formato para celular (11 dígitos, 9º dígito = 9)
        if (strlen($telefoneLimpo) == 11) {
            if ($telefoneLimpo[2] != '9') {
                $erros[] = "Celular deve começar com 9 após o DDD.";
            }
        }
        // Verifica formato para fixo (10 dígitos)
        elseif (strlen($telefoneLimpo) == 10) {
            if (!in_array($telefoneLimpo[2], ['2','3','4','5','6','7','8','9'])) {
                $erros[] = "Telefone fixo deve ter formato válido.";
            }
        }
        
        // Verifica duplicidade no banco
        if (empty($erros)) {
            $telefoneInt = (int)$telefoneLimpo;
            $usuarioExistente = $this->usuarioDAO->findByTelefone($telefoneInt);
            
            // Se encontrou um usuário e não é o mesmo que está sendo editado
            if ($usuarioExistente === false && ($idUsuario === null || $this->usuarioDAO->findById($idUsuario)->getTelefone() != $telefoneInt)) {
                $erros[] = "Este telefone já está cadastrado no sistema.";
            }
        }
        
        return $erros;
    }
    
    /**
     * Formata um CPF para exibição
     * @param string $cpf CPF a ser formatado
     * @return string CPF formatado
     */
    public function formatarCPF(string $cpf): string {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11) {
            return $cpf;
        }
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
    
    /**
     * Formata um telefone para exibição
     * @param string $telefone Telefone a ser formatado
     * @return string Telefone formatado
     */
    public function formatarTelefone(string $telefone): string {
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        $len = strlen($telefone);
        
        if ($len == 11) {
            // Celular: (99) 99999-9999
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } elseif ($len == 10) {
            // Fixo: (99) 9999-9999
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        }
        
        return $telefone;
    }
}

<?php 
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

require_once(__DIR__ . "/enum/UsuarioPapel.php");

class Usuario implements JsonSerializable {

    private ?int $id;
    private ?string $nome;
    private ?string $email;
    private ?string $senha;
    private ?string $tipo;
    private ?string $status;
    private ?string $telefone;
    private ?string $cpf;

    public function jsonSerialize(): array
    {
        return array(
            "id" => $this->id,
            "nome" => $this->nome,
            "email" => $this->email
        );
    }



    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha(): ?string
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     */
    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     */
    public function setTelefone(?string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of cpf
     */
    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     */
    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }
}
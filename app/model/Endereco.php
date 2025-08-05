<?php
require_once(__DIR__."/Usuario.php");
class Endereco extends Usuario{
    private ?Int $id;
    private ?string $name;
    private ?string $rua;
    private ?string $cidade;
    private ?string $estado;
    private ?string $cep;
    private ?Usuario $idUsuario;

    

    /**
     * Get the value of id
     */
    public function getId(): ?Int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?Int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getEstado(): ? string
    {
        return $this->estado;
    }
    public function setEstado(?string $estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get the value of rua
     */
    public function getRua(): ?string
    {
        return $this->rua;
    }

    /**
     * Set the value of rua
     */
    public function setRua(?string $rua): self
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get the value of cidade
     */
    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     */
    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of cep
     */
    public function getCep(): ?string
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     */
    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }
    public function getIdUsuarioInt():? int
    {
        return $this->idUsuario ? $this->idUsuario->getId() : null;
    }   

    /**
     * Set the value of idUsuario
     */
    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
}
?>
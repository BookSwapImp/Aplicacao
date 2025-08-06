<?php
require_once(__DIR__."/Usuario.php");
class Endereco {
    private ?Int $id;
    private ?string $nome;
    private ?int $usuarios_id;
    private ?string $rua;
    private ?string $cidade;
    private ?string $cep;
    private ?string $estado;
    private ?int $numb;
    private ?string $main;

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
     * Get the value of usuarios_id
     */
    public function getUsuariosId(): ?int
    {
        return $this->usuarios_id;
    }

    /**
     * Set the value of usuarios_id
     */
    public function setUsuariosId(?int $usuarios_id): self
    {
        $this->usuarios_id = $usuarios_id;
        return $this;
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
     * Get the value of estado
     */
    public function getEstado(): ?string
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * Get the value of numb
     */
    public function getNumb(): ?int
    {
        return $this->numb;
    }

    /**
     * Set the value of numb
     */
    public function setNumb(?int $numb): self
    {
        $this->numb = $numb;
        return $this;
    }

    /**
     * Get the value of main
     */
    public function getMain(): ?string
    {
        return $this->main;
    }

    /**
     * Set the value of main
     */
    public function setMain(?string $main): self
    {
        $this->main = $main;
        return $this;
    }
}
?>

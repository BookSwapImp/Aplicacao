
<?php
require_once(__DIR__ . "/Usuario.php");
require_once(__DIR__ . "/Anuncio.php");

class Denuncia {

    private int $id;
    private string $descricao;
    private ?Anuncio $anuncio;
    private ?Usuario $usuarioReu;
    private ?Usuario $usuarioAcusador;


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of anuncio
     */
    public function getAnuncio(): ?Anuncio
    {
        return $this->anuncio;
    }

    /**
     * Set the value of anuncio
     */
    public function setAnuncio(?Anuncio $anuncio): self
    {
        $this->anuncio = $anuncio;

        return $this;
    }

    /**
     * Get the value of usuarioReu
     */
    public function getUsuarioReu(): ?Usuario
    {
        return $this->usuarioReu;
    }

    /**
     * Set the value of usuarioReu
     */
    public function setUsuarioReu(?Usuario $usuarioReu): self
    {
        $this->usuarioReu = $usuarioReu;

        return $this;
    }

    /**
     * Get the value of usuarioAcusador
     */
    public function getUsuarioAcusador(): ?Usuario
    {
        return $this->usuarioAcusador;
    }

    /**
     * Set the value of usuarioAcusador
     */
    public function setUsuarioAcusador(?Usuario $usuarioAcusador): self
    {
        $this->usuarioAcusador = $usuarioAcusador;

        return $this;
    }
}
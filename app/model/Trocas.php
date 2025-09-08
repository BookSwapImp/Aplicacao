<?php
require_once(__DIR__ . "/Usuario.php");
require_once(__DIR__ . "/Anuncios.php");
class Trocas {
    private ?int $id;
    private ?Anuncios $anuncios_id_oferta;
    private ?Usuario $usuarios_id_oferta;
    private ?Anuncios $anuncios_id_solicitador;
    private ?Usuario $usuarios_id_solicitador;
    private ?DateTime $data_troca;
    private ?string $sec_code;
      

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
     * Get the value of anuncios_id_oferta
     */
    public function getAnunciosIdOferta(): ?Anuncios
    {
        return $this->anuncios_id_oferta;
    }

    /**
     * Set the value of anuncios_id_oferta
     */
    public function setAnunciosIdOferta(?Anuncios $anuncios_id_oferta): self
    {
        $this->anuncios_id_oferta = $anuncios_id_oferta;

        return $this;
    }

    /**
     * Get the value of usuarios_id_oferta
     */
    public function getUsuariosIdOferta(): ?Usuario
    {
        return $this->usuarios_id_oferta;
    }

    /**
     * Set the value of usuarios_id_oferta
     */
    public function setUsuariosIdOferta(?Usuario $usuarios_id_oferta): self
    {
        $this->usuarios_id_oferta = $usuarios_id_oferta;

        return $this;
    }

    /**
     * Get the value of anuncios_id_solicitador
     */
    public function getAnunciosIdSolicitador(): ?Anuncios
    {
        return $this->anuncios_id_solicitador;
    }

    /**
     * Set the value of anuncios_id_solicitador
     */
    public function setAnunciosIdSolicitador(?Anuncios $anuncios_id_solicitador): self
    {
        $this->anuncios_id_solicitador = $anuncios_id_solicitador;

        return $this;
    }

    /**
     * Get the value of usuarios_id_solicitador
     */
    public function getUsuariosIdSolicitador(): ?Usuario
    {
        return $this->usuarios_id_solicitador;
    }

    /**
     * Set the value of usuarios_id_solicitador
     */
    public function setUsuariosIdSolicitador(?Usuario $usuarios_id_solicitador): self
    {
        $this->usuarios_id_solicitador = $usuarios_id_solicitador;

        return $this;
    }

    /**
     * Get the value of data_troca
     */
    public function getDataTroca(): ?DateTime
    {
        return $this->data_troca;
    }

    /**
     * Set the value of data_troca
     */
    public function setDataTroca(?DateTime $data_troca): self
    {
        $this->data_troca = $data_troca;

        return $this;
    }

    /**
     * Get the value of sec_code
     */
    public function getSecCode(): ?string
    {
        return $this->sec_code;
    }

    /**
     * Set the value of sec_code
     */
    public function setSecCode(?string $sec_code): self
    {
        $this->sec_code = $sec_code;

        return $this;
    }
}
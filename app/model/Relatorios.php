<?php

require_once(__DIR__."/Denuncia.php");

class Relatorios implements JsonSerializable {

    private ?int $id;
    private ?Denuncia $denuncia_id;
    private ?string $descrição;
    private ?string $tipo_de_denuncia;
    private ?string $status_denunciado;
    private ?string $relatorio_status;
    private ?DateTime $data;

    public function jsonSerialize(): array
    {
        return array(
            "id" => $this->id,
            "denuncia_id" => $this->denuncia_id,
            "descrição" => $this->descrição,
            "tipo_de_denuncia" => $this->tipo_de_denuncia,
            "status_denunciado" => $this->status_denunciado,
            "relatorio_status" => $this->relatorio_status,
            "data" => $this->data ? $this->data->format('Y-m-d H:i:s') : null
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
     * Get the value of denuncia_id
     */
    public function getDenunciaId(): ?Denuncia
    {
        return $this->denuncia_id;
    }

    /**
     * Set the value of denuncia_id
     */
    public function setDenunciaId(?Denuncia $denuncia_id): self
    {
        $this->denuncia_id = $denuncia_id;

        return $this;
    }

    /**
     * Get the value of descrição
     */
    public function getDescrição(): ?string
    {
        return $this->descrição;
    }

    /**
     * Set the value of descrição
     */
    public function setDescrição(?string $descrição): self
    {
        $this->descrição = $descrição;

        return $this;
    }

    /**
     * Get the value of tipo_de_denuncia
     */
    public function getTipoDeDenuncia(): ?string
    {
        return $this->tipo_de_denuncia;
    }

    /**
     * Set the value of tipo_de_denuncia
     */
    public function setTipoDeDenuncia(?string $tipo_de_denuncia): self
    {
        $this->tipo_de_denuncia = $tipo_de_denuncia;

        return $this;
    }

    /**
     * Get the value of status_denunciado
     */
    public function getStatusDenunciado(): ?string
    {
        return $this->status_denunciado;
    }

    /**
     * Set the value of status_denunciado
     */
    public function setStatusDenunciado(?string $status_denunciado): self
    {
        $this->status_denunciado = $status_denunciado;

        return $this;
    }

    /**
     * Get the value of relatorio_status
     */
    public function getRelatorioStatus(): ?string
    {
        return $this->relatorio_status;
    }

    /**
     * Set the value of relatorio_status
     */
    public function setRelatorioStatus(?string $relatorio_status): self
    {
        $this->relatorio_status = $relatorio_status;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData(): ?DateTime
    {
        return $this->data;
    }

    /**
     * Set the value of data
     */
    public function setData(?DateTime $data): self
    {
        $this->data = $data;

        return $this;
    }
}

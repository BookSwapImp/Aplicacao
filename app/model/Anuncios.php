<?php
require_once(__DIR__."/Usuario.php");

class Anuncios implements JsonSerializable {
    private ?int $id;
    private ?Usuario $usuario_id;
    private ?string $nome_livro;
    private ?string $imagem_livro;
    private ?string $descricao;
    private ?DateTime $data_publicacao;
    private ?string $status; // pode ser 'ativo', 'inativo' ou 'finalizado'
    private ?string $estado_con; // pode ser 'mal', 'medio' ou 'bom'


    
     public function jsonSerialize(): array
    {
        return array(
            "id" => $this->id,
            "nome" => $this->nome_livro,
            //"email" => $this->email
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
     * Get the value of usuario_id
     */
    public function getUsuarioId(): ?Usuario
    {
        return $this->usuario_id;
    }

    /**
     * Get the value of usuario_id as integer
     */
    public function getUsuarioIdInt(): ?int
    {
        return $this->usuario_id ? $this->usuario_id->getId() : null;
    }

    /**
     * Set the value of usuario_id
     */
    public function setUsuarioId(?Usuario $usuario_id): self
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Get the value of nome_livro
     */
    public function getNomeLivro(): ?string
    {
        return $this->nome_livro;
    }

    /**
     * Set the value of nome_livro
     */
    public function setNomeLivro(?string $nome_livro): self
    {
        $this->nome_livro = $nome_livro;

        return $this;
    }

    /**
     * Get the value of imagem_livro
     */
    public function getImagemLivro(): ?string
    {
        return $this->imagem_livro;
    }

    /**
     * Set the value of imagem_livro
     */
    public function setImagemLivro(?string $imagem_livro): self
    {
        $this->imagem_livro = $imagem_livro;

        return $this;
    }



    /**
     * Get the value of descricao
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of data_publicacao
     */
    public function getDataPublicacao(): ?DateTime
    {
        return $this->data_publicacao;
    }

    /**
     * Set the value of data_publicacao
     */
    public function setDataPublicacao(?DateTime $data_publicacao): self
    {
        $this->data_publicacao = $data_publicacao;

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
     * Get the value of estado_con
     */
    public function getEstadoCon(): ?string
    {
        return $this->estado_con;
    }

    /**
     * Set the value of estado_con
     */
    public function setEstadoCon(?string $estado_con): self
    {
        $this->estado_con = $estado_con;

        return $this;
    }
}
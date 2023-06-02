<?php

namespace App\Models;

class LikesModel
{
    /**
     *  @var int
     * */
    private $id;

    /**
     *  @var string
     * */
    private $id_usuario;

    /**
     *  @var int
     * */
    private $idPublicacao;

    /**
     *  @return int
     * */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string
     * @return LikesModel
     * */
    public function setId(string $id): LikesModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     * */
    public function getid_usuario(): string
    {
        return $this->id_usuario;
    }

    /**
     * @param string
     * @return LikesModel
     * */
    public function setid_usuario(string $id_usuario): LikesModel
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     *  @return int
     * */
    public function getIdPublish(): int
    {
        return $this->idPublicacao;
    }

    /**
     * @param string
     * @return LikesModel
     * */
    public function setIdPublish(string $idPublicacao): LikesModel
    {
        $this->idPublicacao = $idPublicacao;
        return $this;
    }
}

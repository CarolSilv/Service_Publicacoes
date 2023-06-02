<?php

namespace App\Models;

class PublishModel
{
    /**
     *  @var int
     * */
    private $id;

    /**
     *  @var string
     * */
    private $nome;


    /**
     *  @var string
     * */
    private $id_usuario;


    /**
     *  @var string
     * */
    private $texto;

    /**
     *  @var string
     * */
    private $foto;

    /**
     *  @var string
     * */
    private $motivo;

    /**
     *  @return int
     * */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string
     * @return PublishModel
     * */
    public function setId(string $id): PublishModel
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return string
     * */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string
     * @return PublishModel
     * */
    public function setNome(string $nome): PublishModel
    {
        $this->nome = $nome;
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
     * @return PublishModel
     * */
    public function setid_usuario(string $id_usuario): PublishModel
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return string
     * */
    public function getText(): string
    {
        return $this->texto;
    }

    /**
     * @param string
     * @return PublishModel
     * */
    public function setText(string $texto): PublishModel
    {
        $this->texto = $texto;
        return $this;
    }

    /**
     * @return string
     * */
    public function getFoto(): string
    {
        return $this->foto;
    }

    /**
     * @param string
     * @return PublishModel
     * */
    public function setFoto(string $foto): PublishModel
    {
        $this->foto = $foto;
        return $this;
    }

    /**
     * @return string
     * */
    public function getMotivo(): string
    {
        return $this->motivo;
    }

    /**
     * @param string
     * @return PublishModel
     * */
    public function setMotivo(string $motivo): PublishModel
    {
        $this->motivo = $motivo;
        return $this;
    }
}

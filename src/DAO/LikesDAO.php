<?php

namespace App\DAO;

namespace App\DAO;

use App\Models\LikesModel;

class LikesDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function likeInPubli(LikesModel $dadosLike): bool
    {
        $query = $this->pdo
        ->prepare(
            "INSERT INTO qualipoints.likes(
                id_publicacao, 
                id_usuario_like, 
                data_like)
                VALUES(
                :id_publicacao,
                :id_usuario_like, 
                NOW()
                );");
        return $query->execute([
            'id_publicacao' => $dadosLike
                ->getIdPublish(),
            'id_usuario_like' => $dadosLike
                ->getid_usuario()
        ]);
    }

    public function deslikeInPubli(LikesModel $dadosDeslike): bool
    {
        $query = $this->pdo
        ->prepare(
            "DELETE FROM qualipoints.likes 
            WHERE id_publicacao = :id_publicacao 
            AND id_usuario_like = :id_usuario_like;
            ");
        return $query->execute([
            'id_publicacao' => $dadosDeslike
                ->getIdPublish(),
            'id_usuario_like' => $dadosDeslike
                ->getid_usuario()
        ]);
    }
}
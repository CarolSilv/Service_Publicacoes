<?php

namespace App\UseCase\Likes;

use App\DAO\LikesDAO;
use App\Models\LikesModel;

abstract class LikePublish
{
    static public function execute(LikesModel $dadosLike)
    {
        $likeDAO = new LikesDAO();
        $likeDAO->likeInPubli($dadosLike);
        if (!$likeDAO)
        {
            return [
                "message"=>'Erro para atualizar no Banco de dados'
            ];
        }
        return  [
            'message' => "Like inserido com sucesso."
        ];
    }
}
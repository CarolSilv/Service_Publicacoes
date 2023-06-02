<?php

namespace App\UseCase\Likes;

use App\DAO\LikesDAO;
use App\Models\LikesModel;

abstract class DeslikePublish
{

    static public function execute(LikesModel $dadosLike)
    {
        $likeDAO = new LikesDAO();
        $likeDAO->likeInPubli($dadosLike);
        if (!$likeDAO)
        {
            return [
                "message"=>'Erro para deletar do Banco de dados'
            ];
        }
        return  [
            'message' => "Like deletado com sucesso."
        ];
    }
}
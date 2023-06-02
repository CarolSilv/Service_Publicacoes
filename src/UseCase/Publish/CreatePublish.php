<?php

namespace App\UseCase\Publish;

use App\DAO\PublishDAO;
use App\Models\PublishModel;

abstract class CreatePublish
{
    static public function execute(PublishModel $dadosPublicacao)
    {
        $publishDAO = new PublishDAO();
        $publishDAO->insertPublish($dadosPublicacao);
        if (!$publishDAO) 
        {
            return [
                "message:" => "Nao foi possivel inserir a publicacao."
            ];
        }
        return [
            "message:" => "Publicacao inserida com sucesso!"
        ];
    }
}

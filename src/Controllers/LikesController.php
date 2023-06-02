<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Functions\JwtUtil;
use App\Models\LikesModel;
use App\UseCase\Likes\DeslikePublish;
use App\UseCase\Likes\LikePublish;

final class LikesController
{
    public function likePublish(Request $request, Response $response, $args)
    {

        $idPublicacao = $args['idPublicacao'];
        $token = $request->getHeaders()['Authorization'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $id_usuario = $tokenDecoded["id_usuario"];
        $dadosLike = new LikesModel;
        $dadosLike->setid_usuario($id_usuario);
        $dadosLike->setIdPublish($idPublicacao);
        $execute = LikePublish::execute($dadosLike);
        return $response->withJson($execute);
    }

    public function deslikePublish(Request $request, Response $response, $args)
    {
        $idPublicacao = $args['idPublicacao'];
        $token = $request->getHeaders()['Authorization'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $id_usuario = $tokenDecoded["id_usuario"];
        $dadosDeslike = new LikesModel;
        $dadosDeslike->setid_usuario($id_usuario);
        $dadosDeslike->setIdPublish($idPublicacao);
        $execute = DeslikePublish::execute($dadosDeslike);
        return $response->withJson($execute);
    }
}

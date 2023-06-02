<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Functions\JwtUtil;
use App\DAO\PublishDAO;
use App\Models\PublishModel;
use App\UseCase\Publish\CreatePublish;
use App\Utils\CarregarImagem;

final class PublishController
{
    public function creatPublish(Request $request, Response $response)
    {
        $token = $request->getHeaders()['Authorization'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $nome = $tokenDecoded["NOME"];
        $id_usuario = $tokenDecoded["id_usuario"];
        $texto = $request->getParsedBody()["texto"];
        $imagemCarregada = $_FILES["imagem"] ?? false;
        $pasta = __DIR__ . "../../uploads/";
        $foto = CarregarImagem::carregarImagem($imagemCarregada, $pasta);
        $dadosPublicacao = new PublishModel;
        $dadosPublicacao->setNome($nome);
        $dadosPublicacao->setid_usuario($id_usuario);
        $dadosPublicacao->setFoto($foto);
        $dadosPublicacao->setText($texto);
        $execute = CreatePublish::execute($dadosPublicacao);
        return $response->withJson($execute);
    }

    public function deletedPublish(Request $request, Response $response, $args)
    {
        $id = $args['idPublicacao'];
        $token = $request->getHeaders()['Authorization'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $id_usuarioDeletou = $tokenDecoded["id_usuario"];
        $motivo = $request->getParsedBody()["motivo"];
        $publishDAO = new PublishDAO();
        $dadosPublicacao = new PublishModel;
        $dadosPublicacao->setid_usuario($id_usuarioDeletou);
        $dadosPublicacao->setMotivo($motivo);
        $dadosPublicacao->setId($id);
        $publishDAO->deletePublish($dadosPublicacao);
        $response = $response->withJson([
            'message' => "Publicação deletada com sucesso."
        ]);
        return $response;
    }

    public function updatePublish(Request $request, Response $response, $args)
    {
        //Verificar se quem vai atualizar a publicação é a pessoa que publicou ou o supervisor dela 
        $id = $args['idPublicacao'];
        $token = $request->getHeaders()['Authorization'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $id_usuario = $tokenDecoded["id_usuario"];
        $apelido = $tokenDecoded["APELIDO"];
        $publishDAO = new PublishDAO();
        $valida = $publishDAO->validateEdit($id, $id_usuario, $apelido);
        if (!$valida) {
            return $response->withJson([
                'message' => "Somente quem postou ou o supervisor pode editar esta publicação."
            ]);
        }
        $texto = $request->getParsedBody()["texto"];
        $dadosPublicacao = new PublishModel;
        $dadosPublicacao->setId($id);
        $dadosPublicacao->setid_usuario($id_usuario);
        $dadosPublicacao->setText($texto);
        $publishDAO->updatedPublish($dadosPublicacao);
        return $response->withJson([
            'message' => "Informações da publicação atualizadas com sucesso."
        ]);
    }

    public function getPublishs(Request $request, Response $response)
    {
        $publishDAO = new PublishDAO();
        $publicacoes = $publishDAO->getAllPublications();
        $response = $response->withJson($publicacoes);
        return $response;
    }

    public function getPublish(Request $request, Response $response, $args)
    {
        $id = $args['idPublicacao'];
        $publishDAO = new PublishDAO();
        $publicacao = $publishDAO->getPublication($id);
        $response = $response->withJson($publicacao);
        return $response;
    }
}

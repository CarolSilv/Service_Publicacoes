<?php

namespace App\DAO;

use App\Models\PublishModel;
use PDO;

class PublishDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validateEdit($idPublicacao, $id_usuario, $apelido)
    {
        $query = $this->pdo
        ->prepare("SELECT COUNT(*) as edit FROM qualipoints.publicacoes 
        WHERE id_publicacao = :id_publicacao
        AND id_usuario_publicou = :id_usuario;");
        $query->execute([
            'id_publicacao' => $idPublicacao,
            'id_usuario' => $id_usuario,
            'apelido' => $apelido
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0]['edit'] ?? 0;
    }

    public function insertPublish(PublishModel $dadosPublicacao): bool
    {
        $query = $this->pdo
            ->prepare(
                "INSERT INTO qualipoints.publicacoes(
                nome_publicou, 
                id_usuario_publicou, 
                foto, 
                texto)
                VALUES(
                :nome_publicou,
                :id_usuario_publicou, 
                :foto, 
                :texto
                );"
            );
        return $query->execute([
            'nome_publicou' => $dadosPublicacao
                ->getNome(),
            'id_usuario_publicou' => $dadosPublicacao
                ->getid_usuario(),
            'foto' => $dadosPublicacao
                ->getFoto(),
            'texto' => $dadosPublicacao
                ->getText()
        ]);
    }

    public function deletePublish(PublishModel $dadosPublicacao): bool
    {
        $query = $this->pdo
            ->prepare(
                "UPDATE qualipoints.publicacoes
            SET is_delete = 1,
            motivo_delete = :motivo_delete,
            data_delete = NOW(),
            id_usuario_deletou = :id_usuario_deletou
            WHERE id_publicacao = :id_publicacao;"
            );
        return $query->execute([
            'motivo_delete' => $dadosPublicacao
                ->getMotivo(),
            'id_usuario_deletou' => $dadosPublicacao
                ->getid_usuario(),
            'id_publicacao' => $dadosPublicacao
                ->getId()
        ]);
    }

    public function updatedPublish(PublishModel $dadosPublicacao)
    {
        $query = $this->pdo
            ->prepare(
                "UPDATE qualipoints.publicacoes
            SET foi_atualizado = 1,
            texto = :texto,
            data_atualizou = NOW(),
            id_usuario_atualizou = :id_usuario_atualizou
            WHERE id_publicacao = :id_publicacao;"
            );
        $query->execute([
            'texto' => $dadosPublicacao
                ->getText(),
            'id_usuario_atualizou' => $dadosPublicacao
                ->getid_usuario(),
            'id_publicacao' => $dadosPublicacao
                ->getId()
        ]);
    }

    public function getAllPublications()
    {
        $query = $this->pdo
            ->prepare(
                "SELECT pb.texto AS texto,
            pb.foto AS imagem,
            pb.data AS data_publi,
            COUNT(lk.id_like) AS quantidade_likes
            FROM qualipoints.publicacoes pb
            LEFT JOIN qualipoints.likes lk
            ON pb.id_publicacao = lk.id_publicacao 
            GROUP BY pb.id_publicacao"
            );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function getPublication($id)
    {
        $query = $this->pdo
            ->prepare(
            "SELECT pb.texto AS texto,
            pb.foto AS imagem,
            pb.data AS data_publi,
            COUNT(lk.id_like) AS quantidade_likes
            FROM qualipoints.publicacoes pb
            LEFT JOIN qualipoints.likes lk
            ON pb.id_publicacao = lk.id_publicacao 
            WHERE pb.id_publicacao = :id_publicacao;"
            );
        $query->execute([
            'id_publicacao' => $id
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }
}

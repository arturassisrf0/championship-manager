<?php

namespace App\Models;

use PDO;
use PDOException;

class CampeonatosModel
{
    public function buscarPorOrganizador(int $idOrganizador): array|false
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare(
                'SELECT id, nome, data_inicio, data_fim, status
                 FROM tb_campeonatos
                 WHERE id_organizador = :id_organizador
                 ORDER BY data_inicio DESC'
            );
            $stmt->execute([':id_organizador' => $idOrganizador]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar campeonatos: ' . $e->getMessage());
            return false;
        }
    }

    public function buscarPaginaPorOrganizador(int $idOrganizador, int $limite, int $offset, ?string $status = null): array|false
    {
        global $pdo;

        try {

            if ($status != null) {
                $stmt = $pdo->prepare(
                    'SELECT id, nome, data_inicio, data_fim, status
                 FROM tb_campeonatos
                 WHERE id_organizador = :id_organizador
                 AND status = :status
                 ORDER BY data_inicio DESC, id DESC
                 LIMIT :limite OFFSET :offset'
                );
                $stmt->bindValue(':id_organizador', $idOrganizador, PDO::PARAM_INT);
                $stmt->bindValue(':status', $status, PDO::PARAM_STR);
                $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $pdo->prepare(
                    'SELECT id, nome, data_inicio, data_fim, status
                 FROM tb_campeonatos
                 WHERE id_organizador = :id_organizador
                 ORDER BY data_inicio DESC, id DESC
                 LIMIT :limite OFFSET :offset'
                );
                $stmt->bindValue(':id_organizador', $idOrganizador, PDO::PARAM_INT);
                $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            error_log('Erro ao listar página de campeonatos: ' . $e->getMessage());
            return false;
        }
    }

    public function contarPorOrganizador(int $idOrganizador, ?string $status = null): int|false
    {
        global $pdo;

        try {
            if ($status != null) {
                $stmt = $pdo->prepare(
                    'SELECT COUNT(*) FROM tb_campeonatos WHERE id_organizador = :id_organizador AND status = :status'
                );
                $stmt->bindValue(':id_organizador', $idOrganizador, PDO::PARAM_INT);
                $stmt->bindValue(':status', $status, PDO::PARAM_STR);
                $stmt->execute();

                return (int) $stmt->fetchColumn();
            } else {
                $stmt = $pdo->prepare(
                    'SELECT COUNT(*) FROM tb_campeonatos WHERE id_organizador = :id_organizador'
                );
                $stmt->execute([':id_organizador' => $idOrganizador]);

                return (int) $stmt->fetchColumn();
            }
        } catch (PDOException $e) {
            error_log('Erro ao contar campeonatos do organizador: ' . $e->getMessage());
            return false;
        }
    }

    public function registrar(
        string $nome,
        string $dataInicio,
        ?string $dataFim,
        string $local,
        string $descricao,
        int $idOrganizador
    ): int|false {
        global $pdo;

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO tb_campeonatos (nome, data_inicio, data_fim, status, id_organizador, local, descricao)
                 VALUES (:nome, :data_inicio, :data_fim, 'PLANEJADO', :id_organizador, :local, :descricao)
                 RETURNING id"
            );
            $stmt->execute([
                ':nome' => $nome,
                ':data_inicio' => $dataInicio,
                ':data_fim' => $dataFim,
                ':id_organizador' => $idOrganizador,
                ':local' => $local,
                ':descricao' => $descricao,
            ]);

            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar campeonato: ' . $e->getMessage());
            return false;
        }
    }

    public function contarPorOrganizadorEStatus(int $idOrganizador, string $status): int|false
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare(
                'SELECT COUNT(*)
                 FROM tb_campeonatos
                 WHERE id_organizador = :id_organizador
                   AND status = :status'
            );
            $stmt->execute([
                ':id_organizador' => $idOrganizador,
                ':status' => $status,
            ]);
            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log('Erro ao contar campeonatos: ' . $e->getMessage());
            return false;
        }
    }

    public function iniciarCampeonatosNaData(int $idOrganizador, string $dataAtual): int|false
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare(
                "UPDATE tb_campeonatos
                 SET status = 'EM_ANDAMENTO'
                 WHERE id_organizador = :id_organizador
                   AND status = 'PLANEJADO'
                   AND data_inicio <= :data_atual"
            );
            $stmt->execute([
                ':id_organizador' => $idOrganizador,
                ':data_atual' => $dataAtual,
            ]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Erro ao iniciar campeonatos pela data: ' . $e->getMessage());
            return false;
        }
    }
}

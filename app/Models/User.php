<?php

namespace App\Models;

use PDO;
use PDOException;

class User
{

    public function BuscarPorId($id): array|false
    {

        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("erro ao listar usuarios: " . $e->getMessage());
            return false;
        }

    }

    public function BuscarPorEmail(string $email): array|false
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare('SELECT * FROM tb_usuarios WHERE email = :email');
            $stmt->execute([':email' => $email]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('erro ao buscar usuario: ' . $e->getMessage());
            return false;
        }
    }

    public function RegistrarUsuario(string $nome, string $email, string $senha): bool|string
    {
        global $pdo;

        try {
            $stmtCheck = $pdo->prepare('SELECT id FROM tb_usuarios WHERE email = :email');
            $stmtCheck->execute([':email' => $email]);

            if ($stmtCheck->fetchColumn() !== false) {
                return 'email_existente';
            }

            $stmt = $pdo->prepare(
                'INSERT INTO tb_usuarios (nome, email, senha) VALUES (:nome, :email, :senha)'
            );
            return $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ]);
        } catch (PDOException $e) {
            error_log('erro ao cadastrar usuario: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Gera um token de redefinição de senha para o e-mail.
     * Devolve o token em texto puro (vai no link do e-mail); no banco fica só o hash.
     * A validade (1 hora) é calculada pelo próprio banco para não depender do fuso do PHP.
     */
    public function CriarTokenReset(string $email): string|false
    {
        global $pdo;

        try {
            // apaga tokens antigos desse e-mail
            $pdo->prepare('DELETE FROM tb_password_resets WHERE email = :email')
                ->execute([':email' => $email]);

            $token = bin2hex(random_bytes(32));

            $stmt = $pdo->prepare(
                "INSERT INTO tb_password_resets (email, token_hash, expires_at)
                 VALUES (:email, :hash, NOW() + INTERVAL '1 hour')"
            );
            $stmt->execute([
                ':email' => $email,
                ':hash' => hash('sha256', $token),
            ]);

            return $token;
        } catch (PDOException $e) {
            error_log('erro ao criar token de reset: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Retorna o registro do token se ele existir, não tiver sido usado e não tiver expirado.
     */
    public function BuscarResetValido(string $token): array|false
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare(
                'SELECT * FROM tb_password_resets
                 WHERE token_hash = :hash AND used = FALSE AND expires_at > NOW()
                 LIMIT 1'
            );
            $stmt->execute([':hash' => hash('sha256', $token)]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('erro ao validar token de reset: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Troca a senha e marca os tokens do e-mail como usados (tudo ou nada).
     */
    public function AtualizarSenha(string $email, string $novaSenha): bool
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            $pdo->prepare('UPDATE tb_usuarios SET senha = :senha WHERE email = :email')
                ->execute([
                    ':senha' => password_hash($novaSenha, PASSWORD_DEFAULT),
                    ':email' => $email,
                ]);

            $pdo->prepare('UPDATE tb_password_resets SET used = TRUE WHERE email = :email')
                ->execute([':email' => $email]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log('erro ao atualizar senha: ' . $e->getMessage());
            return false;
        }
    }
}
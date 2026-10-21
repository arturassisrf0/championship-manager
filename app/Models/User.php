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
}
?>
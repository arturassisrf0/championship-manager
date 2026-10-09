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


}




?>
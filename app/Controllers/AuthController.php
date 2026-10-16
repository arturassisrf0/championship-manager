<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        session_start();
        $erro = $_SESSION['erro_login'] ?? null;
        unset($_SESSION['erro_login']);

        $this->view('auth/login', ['erro' => $erro]);
    }

    public function buscarPorId(string $id): void
    {
        $usuario = (new User())->BuscarPorId((int) $id);

        if (!$usuario) {
            http_response_code(404);
            echo 'Usuário não encontrado';
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($usuario);

    }

    public function login(): void
    {
        session_start();

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $usuario = (new User())->BuscarPorEmail($email);

        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            $_SESSION['erro_login'] = 'E-mail ou senha inválidos';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $usuario['id'];

        header('Location: /home');
        exit;
    }
}

?>
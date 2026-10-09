<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('auth/login');
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
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $usuario = (new User())->BuscarPorEmail($email);

        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            $this->view('auth/login', ['erro' => 'E-mail ou senha inválidos']);
            return;
        }

        session_start();
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $usuario['id'];

        header('Location: /home');
        exit;
    }
}

?>
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
        $sucesso = $_SESSION['sucesso_registro'] ?? null;
        unset($_SESSION['erro_login']);
        unset($_SESSION['sucesso_registro']);

        $this->view('auth/login', ['erro' => $erro, 'sucesso' => $sucesso]);
    }

    public function showRegister(): void
    {
        session_start();
        $erro = $_SESSION['erro_registro'] ?? null;
        unset($_SESSION['erro_registro']);
        $this->view('auth/register', ['erro' => $erro]);
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

    public function register(): void
    {
        session_start();

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($nome === '' || strlen($nome) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)
            || strlen($email) > 255 || strlen($senha) < 8) {
            $_SESSION['erro_registro'] = 'Informe um nome e e-mail válidos e uma senha com pelo menos 6 caracteres.';
            header('Location: ' . BASE_URL . '/register');
            exit;
        }

        $resultado = (new User())->RegistrarUsuario($nome, $email, $senha);

        if ($resultado === 'email_existente') {
            $_SESSION['erro_registro'] = 'Já existe uma conta cadastrada com esse e-mail.';
            header('Location: ' . BASE_URL . '/register');
            exit;
        }

        if (!$resultado) {
            $_SESSION['erro_registro'] = 'Não foi possível criar sua conta. Tente novamente.';
            header('Location: ' . BASE_URL . '/register');
            exit;
        }

        $_SESSION['sucesso_registro'] = 'Conta criada com sucesso. Faça login para continuar.';
        header('Location: ' . BASE_URL . '/login');
        exit;
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
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Mailer;

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
        $this->exigirLogin();

        $usuario = (new User())->BuscarPorId((int) $id);

        if (!$usuario) {
            http_response_code(404);
            echo 'Usuário não encontrado';
            return;
        }

        unset($usuario['senha']);

        header('Content-Type: application/json');
        echo json_encode($usuario);
    }

    public function register(): void
    {
        session_start();

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (
            $nome === '' || strlen($nome) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)
            || strlen($email) > 255 || strlen($senha) < 8
        ) {
            $_SESSION['erro_registro'] = 'Informe um nome e e-mail válidos e uma senha com pelo menos 8 caracteres.';
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
        $_SESSION['autenticado'] = true;

        header('Location: ' . BASE_URL . '/home');
        exit;
    }

    public function forgotForm(): void
    {
        session_start();
        $erro = $_SESSION['erro_forgot'] ?? null;
        $sucesso = $_SESSION['sucesso_forgot'] ?? null;
        unset($_SESSION['erro_forgot'], $_SESSION['sucesso_forgot']);

        $this->view('auth/forgot', ['erro' => $erro, 'sucesso' => $sucesso]);
    }

    public function forgotSend(): void
    {
        session_start();
        $email = trim($_POST['email'] ?? '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['erro_forgot'] = 'Informe um e-mail válido.';
            header('Location: ' . BASE_URL . '/esqueci-senha');
            exit;
        }

        $userModel = new User();
        if ($userModel->BuscarPorEmail($email)) {
            $token = $userModel->CriarTokenReset($email);

            if ($token !== false) {
                $link = $this->urlBase() . '/redefinir-senha?token=' . $token;
                (new Mailer())->sendPasswordReset($email, $link);
            }
        }

        // Mensagem igual, exista o e-mail ou não
        $_SESSION['sucesso_forgot'] = 'Se o e-mail estiver cadastrado, enviamos um link de redefinição. (verifique a caixa de Spam)';
        header('Location: ' . BASE_URL . '/esqueci-senha');
        exit;
    }

    public function resetForm(): void
    {
        session_start();
        $token = $_GET['token'] ?? '';

        if (!(new User())->BuscarResetValido($token)) {
            $_SESSION['erro_login'] = 'Link inválido ou expirado.';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $erro = $_SESSION['erro_reset'] ?? null;
        unset($_SESSION['erro_reset']);

        $this->view('auth/reset', ['token' => $token, 'erro' => $erro]);
    }

    public function resetSave(): void
    {
        session_start();
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirm'] ?? '';

        $userModel = new User();
        $reset = $userModel->BuscarResetValido($token);

        if (!$reset) {
            $_SESSION['erro_login'] = 'Link inválido ou expirado.';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (strlen($password) < 8 || $password !== $confirm) {
            $_SESSION['erro_reset'] = 'A senha precisa ter 8+ caracteres e as duas devem ser iguais.';
            header('Location: ' . BASE_URL . '/redefinir-senha?token=' . urlencode($token));
            exit;
        }

        $userModel->AtualizarSenha($reset['email'], $password);
        $_SESSION['sucesso_registro'] = 'Senha alterada! Faça login.';
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    private function urlBase(): string
    {
        $esquema = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        return $esquema . '://' . $_SERVER['HTTP_HOST'] . BASE_URL;
    }

    public function logout(): void
    {
        session_start();
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }

        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}

?>

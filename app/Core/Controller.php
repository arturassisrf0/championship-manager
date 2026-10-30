<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $name, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/' . $name . '.php';
    }

    protected function exigirLogin(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
}
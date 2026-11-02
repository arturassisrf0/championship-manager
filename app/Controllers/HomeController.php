<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->exigirLogin();

        $userModel = new User();

        $usuario_id = $_SESSION['usuario_id'];

        $usuario = $userModel->buscarPorId($usuario_id);

        $primeiraLetra = mb_substr($usuario['nome'], 0, 1, 'UTF-8');

        $this->view('home', [
            'usuario' => $usuario,
            'primeiraLetra' => $primeiraLetra
        ]);
    }
}
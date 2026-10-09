<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        session_start();

        if (empty($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit;
        }

        $this->view('home');
    }
}
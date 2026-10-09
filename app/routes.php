<?php
use App\Controllers\AuthController;
use App\Controllers\HomeController;

$router->get('/login', [AuthController::class, 'showLogin']);
$router->get('/', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/usuarios/{id}', [AuthController::class, 'buscarPorId']);
$router->get('/home', [HomeController::class, 'index']);

?>
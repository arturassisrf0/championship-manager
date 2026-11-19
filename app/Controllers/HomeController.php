<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CampeonatosModel;
use App\Models\User;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->exigirLogin();

        $usuarioId = (int) $_SESSION['usuario_id'];
        $usuario = (new User())->buscarPorId($usuarioId);
        $campeonatosModel = new CampeonatosModel();
        $dataAtual = new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));

        $campeonatosModel->iniciarCampeonatosNaData(
            $usuarioId,
            $dataAtual->format('Y-m-d')
        );

        $this->view('home', [
            'usuario' => $usuario,
            'primeiraLetra' => mb_substr($usuario['nome'], 0, 1, 'UTF-8'),
            'emAndamento' => $campeonatosModel->contarPorOrganizadorEStatus($usuarioId, 'EM_ANDAMENTO') ?? 0,
            'planejados' => $campeonatosModel->contarPorOrganizadorEStatus($usuarioId, 'PLANEJADO') ?? 0,
            'finalizados' => $campeonatosModel->contarPorOrganizadorEStatus($usuarioId, 'FINALIZADO') ?? 0,
        ]);
    }
}

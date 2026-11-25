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

        $filtroUrl = $_GET['status'] ?? null;
        $lerFiltro = match ($filtroUrl) {
            'PLANEJADO', 'EM_ANDAMENTO', 'FINALIZADO' => $filtroUrl,
            default => null,
        };

        $usuarioId = (int) $_SESSION['usuario_id'];
        $usuario = (new User())->buscarPorId($usuarioId);
        $campeonatosModel = new CampeonatosModel();
        $dataAtual = new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));

        $campeonatosModel->iniciarCampeonatosNaData(
            $usuarioId,
            $dataAtual->format('Y-m-d')
        );

        $porPagina = 10;
        $paginaSolicitada = filter_var($_GET['pagina'] ?? 1, FILTER_VALIDATE_INT);
        $paginaAtual = ($paginaSolicitada !== false && $paginaSolicitada > 0)
            ? $paginaSolicitada
            : 1;
        $totalCampeonatos = $campeonatosModel->contarPorOrganizador($usuarioId, $lerFiltro);

        if ($totalCampeonatos === false) {
            $campeonatos = false;
            $totalPaginas = 0;
            $paginaAtual = 1;
        } else {
            $totalPaginas = (int) ceil($totalCampeonatos / $porPagina);
            $paginaAtual = min($paginaAtual, max(1, $totalPaginas));
            $offset = ($paginaAtual - 1) * $porPagina;
            $campeonatos = $campeonatosModel->buscarPaginaPorOrganizador(
                $usuarioId,
                $porPagina,
                $offset,
                $lerFiltro
            );
        }


        $this->view('home', [
            'usuario' => $usuario,
            'primeiraLetra' => mb_substr($usuario['nome'], 0, 1, 'UTF-8'),
            'emAndamento' => $campeonatosModel->contarPorOrganizadorEStatus($usuarioId, 'EM_ANDAMENTO') ?? 0,
            'planejados' => $campeonatosModel->contarPorOrganizadorEStatus($usuarioId, 'PLANEJADO') ?? 0,
            'finalizados' => $campeonatosModel->contarPorOrganizadorEStatus($usuarioId, 'FINALIZADO') ?? 0,
            'campeonatos' => $campeonatos,
            'statusFiltro' => $lerFiltro,
            'paginaAtual' => $paginaAtual,
            'totalPaginas' => $totalPaginas,
        ]);
    }
}

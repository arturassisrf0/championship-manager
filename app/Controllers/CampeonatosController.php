<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CampeonatosModel;
use App\Models\User;

class CampeonatosController extends Controller
{
    public function showCreate(): void
    {
        $this->exigirLogin();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $this->renderForm();
    }

    public function create(): void
    {
        $this->exigirLogin();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_POST['csrf_token'] ?? '';
        if (!is_string($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            $_SESSION['erro_campeonato'] = 'Sessão expirada. Confira os dados e tente novamente.';
            header('Location: ' . BASE_URL . '/registrar-campeonato');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');
        $dataInicio = $_POST['data_inicio'] ?? '';
        $dataFim = trim($_POST['data_fim'] ?? '');
        $local = trim($_POST['local'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        $_SESSION['dados_campeonato'] = [
            'nome' => $nome,
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim,
            'local' => $local,
            'descricao' => $descricao,
        ];

        $inicioValido = $this->dataValida($dataInicio);
        $fimValido = $dataFim === '' || $this->dataValida($dataFim);

        if (
            $nome === '' || mb_strlen($nome, 'UTF-8') > 255
            || mb_strlen($local, 'UTF-8') > 255 || mb_strlen($descricao, 'UTF-8') > 10000
            || !$inicioValido || !$fimValido
        ) {
            $_SESSION['erro_campeonato'] = 'Confira o nome, o local, a descrição e as datas informadas.';
            header('Location: ' . BASE_URL . '/registrar-campeonato');
            exit;
        }

        if ($dataFim !== '' && $dataFim < $dataInicio) {
            $_SESSION['erro_campeonato'] = 'A data de término não pode ser anterior à data de início.';
            header('Location: ' . BASE_URL . '/registrar-campeonato');
            exit;
        }

        $id = (new CampeonatosModel())->registrar(
            $nome,
            $dataInicio,
            $dataFim !== '' ? $dataFim : null,
            $local,
            $descricao,
            (int) $_SESSION['usuario_id']
        );

        if ($id === false) {
            $_SESSION['erro_campeonato'] = 'Não foi possível criar o campeonato. Tente novamente.';
            header('Location: ' . BASE_URL . '/registrar-campeonato');
            exit;
        }

        unset($_SESSION['dados_campeonato']);
        $_SESSION['sucesso_campeonato'] = 'Campeonato criado com sucesso.';
        header('Location: ' . BASE_URL . '/registrar-campeonato');
        exit;
    }

    private function renderForm(): void
    {
        $erro = $_SESSION['erro_campeonato'] ?? null;
        $sucesso = $_SESSION['sucesso_campeonato'] ?? null;
        $dados = $_SESSION['dados_campeonato'] ?? [];
        unset($_SESSION['erro_campeonato'], $_SESSION['sucesso_campeonato'], $_SESSION['dados_campeonato']);

        $usuario = (new User())->buscarPorId((int) $_SESSION['usuario_id']);
        $primeiraLetra = $usuario ? mb_substr($usuario['nome'], 0, 1, 'UTF-8') : '';

        $this->view('layouts/FormRegistrarCampeonato', [
            'erro' => $erro,
            'sucesso' => $sucesso,
            'dados' => $dados,
            'csrfToken' => $_SESSION['csrf_token'],
            'usuario' => $usuario,
            'primeiraLetra' => $primeiraLetra,
        ]);
    }

    private function dataValida(mixed $data): bool
    {
        if (!is_string($data)) {
            return false;
        }

        $dataObjeto = \DateTimeImmutable::createFromFormat('!Y-m-d', $data);
        return $dataObjeto !== false && $dataObjeto->format('Y-m-d') === $data;
    }
}

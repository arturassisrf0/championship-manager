<?php if ($campeonatos === false): ?>
    <div class="alert alert-danger" role="alert">
        Não foi possível carregar seus campeonatos. Tente novamente mais tarde.
    </div>
<?php elseif ($campeonatos === []): ?>
    <?php
    $mensagemVazia = match ($statusFiltro) {
        'PLANEJADO' => 'Você ainda não tem nenhum campeonato planejado.',
        'EM_ANDAMENTO' => 'Você ainda não tem nenhum campeonato em andamento.',
        'FINALIZADO' => 'Você ainda não tem nenhum campeonato finalizado.',
        default => 'Você ainda não cadastrou campeonatos.',
    };
    ?>
    <div class="alert alert-info" role="status">
        <?= htmlspecialchars($mensagemVazia, ENT_QUOTES, 'UTF-8') ?>
        <?php if ($statusFiltro === null): ?>
            <a href="<?= BASE_URL ?>/registrar-campeonato">Criar campeonato</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/home">Ver todos</a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <?php foreach ($campeonatos as $campeonato): ?>
        <?php
        $statusInfo = match ($campeonato['status']) {
            'PLANEJADO' => ['Planejado', 'planejado'],
            'EM_ANDAMENTO' => ['Em andamento', 'andamento'],
            'FINALIZADO' => ['Finalizado', 'finalizado'],
            default => [$campeonato['status'], 'planejado'],
        };
        $dataInicio = (new DateTimeImmutable($campeonato['data_inicio']))->format('d/m/Y');
        $dataFim = $campeonato['data_fim']
            ? (new DateTimeImmutable($campeonato['data_fim']))->format('d/m/Y')
            : 'sem data de término';
        ?>
        <article class="camp camp-<?= htmlspecialchars($statusInfo[1], ENT_QUOTES, 'UTF-8') ?>">
            <div class="d-flex justify-content-between align-items-start gap-2">
                <div class="min-w-0">
                    <span class="badge-status badge-<?= htmlspecialchars($statusInfo[1], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($statusInfo[0], ENT_QUOTES, 'UTF-8') ?>
                    </span>
                    <h2 class="camp-nome mt-2 mb-1">
                        <?= htmlspecialchars($campeonato['nome'], ENT_QUOTES, 'UTF-8') ?>
                    </h2>
                    <p class="camp-periodo mb-0">
                        <i class="bi bi-calendar3 me-1" aria-hidden="true"></i>
                        <?= htmlspecialchars($dataInicio, ENT_QUOTES, 'UTF-8') ?> até
                        <?= htmlspecialchars($dataFim, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($totalPaginas > 1): ?>
    <nav class="mt-3" aria-label="Paginação dos campeonatos">
        <ul class="pagination justify-content-center mb-0">
            <?php if ($paginaAtual > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL ?>/home?pagina=<?= $paginaAtual - 1 ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <?php
            $inicioPaginas = max(1, $paginaAtual - 2);
            $fimPaginas = min($totalPaginas, $paginaAtual + 2);
            for ($pagina = $inicioPaginas; $pagina <= $fimPaginas; $pagina++):
            ?>
                <li class="page-item <?= $pagina === $paginaAtual ? 'active' : '' ?>">
                    <a class="page-link" href="<?= BASE_URL ?>/home?pagina=<?= $pagina ?>"
                        <?= $pagina === $paginaAtual ? 'aria-current="page"' : '' ?>>
                        <?= $pagina ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($paginaAtual < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL ?>/home?pagina=<?= $paginaAtual + 1 ?>">Próxima</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>

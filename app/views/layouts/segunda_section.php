<div class="toolbar d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
    <div class="btn-group filtros" role="group" aria-label="Filtros por status">
        <a class="btn btn-filtro <?= $statusFiltro === null ? 'active' : '' ?>"
            href="<?= BASE_URL ?>/home" <?= $statusFiltro === null ? 'aria-current="page"' : '' ?>>Todos</a>
        <a class="btn btn-filtro <?= $statusFiltro === 'EM_ANDAMENTO' ? 'active' : '' ?>"
            href="<?= BASE_URL ?>/home?status=EM_ANDAMENTO" <?= $statusFiltro === 'EM_ANDAMENTO' ? 'aria-current="page"' : '' ?>>Em andamento</a>
        <a class="btn btn-filtro <?= $statusFiltro === 'PLANEJADO' ? 'active' : '' ?>"
            href="<?= BASE_URL ?>/home?status=PLANEJADO" <?= $statusFiltro === 'PLANEJADO' ? 'aria-current="page"' : '' ?>>Planejados</a>
        <a class="btn btn-filtro <?= $statusFiltro === 'FINALIZADO' ? 'active' : '' ?>"
            href="<?= BASE_URL ?>/home?status=FINALIZADO" <?= $statusFiltro === 'FINALIZADO' ? 'aria-current="page"' : '' ?>>Finalizados</a>
    </div>
    <form class="search" action="<?= BASE_URL ?>/home" method="get" role="search">
        <?php if ($statusFiltro !== null): ?>
            <input type="hidden" name="status" value="<?= htmlspecialchars($statusFiltro, ENT_QUOTES, 'UTF-8') ?>">
        <?php endif; ?>
        <div class="search__field">
            <i class="bi bi-search" aria-hidden="true"></i>
            <input type="search" name="busca" class="form-control" placeholder="Buscar por nome"
                aria-label="Buscar campeonato pelo nome"
                value="<?= htmlspecialchars($termoBusca, ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <button class="btn btn-accent" type="submit">Buscar</button>
    </form>
</div>

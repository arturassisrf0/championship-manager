<div class="toolbar d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
    <div class="btn-group filtros" role="group" aria-label="Filtros ilustrativos por status">
        <a class="btn btn-filtro" href="<?= BASE_URL ?>/home">Todos</a>
        <a class="btn btn-filtro" href="<?= BASE_URL ?>/home?status=EM_ANDAMENTO">Em andamento</a>
        <a class="btn btn-filtro" href="<?= BASE_URL ?>/home?status=PLANEJADO">Planejados</a>
        <a class="btn btn-filtro" href="<?= BASE_URL ?>/home?status=FINALIZADO">Finalizados</a>
    </div>
    <div class="search">
        <i class="bi bi-search"></i>
        <input type="search" class="form-control" placeholder="Buscar por nome"
            aria-label="Busca ilustrativa por campeonato">
    </div>
</div>
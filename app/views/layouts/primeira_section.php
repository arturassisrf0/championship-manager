<div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
    <div>
        <p class="greeting mb-1">Olá, <?= htmlspecialchars($usuario['nome']) ?></p>
        <h1 class="page-title mb-0">Meus campeonatos</h1>
    </div>
    <a href="<?= BASE_URL ?>/registrar-campeonato" class="btn btn-accent btn-lg">
        <i class="bi bi-plus-lg me-1"></i>Novo campeonato
    </a>
</div>

<dl class="summary mb-4">
    <div>
        <dt>Em andamento</dt>
        <dd><?= (int) $emAndamento ?></dd>
    </div>
    <div>
        <dt>Planejados</dt>
        <dd><?= (int) $planejados ?></dd>
    </div>
    <div>
        <dt>Finalizados</dt>
        <dd><?= (int) $finalizados ?></dd>
    </div>
</dl>

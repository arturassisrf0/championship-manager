<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus campeonatos · 1-2 Campeonatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Barlow+Semi+Condensed:ital,wght@0,600;0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/home.css">
</head>

<body class="bg-home">
    <header class="topbar">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="#" class="d-flex align-items-center text-decoration-none">
                <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos4.webp" alt="1-2 Campeonatos" class="topbar-logo">
            </a>

            <div class="user-btn">
                <span class="avatar" aria-hidden="true">O</span>
                <span class="d-none d-sm-inline">Organizador</span>
            </div>
        </div>
    </header>

    <main class="container py-4 py-lg-5">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <p class="greeting mb-1">Olá, Organizador</p>
                <h1 class="page-title mb-0">Meus campeonatos</h1>
            </div>
            <button type="button" class="btn btn-accent btn-lg">
                <i class="bi bi-plus-lg me-1"></i>Novo campeonato
            </button>
        </div>

        <dl class="summary mb-4">
            <div>
                <dt>Em andamento</dt>
                <dd>1</dd>
            </div>
            <div>
                <dt>Times cadastrados</dt>
                <dd>12</dd>
            </div>
            <div>
                <dt>Partidas finalizadas</dt>
                <dd>8</dd>
            </div>
        </dl>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="toolbar d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
                    <div class="btn-group filtros" role="group" aria-label="Filtros ilustrativos por status">
                        <button type="button" class="btn btn-filtro active">Todos</button>
                        <button type="button" class="btn btn-filtro">Em andamento</button>
                        <button type="button" class="btn btn-filtro">Planejados</button>
                        <button type="button" class="btn btn-filtro">Finalizados</button>
                    </div>
                    <div class="search">
                        <i class="bi bi-search"></i>
                        <input type="search" class="form-control" placeholder="Buscar por nome" aria-label="Busca ilustrativa por campeonato">
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <article class="camp camp-andamento">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div class="min-w-0">
                                <span class="badge-status badge-andamento">Em andamento</span>
                                <h2 class="camp-nome mt-2 mb-1">Copa Ralth 2026</h2>
                                <p class="camp-periodo mb-0"><i class="bi bi-calendar3 me-1"></i>10/10/2026 até 20/12/2026</p>
                            </div>
                            <button type="button" class="btn btn-icon" aria-label="Mais ações">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                        </div>

                        <div class="camp-meta">
                            <span><i class="bi bi-people me-1"></i>8 times</span>
                            <span><i class="bi bi-flag me-1"></i>8 de 15 partidas</span>
                        </div>

                        <div class="progress camp-progress" role="progressbar" aria-label="Partidas finalizadas" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 53%"></div>
                        </div>

                        <div class="camp-acoes">
                            <button type="button" class="btn btn-primary btn-sm">Gerenciar</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm">Times</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm">Partidas</button>
                        </div>
                    </article>

                    <article class="camp camp-planejado">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div class="min-w-0">
                                <span class="badge-status badge-planejado">Planejado</span>
                                <h2 class="camp-nome mt-2 mb-1">Torneio de Inverno</h2>
                                <p class="camp-periodo mb-0"><i class="bi bi-calendar3 me-1"></i>15/01/2027 · sem data de término</p>
                            </div>
                            <button type="button" class="btn btn-icon" aria-label="Mais ações">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                        </div>

                        <div class="camp-meta">
                            <span><i class="bi bi-people me-1"></i>4 times</span>
                            <span><i class="bi bi-flag me-1"></i>0 de 6 partidas</span>
                        </div>

                        <div class="camp-acoes">
                            <button type="button" class="btn btn-primary btn-sm">Gerenciar</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm">Times</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm">Partidas</button>
                        </div>
                    </article>
                </div>
            </div>

            <aside class="col-lg-4">
                <section class="painel">
                    <h2 class="painel-titulo">Próximas partidas</h2>
                    <ul class="list-unstyled mb-0">
                        <li class="jogo">
                            <time class="jogo-data" datetime="2026-10-20T19:30">20/10<br><small>19:30</small></time>
                            <div>
                                <p class="jogo-times mb-0">Time 1 <span>x</span> Time 2</p>
                                <p class="jogo-camp mb-0">Copa Society 2026</p>
                            </div>
                        </li>
                        <li class="jogo">
                            <time class="jogo-data" datetime="2026-10-22T20:00">22/10<br><small>20:00</small></time>
                            <div>
                                <p class="jogo-times mb-0">Atlético <span>x</span> Vasco</p>
                                <p class="jogo-camp mb-0">Copa Society 2026</p>
                            </div>
                        </li>
                    </ul>
                </section>

                <section class="painel mt-4">
                    <h2 class="painel-titulo">Como começar</h2>
                    <ol class="passos mb-0">
                        <li>Crie o campeonato com nome e datas.</li>
                        <li>Cadastre os times e os atletas.</li>
                        <li>Monte as rodadas e as partidas.</li>
                        <li>Registre gols e cartões durante os jogos.</li>
                    </ol>
                </section>
            </aside>
        </div>
    </main>
</body>

</html>

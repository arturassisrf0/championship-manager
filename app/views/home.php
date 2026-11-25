<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Barlow+Semi+Condensed:ital,wght@0,600;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/home.css">
</head>

<body class="bg-home">

    <?php
    require('layouts/navbar.php');
    ?>

    <main class="container py-4 py-lg-5">
        <?php
        require('layouts/primeira_section.php')
            ?>

        <div class="row g-4">
            <div class="col-lg-8">
                <?php require('layouts/segunda_section.php') ?>

                <div class="d-grid gap-3">
                    <?php require('layouts/terceira_section.php') ?>
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
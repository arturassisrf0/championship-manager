<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <header class="topbar">
        <div class="container d-flex align-items-center justify-content-between">
            <!--<a href="#" class="d-flex align-items-center text-decoration-none">
                <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos4.webp" alt="1-2 Campeonatos"
                    class="topbar-logo">
            </a>-->

            <div class="user-btn">
                <span class="avatar" aria-hidden="true"><?= htmlspecialchars($primeiraLetra)?></span>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($usuario['nome'])?></span>
            </div>

            <form action="<?= BASE_URL ?>/logout" method="post">
                <button type="submit" class="btn btn-outline-danger">Sair</button>
            </form>
        </div>
    </header>
</html>
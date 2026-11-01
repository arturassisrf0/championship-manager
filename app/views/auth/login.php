<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Acesse a plataforma 1-2 Campeonatos e gerencie tabelas, jogos e resultados.">
    <title>Entrar | 1-2 Campeonatos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Barlow+Semi+Condensed:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css">

</head>

<body>

    <a class="visually-hidden-focusable position-absolute p-2 bg-white" href="#login-form">Ir para o formulário de login</a>

    <main class="min-vh-100 d-flex align-items-center justify-content-center p-3 p-md-4">
        <section class="login-card card w-100 flex-lg-row" aria-labelledby="login-title">

            <aside class="brand-panel d-none d-lg-flex flex-column justify-content-center text-center col-lg-6">
                <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos3.webP" alt="1-2 Campeonatos" class="brand-logo mb-4">
                <p class="brand-headline brand-name">Do sorteio à final, tudo em um só lugar.</p>
                <p class="lead-text mb-0">Monte tabelas, registre resultados e acompanhe a classificação em tempo real.</p>
            </aside>

            <div class="col-lg-6 p-4 p-sm-5">
                <div class="mx-auto" style="max-width: 26rem;">

                    <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos3.webP" alt="1-2 Campeonatos" class="brand-logo brand-logo-mobile d-lg-none mb-4">

                    <h1 id="login-title" class="display-6 fw-bold mb-1">Pronto para entrar em campo?</h1>
                    <p class="text-secondary mb-4" style="color: var(--muted) !important;">Entre para gerenciar seus campeonatos.</p>

                    <?php if (!empty($erro)): ?>
                        <p class="alert alert-danger" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                    <?php if (!empty($sucesso)): ?>
                        <p class="alert alert-success" role="status"><?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>

                    <div id="form-alert" role="alert" aria-live="polite"></div>

                    <form id="login-form" action="<?= BASE_URL ?>/login" method="post" novalidate>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="field">
                                <i class="bi bi-envelope field-icon" aria-hidden="true"></i>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="voce@exemplo.com" autocomplete="email" required
                                    aria-describedby="email-feedback">
                                <div id="email-feedback" class="invalid-feedback">Informe um email válido, como nome@exemplo.com.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <div class="field">
                                <i class="bi bi-lock field-icon" aria-hidden="true"></i>
                                <input type="password" id="senha" name="senha" class="form-control has-toggle"
                                    placeholder="Digite sua senha" autocomplete="current-password" required
                                    aria-describedby="senha-feedback">
                                <button type="button" id="toggle-senha" class="btn-toggle"
                                    aria-label="Mostrar senha" aria-controls="senha" aria-pressed="false">
                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                </button>
                                <div id="senha-feedback" class="invalid-feedback">Digite sua senha para continuar.</div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="lembrar" name="lembrar" value="1">
                                <label class="form-check-label" for="lembrar">Lembrar-me</label>
                            </div>
                            <a href="/esqueci-senha" class="link-quiet fw-medium lh-base">Esqueci minha senha</a>
                        </div>

                        <button type="submit" id="btn-login" class="btn btn-accent btn-lg w-100">
                            <span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>
                            <span class="btn-label">Entrar</span>
                        </button>
                    </form>

                    <p class="text-center small mt-4 mb-0" style="color: var(--muted);">
                        Ainda não tem conta?
                        <a href="/register" class="link-quiet fw-semibold">Criar uma conta</a>
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/app.js"></script>
</body>

</html>

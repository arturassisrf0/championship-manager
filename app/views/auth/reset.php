<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Defina uma nova senha para sua conta 1-2 Campeonatos.">
    <title>Nova senha | 1-2 Campeonatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Barlow+Semi+Condensed:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css">
</head>
<body>
    <main class="min-vh-100 d-flex align-items-center justify-content-center p-3 p-md-4">
        <section class="login-card card w-100 flex-lg-row" aria-labelledby="reset-title">
            <aside class="brand-panel d-none d-lg-flex flex-column justify-content-center text-center col-lg-6">
                <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos3.webP" alt="1-2 Campeonatos" class="brand-logo mb-4">
                <p class="brand-headline brand-name">Quase pronto para voltar ao jogo.</p>
                <p class="lead-text mb-0">Escolha uma senha nova e segura para sua conta.</p>
            </aside>
            <div class="col-lg-6 p-4 p-sm-5">
                <div class="mx-auto" style="max-width: 26rem;">
                    <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos3.webP" alt="1-2 Campeonatos" class="brand-logo brand-logo-mobile d-lg-none mb-4">
                    <h1 id="reset-title" class="display-6 fw-bold mb-1">Criar nova senha</h1>
                    <p class="mb-4" style="color: var(--muted);">Use pelo menos 8 caracteres.</p>
                    <?php if (!empty($erro)): ?>
                        <p class="alert alert-danger" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                    <form action="<?= BASE_URL ?>/redefinir-senha" method="post">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
                        <div class="mb-3">
                            <label class="form-label" for="password">Nova senha</label>
                            <div class="field">
                                <i class="bi bi-lock field-icon" aria-hidden="true"></i>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Pelo menos 8 caracteres" autocomplete="new-password" required minlength="8">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="password_confirm">Confirmar senha</label>
                            <div class="field">
                                <i class="bi bi-lock field-icon" aria-hidden="true"></i>
                                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Digite a senha novamente" autocomplete="new-password" required minlength="8">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-accent btn-lg w-100">Salvar nova senha</button>
                    </form>
                    <p class="text-center small mt-4 mb-0"><a href="<?= BASE_URL ?>/login" class="link-quiet fw-semibold">Voltar ao login</a></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

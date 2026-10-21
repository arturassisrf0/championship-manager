<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css">
</head>

<body>
    <section class="vh-100 bg-login">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="<?= BASE_URL ?>/assets/img/logo-12campeonatos4.webP"
                        class="img-fluid rounded" alt="Logo 1-2 campeonatos">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h1 class="h2 mb-4">Criar conta</h1>
                    <p class="mb-4">Cadastre-se para organizar seus campeonatos.</p>

                    <form action="<?= BASE_URL ?>/register" method="post">
                        <?php if (isset($erro)): ?>
                            <p class="alert alert-danger login-alert" role="alert">
                                <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        <?php endif; ?>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control form-control-lg"
                                placeholder="Seu nome" autocomplete="name" maxlength="255" required>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                placeholder="voce@exemplo.com" autocomplete="email" maxlength="255" required>
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control form-control-lg"
                                placeholder="Pelo menos 6 caracteres" autocomplete="new-password"
                                minlength="6" required>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Criar conta
                            </button>
                            <p class="small fw-bold mt-3 mb-0">
                                Já tem uma conta?
                                <a href="<?= BASE_URL ?>/login" class="text-body">Entrar</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

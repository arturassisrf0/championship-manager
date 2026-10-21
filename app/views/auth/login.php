<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                    <form action="/login" method="post">
                        <?php if (isset($sucesso)): ?>
                            <p class="alert alert-success" role="status">
                                <?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        <?php endif; ?>

                        <?php if (isset($erro)): ?>
                            <p class="alert alert-danger login-alert" role="alert">
                                <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        <?php endif; ?>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
                                placeholder="Insira um endereço de email válido" required />
                            <label class="form-label" for="form3Example3">Email</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="senha" class="form-control form-control-lg"
                                placeholder="Insira a senha?" required />
                            <label class="form-label" for="form3Example4">Senha</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->

                            <a href="#" class="text-body">Esqueceu a senha?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Não possui um conta? <a href="/register"
                                    class="text-body">Registrar</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
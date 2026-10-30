<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="max-width: 420px; width: 100%;">
            <form action="<?= BASE_URL ?>/redefinir-senha" method="post">
                <h4 class="mb-3">Nova senha</h4>

                <?php if (!empty($erro)): ?>
                    <p class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>

                <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">

                <input type="password" name="password" class="form-control mb-3" placeholder="Nova senha (mín. 8 caracteres)"
                    required minlength="8">
                <input type="password" name="password_confirm" class="form-control mb-3" placeholder="Confirmar nova senha"
                    required minlength="8">

                <button type="submit" class="btn btn-primary w-100">Salvar nova senha</button>
            </form>
        </div>
    </div>

</body>

</html>
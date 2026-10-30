<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="max-width: 420px; width: 100%;">
            <form action="<?= BASE_URL ?>/esqueci-senha" method="post">
                <h4 class="mb-3">Recuperar senha</h4>
                <p class="text-muted">Informe seu e-mail e enviaremos um link para criar uma nova senha.</p>

                <?php if (!empty($sucesso)): ?>
                    <p class="alert alert-success" role="status">
                        <?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($erro)): ?>
                    <p class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>

                <input type="email" name="email" class="form-control mb-3" placeholder="Seu e-mail" required>
                <button type="submit" class="btn btn-primary w-100 mb-3">Enviar link</button>
                <a href="<?= BASE_URL ?>/login" class="text-body">Voltar ao login</a>
            </form>
        </div>
    </div>

</body>

</html>
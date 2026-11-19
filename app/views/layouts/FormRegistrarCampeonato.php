<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo campeonato | 1-2 Campeonatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Barlow+Semi+Condensed:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: #f3f6fb; color: #14233b; font-family: Barlow, system-ui, sans-serif; }
        .topbar { background: #032045; color: white; }
        .registration-card { max-width: 54rem; margin: 3rem auto; overflow: hidden; border: 1px solid #dde4ef; border-radius: 1rem; box-shadow: 0 1rem 2.5rem #0320451a; }
        .registration-header { padding: 1.5rem clamp(1.25rem, 4vw, 2rem); color: white; background: linear-gradient(130deg, #032045, #0b3e7b); border-bottom: 4px solid #ff6a00; }
        .registration-header h1 { margin: 0; font: italic 700 clamp(1.7rem, 4vw, 2.25rem) 'Barlow Semi Condensed', sans-serif; }
        .registration-body { padding: clamp(1.25rem, 4vw, 2rem); }
        .form-label { color: #263952; font-weight: 600; }
        .form-control { min-height: 2.9rem; border-color: #dde4ef; border-radius: .55rem; }
        .btn-accent { padding: .75rem 1.25rem; color: #fff; background: #ff6a00; border-color: #ff6a00; font-weight: 600; }
        .btn-accent:hover { color: #fff; background: #e85d00; border-color: #e85d00; }
    </style>
</head>
<body>
    <header class="topbar py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="text-white text-decoration-none fw-semibold" href="<?= BASE_URL ?>/home">1-2 Campeonatos</a>
            <div class="d-flex align-items-center gap-3">
                <?php if (!empty($usuario)): ?><span><?= htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
                <form action="<?= BASE_URL ?>/logout" method="post"><button class="btn btn-sm btn-outline-light" type="submit">Sair</button></form>
            </div>
        </div>
    </header>

    <main class="container px-3">
        <section class="registration-card bg-white" aria-labelledby="form-registro-title">
            <header class="registration-header">
                <p class="text-uppercase small mb-1 text-white-50"><i class="bi bi-trophy me-1" aria-hidden="true"></i>Organize uma competição</p>
                <h1 id="form-registro-title">Novo campeonato</h1>
                <p class="mb-0 mt-2 text-white-50">Informe o nome e as datas do torneio.</p>
            </header>

            <div class="registration-body">
                <?php if (!empty($erro)): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if (!empty($sucesso)): ?>
                    <div class="alert alert-success" role="status"><?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/registrar-campeonato" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                    <div class="mb-3">
                        <label class="form-label" for="registro-nome">Nome do campeonato</label>
                        <input class="form-control" type="text" id="registro-nome" name="nome" maxlength="255" required autofocus
                            value="<?= htmlspecialchars($dados['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Ex.: Copa de Verão">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="registro-local">Local <span class="fw-normal text-secondary">(opcional)</span></label>
                        <input class="form-control" type="text" id="registro-local" name="local" maxlength="255"
                            value="<?= htmlspecialchars($dados['local'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Ex.: Ginásio Municipal">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="registro-descricao">Descrição <span class="fw-normal text-secondary">(opcional)</span></label>
                        <textarea class="form-control" id="registro-descricao" name="descricao" rows="3" maxlength="10000"
                            placeholder="Conte um pouco sobre o campeonato"><?= htmlspecialchars($dados['descricao'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="registro-inicio">Data de início</label>
                            <input class="form-control" type="date" id="registro-inicio" name="data_inicio" required
                                value="<?= htmlspecialchars($dados['data_inicio'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="registro-fim">Data de término <span class="fw-normal text-secondary">(opcional)</span></label>
                            <input class="form-control" type="date" id="registro-fim" name="data_fim"
                                value="<?= htmlspecialchars($dados['data_fim'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    </div>

                    <p class="text-secondary small mt-3 mb-4">O campeonato será criado com status “Planejado”. Você poderá adicionar times depois.</p>
                    <div class="d-flex flex-wrap justify-content-between gap-2 border-top pt-3">
                        <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/home">Voltar</a>
                        <button class="btn btn-accent" type="submit"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Criar campeonato</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>

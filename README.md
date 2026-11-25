# Championship Manager

Sistema web em desenvolvimento para organizar campeonatos esportivos, com foco atual em futsal. A aplicação usa PHP, PostgreSQL e uma estrutura MVC simples, sem framework.

## Estado atual

### Implementado

- Roteamento HTTP básico para métodos GET e POST, com parâmetros de rota.
- Cadastro e autenticação de usuários. Senhas são armazenadas com `password_hash` e verificadas com `password_verify`.
- Sessão autenticada, logout e consulta de usuário por ID (rota protegida).
- Fluxo de redefinição de senha: geração de token, validade de uma hora, armazenamento do hash e envio de e-mail via SMTP/PHPMailer.
- Página inicial protegida e telas de login, cadastro, esqueci a senha e redefinição.
- Schema PostgreSQL para usuários, campeonatos, times, atletas, vínculos de atletas, rodadas, partidas e eventos de partida.
- Cadastro de campeonato com formulário, validação no servidor e proteção CSRF.
- Contadores reais de campeonatos planejados, em andamento e finalizados na home.
- Atualização de campeonatos planejados para em andamento quando a data de início chega e o organizador acessa a home.
- Lista de campeonatos do organizador na home, com paginação de até 10 itens por página.

### Em andamento / ainda não conectado

- O cadastro persiste nome, datas, local e descrição. Modalidade e formato ainda não fazem parte do schema nem do formulário.
- As partidas futuras e alguns dados de times/partidas exibidos na home ainda são exemplos estáticos.
- Gestão de times, atletas, rodadas, partidas, resultados e classificação ainda não está implementada nas telas/fluxos da aplicação.
- Implementar tempo de sessão
- Implementar codigo contra ataques de brute force

## Arquitetura e diretórios

```text
app/
  Controllers/   Controladores HTTP (AuthController, HomeController, CampeonatosController)
  Core/          Router, controller base, autenticação auxiliar e envio de e-mail
  Models/        Acesso a dados (User e CampeonatosModel)
  views/         Páginas PHP e fragmentos de layout
  routes.php     Mapeamento de rotas para controllers
config/          Conexão PostgreSQL e configuração SMTP local
database/        Schema SQL
public/          Front controller e assets públicos (CSS, JS, imagens)
```

O ponto de entrada é `public/index.php`. O `Router` despacha as rotas de `app/routes.php`; controllers chamam models e renderizam views por meio da classe base `App\Core\Controller`.

## Requisitos

- PHP compatível com os recursos usados pelo projeto (incluindo tipos union e `str_starts_with`; PHP 8+).
- Composer.
- PostgreSQL.
- Servidor web configurado para apontar o document root para `public/` e encaminhar URLs não existentes para `public/index.php`.

## Configuração local

1. Instale as dependências com `composer install`.
2. Copie `.env.example` para `.env` e preencha as configurações do banco e do SMTP. Para SMTP real, use credenciais próprias e mantenha o `.env` fora do Git.

3. Crie o banco e aplique `database/schema.sql` nele.
4. O envio de e-mail lê as variáveis `MAIL_*` do `.env`; não coloque credenciais em arquivos PHP versionados.
5. Inicie/configure o servidor web com `public/` como raiz pública. Em instalação sob um subdiretório, confira a URL base usada pelos links e formulários.

`config/database.php` carrega as variáveis do `.env` e cria a conexão PDO com PostgreSQL. Atualmente a DSN fixa a porta `5432`, embora `DB_PORT` seja lida; ajuste essa implementação se usar outra porta.

## Rotas existentes

| Método | Caminho | Ação |
| --- | --- | --- |
| GET | `/` | Exibe login |
| GET, POST | `/login` | Exibe e processa login |
| POST | `/logout` | Encerra a sessão |
| GET, POST | `/register` | Exibe e processa cadastro de usuário |
| GET, POST | `/esqueci-senha` | Solicita redefinição de senha |
| GET, POST | `/redefinir-senha` | Exibe e salva nova senha usando token |
| GET | `/home` | Página inicial paginada (`?pagina=2`, requer login; 10 campeonatos por página) |
| GET | `/usuarios/{id}` | Consulta usuário autenticado, sem retornar a senha |
| GET | `/registrar-campeonato` | Exibe o formulário de cadastro (requer login) |
| POST | `/registrar-campeonato` | Valida e cria campeonato planejado (requer login) |

## Cadastro de campeonatos

`App\Controllers\CampeonatosController` concentra a exibição e o processamento do formulário, enquanto `CampeonatosModel` acessa o banco. O organizador vem da sessão autenticada, e os campos do cadastro são validados antes da gravação. Modalidade e formato podem ser incluídos quando fizerem parte do schema.

### Regras de status

- Um campeonato é criado como `PLANEJADO`.
- Ao carregar `/home`, o sistema compara `data_inicio` com a data atual no fuso `America/Sao_Paulo`. Se a data de início chegou, muda o status de `PLANEJADO` para `EM_ANDAMENTO`.
- Essa atualização ocorre quando o organizador acessa a home. Sem uma visita, o registro permanece planejado até o próximo acesso; uma tarefa agendada no servidor seria necessária para atualizar mesmo sem visitas.
- A data de término não muda o status para `FINALIZADO`. A conclusão continua dependendo de uma ação explícita ou de uma regra futura baseada nas partidas.

## Observações

- `database/schema.sql` usa sintaxe PostgreSQL (identity columns, `NOW() + INTERVAL` e booleanos).
- Não há suíte de testes documentada no repositório neste momento.
- Este documento descreve o estado observado no código e deve ser atualizado conforme os fluxos forem implementados.

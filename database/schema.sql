
-- ==========================================
-- 1. USUÁRIOS
-- ==========================================

CREATE TABLE tb_usuarios (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);


-- ==========================================
-- 2. CAMPEONATOS
-- ==========================================

CREATE TABLE tb_campeonatos (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE,
    status VARCHAR(20) NOT NULL DEFAULT 'PLANEJADO',
    id_organizador INTEGER NOT NULL,

    CONSTRAINT fk_campeonato_organizador
        FOREIGN KEY (id_organizador)
        REFERENCES tb_usuarios(id),

    CONSTRAINT chk_campeonato_status
        CHECK (status IN ('PLANEJADO', 'EM_ANDAMENTO', 'FINALIZADO')),

    CONSTRAINT chk_campeonato_datas
        CHECK (data_fim IS NULL OR data_fim >= data_inicio)
);


-- ==========================================
-- 3. TIMES
-- ==========================================

CREATE TABLE tb_times (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_campeonato INTEGER NOT NULL,
    nome VARCHAR(255) NOT NULL,

    CONSTRAINT fk_time_campeonato
        FOREIGN KEY (id_campeonato)
        REFERENCES tb_campeonatos(id)
        ON DELETE CASCADE,

    CONSTRAINT uq_time_campeonato
        UNIQUE (id_campeonato, nome)
);


-- ==========================================
-- 4. ATLETAS
-- ==========================================

CREATE TABLE tb_atletas (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);


-- ==========================================
-- 5. RELAÇÃO TIME x ATLETA
-- ==========================================

CREATE TABLE tb_time_atletas (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_time INTEGER NOT NULL,
    id_atleta INTEGER NOT NULL,
    numero INTEGER NOT NULL,
    posicao VARCHAR(45) NOT NULL,

    CONSTRAINT fk_time_atleta_time
        FOREIGN KEY (id_time)
        REFERENCES tb_times(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_time_atleta_atleta
        FOREIGN KEY (id_atleta)
        REFERENCES tb_atletas(id)
        ON DELETE CASCADE,

    CONSTRAINT uq_atleta_time
        UNIQUE (id_time, id_atleta),

    CONSTRAINT uq_numero_time
        UNIQUE (id_time, numero),

    CONSTRAINT chk_numero_atleta
        CHECK (numero BETWEEN 1 AND 99)
);


-- ==========================================
-- 6. RODADAS
-- ==========================================

CREATE TABLE tb_rodadas (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_campeonato INTEGER NOT NULL,
    numero INTEGER NOT NULL,

    CONSTRAINT fk_rodada_campeonato
        FOREIGN KEY (id_campeonato)
        REFERENCES tb_campeonatos(id)
        ON DELETE CASCADE,

    CONSTRAINT uq_rodada_campeonato
        UNIQUE (id_campeonato, numero),

    CONSTRAINT chk_numero_rodada
        CHECK (numero > 0)
);


-- ==========================================
-- 7. PARTIDAS
-- ==========================================

CREATE TABLE tb_partidas (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_rodada INTEGER NOT NULL,
    id_time_mandante INTEGER NOT NULL,
    id_time_visitante INTEGER NOT NULL,
    gols_time_mandante INTEGER NOT NULL DEFAULT 0,
    gols_time_visitante INTEGER NOT NULL DEFAULT 0,
    data_hora TIMESTAMP NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'AGENDADA',

    CONSTRAINT fk_partida_rodada
        FOREIGN KEY (id_rodada)
        REFERENCES tb_rodadas(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_partida_time_mandante
        FOREIGN KEY (id_time_mandante)
        REFERENCES tb_times(id),

    CONSTRAINT fk_partida_time_visitante
        FOREIGN KEY (id_time_visitante)
        REFERENCES tb_times(id),

    CONSTRAINT chk_partida_times_diferentes
        CHECK (id_time_mandante <> id_time_visitante),

    CONSTRAINT chk_gols_mandante
        CHECK (gols_time_mandante >= 0),

    CONSTRAINT chk_gols_visitante
        CHECK (gols_time_visitante >= 0),

    CONSTRAINT chk_partida_status
        CHECK (status IN ('AGENDADA', 'EM_ANDAMENTO', 'FINALIZADA', 'CANCELADA'))
);


-- ==========================================
-- 8. EVENTOS DAS PARTIDAS
-- ==========================================

CREATE TABLE tb_eventos_partida (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_atleta INTEGER NOT NULL,
    id_partida INTEGER NOT NULL,
    tipo VARCHAR(30) NOT NULL,
    minuto INTEGER NOT NULL,

    CONSTRAINT fk_evento_atleta
        FOREIGN KEY (id_atleta)
        REFERENCES tb_atletas(id),

    CONSTRAINT fk_evento_partida
        FOREIGN KEY (id_partida)
        REFERENCES tb_partidas(id)
        ON DELETE CASCADE,

    CONSTRAINT chk_evento_tipo
        CHECK (tipo IN ('GOL', 'CARTAO_AMARELO', 'CARTAO_VERMELHO')),

    CONSTRAINT chk_evento_minuto
        CHECK (minuto >= 0)
);
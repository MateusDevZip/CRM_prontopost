-- CRM ProntoPost - Estrutura do banco de dados (MySQL 5.7+/8.0)
-- Criar rodando este arquivo no phpMyAdmin da Hostinger, dentro do banco já criado.

SET NAMES utf8mb4;

-- ---------------------------------------------------------------------------
-- usuarios: equipe que usa o sistema (login + responsável pelos projetos)
-- ---------------------------------------------------------------------------
CREATE TABLE usuarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,
  papel ENUM('admin','equipe') NOT NULL DEFAULT 'equipe',
  ativo TINYINT(1) NOT NULL DEFAULT 1,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- origens: de onde veio o cliente (COMERCIAL, FARMERS, etc.)
-- ---------------------------------------------------------------------------
CREATE TABLE origens (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- planos: pacotes de postagem vendidos
-- ---------------------------------------------------------------------------
CREATE TABLE planos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(60) NOT NULL UNIQUE,
  posts_por_mes SMALLINT UNSIGNED NULL,
  valor_padrao DECIMAL(10,2) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- etapas: colunas do Kanban (editável em Configurações, sem alterar código)
-- ---------------------------------------------------------------------------
CREATE TABLE etapas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(60) NOT NULL UNIQUE,
  ordem SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  cor VARCHAR(7) NOT NULL DEFAULT '#6c757d',
  is_final TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'etapa de encerramento (ex: cancelados) - não entra em contagens ativas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- clientes: cadastro de contatos (CRM)
-- ---------------------------------------------------------------------------
CREATE TABLE clientes (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(180) NOT NULL,
  telefone VARCHAR(30) NULL,
  email VARCHAR(150) NULL,
  link_atendimento VARCHAR(255) NULL COMMENT 'link do egestor/zap usado pela equipe',
  observacoes TEXT NULL,
  origem_id INT UNSIGNED NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_clientes_origem FOREIGN KEY (origem_id) REFERENCES origens(id) ON DELETE SET NULL,
  INDEX idx_clientes_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- projetos: card do Kanban (um cliente pode ter mais de um projeto ao longo
-- do tempo, ex.: cancelou e recontratou depois)
-- ---------------------------------------------------------------------------
CREATE TABLE projetos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT UNSIGNED NOT NULL,
  plano_id INT UNSIGNED NULL,
  etapa_id INT UNSIGNED NOT NULL,
  responsavel_id INT UNSIGNED NULL,
  chegou_em DATE NULL,
  mes_conteudo VARCHAR(20) NULL COMMENT 'ex: 2026-07 - mês de referência dos posts',
  posts_no_mes SMALLINT UNSIGNED NULL,
  aprovacao_primeiro_post DATE NULL,
  resultado_aprovacao VARCHAR(255) NULL,
  proxima_acao_data DATE NULL,
  proximo_passo TEXT NULL,
  valor_estimado DECIMAL(10,2) NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_projetos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
  CONSTRAINT fk_projetos_plano FOREIGN KEY (plano_id) REFERENCES planos(id) ON DELETE SET NULL,
  CONSTRAINT fk_projetos_etapa FOREIGN KEY (etapa_id) REFERENCES etapas(id) ON DELETE RESTRICT,
  CONSTRAINT fk_projetos_responsavel FOREIGN KEY (responsavel_id) REFERENCES usuarios(id) ON DELETE SET NULL,
  INDEX idx_projetos_etapa (etapa_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- projeto_historico: trilha de auditoria de mudanças de etapa (Kanban)
-- ---------------------------------------------------------------------------
CREATE TABLE projeto_historico (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  projeto_id INT UNSIGNED NOT NULL,
  etapa_anterior_id INT UNSIGNED NULL,
  etapa_nova_id INT UNSIGNED NOT NULL,
  usuario_id INT UNSIGNED NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_hist_projeto FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE,
  CONSTRAINT fk_hist_etapa_ant FOREIGN KEY (etapa_anterior_id) REFERENCES etapas(id) ON DELETE SET NULL,
  CONSTRAINT fk_hist_etapa_nova FOREIGN KEY (etapa_nova_id) REFERENCES etapas(id) ON DELETE CASCADE,
  CONSTRAINT fk_hist_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- notas: linha do tempo / anotações de atendimento por projeto
-- ---------------------------------------------------------------------------
CREATE TABLE notas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  projeto_id INT UNSIGNED NOT NULL,
  usuario_id INT UNSIGNED NULL,
  texto TEXT NOT NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_notas_projeto FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE,
  CONSTRAINT fk_notas_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

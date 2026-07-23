-- CRM ProntoPost - Dados de configuração inicial (listas fixas)
-- Rode depois do 01_schema.sql

SET NAMES utf8mb4;

INSERT INTO origens (nome) VALUES
  ('COMERCIAL'),
  ('COMERCIAL 2'),
  ('FARMERS'),
  ('Outro');

INSERT INTO planos (nome, posts_por_mes) VALUES
  ('Presença - 2post', 2),
  ('Crescimento - 4post', 4),
  ('Autoridade - 7post', 7);

-- Etapas do Kanban. No Notion original havia uma coluna nova por mês
-- ("JULHO PRONTOS", "AGOSTO PRONTOS"...) - aqui isso foi unificado em uma
-- única etapa "Prontos", e o mês fica registrado no campo
-- projetos.mes_conteudo. Assim o quadro não cresce uma coluna a cada mês.
-- Você pode renomear/reordenar isso depois na tela de Configurações.
INSERT INTO etapas (nome, ordem, cor, is_final) VALUES
  ('Novo contratado', 1, '#0d6efd', 0),
  ('Criando posts', 2, '#6f42c1', 0),
  ('Prontos', 3, '#20c997', 0),
  ('Agendado', 4, '#fd7e14', 0),
  ('Enviado e não conectou', 5, '#dc3545', 0),
  ('Possível cancelamento', 6, '#ffc107', 0),
  ('Cancelados', 7, '#6c757d', 1);

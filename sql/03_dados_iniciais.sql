-- Dados reais migrados do Notion (ProntoPost) - gerado automaticamente
-- Rode depois de 01_schema.sql e 02_seed.sql
SET NAMES utf8mb4;

-- https://blaster.zipline.com.br/egestor/#292195
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#292195', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#292195', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#331755 (adv) Silva Ferreira Fontinhas Advocacia
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#331755 (adv) Silva Ferreira Fontinhas Advocacia', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#331755', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-30', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#250095
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#250095', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#250095', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-22', NULL, NULL, NULL, 'NÃO RESPONDE', NULL, 'no show', NULL);

-- https://blaster.zipline.com.br/egestor/#413571
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#413571', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#413571', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-05-08', NULL, NULL, NULL, NULL, NULL, 'no show', NULL);

-- https://blaster.zipline.com.br/egestor/?#349641
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#349641', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#349641', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Agendado' LIMIT 1), '2026-05-14', NULL, NULL, NULL, NULL, NULL, 'tentando contato 2/6', NULL);

-- https://blaster.zipline.com.br/egestor/?#341728
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#341728', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#341728', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-10', '2026-08', NULL, NULL, NULL, '2026-06-18', 'pediu para alterar um pouco a escrita (deixar mais grossa ) https://zipline.zipticket.com.br/zap/?574096', NULL);

-- https://blaster.zipline.com.br/egestor/?#271521
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#271521', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#271521', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-03-13', NULL, NULL, NULL, 'Posts prontos e sem contato', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#192991
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#192991', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#192991', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-03-27', NULL, NULL, NULL, 'Posts prontos e sem contato', NULL, 'Mandou imagens', NULL);

-- https://blaster.zipline.com.br/egestor/?#300602onnie
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#300602onnie', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#300602', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-04-07', NULL, NULL, NULL, 'NÃO RESPONDE', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#391012
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#391012', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#391012', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-10', NULL, NULL, NULL, 'Não consegue conectar', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#541649
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#541649', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#541649', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Possível cancelamento' LIMIT 1), '2026-04-17', NULL, NULL, NULL, 'Posts prontos e sem contato', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#239534
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#239534', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#239534', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-17', NULL, NULL, NULL, 'Posts prontos e sem contato', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#545865
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#545865', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#545865', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-20', '2026-08', NULL, NULL, NULL, NULL, '++ DO MEU FORNECEDOR ELFEN', NULL);

-- https://blaster.zipline.com.br/egestor/#371295
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#371295', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#371295', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-27', NULL, NULL, NULL, 'Posts prontos e sem contato', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#310996
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#310996', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#310996', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-27', '2026-08', NULL, NULL, 'Posts prontos e sem contato', NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#381328
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#381328', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#381328', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#379213R DISTRIBUIDORA
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#379213R DISTRIBUIDORA', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#379213', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-05', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#227624
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#227624', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#227624', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#348798
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#348798', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#348798', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#446001
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#446001', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#446001', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-10', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#227630
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#227630', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#227630', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-10', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#367327
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#367327', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#367327', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = '' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#371962
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#371962', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#371962', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#352716
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#352716', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#352716', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-13', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#533274
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#533274', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#533274', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-13', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#278720
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#278720', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#278720', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-16', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- Mecânica Mellla
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Mecânica Mellla', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#373453', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-18', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#443742
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#443742', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#443742', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#182443
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#182443', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#182443', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-20', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#457322
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#457322', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#457322', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-20', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#439641
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#439641', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#439641', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-23', '2026-08', NULL, NULL, NULL, NULL, 'mandou imagens no zapinho e pediu para dar uma clareada nas imagens.', NULL);

-- https://blaster.zipline.com.br/egestor/?#438158
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#438158', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#438158', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-23', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#346330
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#346330', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#346330', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#531693
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#531693', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#531693', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-12', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#515719
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#515719', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#515719', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-03-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#370569
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#370569', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#370569', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-23', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#505631
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#505631', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#505631', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-25', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#257683
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#257683', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#257683', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-31', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- Maxx Fixação
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Maxx Fixação', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#222102', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-31', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#458250
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#458250', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#458250', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-03-31', '2026-08', NULL, NULL, NULL, NULL, 'pediu alteraçãoes, mais claras etc.. https://zipline.zipticket.com.br/zap/?892374', NULL);

-- https://blaster.zipline.com.br/egestor/#459147
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#459147', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#459147', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-07', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#446999
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#446999', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#446999', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-07', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#504655
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#504655', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#504655', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Brenda Carolina
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Brenda Carolina', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Marcia Pastori Estética
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Marcia Pastori Estética', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#252076
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#252076', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#252076', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-13', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#544178
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#544178', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#544178', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-13', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#393315
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#393315', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#393315', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-14', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#258728
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#258728', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#258728', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-14', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#304854R Megale
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#304854R Megale', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#304854', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-15', '2026-08', NULL, NULL, NULL, NULL, 'https://zipline.zipticket.com.br/zap/?457476 pediu para ser mais claro', NULL);

-- https://blaster.zipline.com.br/egestor/#138923
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#138923', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#138923', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-16', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#299346
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#299346', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#299346', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-16', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#301914
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#301914', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#301914', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-16', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#348058
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#348058', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#348058', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#445857
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#445857', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#445857', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-20', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#547645
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#547645', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#547645', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-24', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#534828
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#534828', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#534828', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#434834
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#434834', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#434834', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-24', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#35326
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#35326', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#35326', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-27', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#307362
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#307362', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#307362', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-27', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#302586
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#302586', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#302586', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-27', '2026-08', NULL, NULL, NULL, NULL, 'incluir mais sobre as ferramentas', NULL);

-- https://blaster.zipline.com.br/egestor/#155091
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#155091', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#155091', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#361700
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#361700', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#361700', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-28', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/nfemais/#514191
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/nfemais/#514191', NULL, NULL, 'https://blaster.zipline.com.br/nfemais/#514191', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-29', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#234192
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#234192', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#234192', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-29', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/nfemais/#493687
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/nfemais/#493687', NULL, NULL, 'https://blaster.zipline.com.br/nfemais/#493687', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#328233
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#328233', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#328233', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-29', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#293634
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#293634', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#293634', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#350097
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#350097', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#350097', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-30', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- renove_assessoria_contabil
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('renove_assessoria_contabil', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#361584', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#331755 (cont)
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#331755 (cont)', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#331755', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-30', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#233004
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#233004', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#233004', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-04-30', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#341359
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#341359', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#341359', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-05', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#537274
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#537274', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#537274', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- labottegacxs
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('labottegacxs', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#452968', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-14', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#207368
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#207368', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#207368', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-14', '2026-08', NULL, NULL, NULL, NULL, 'pegar fotos do drive e fazer e vitrine', NULL);

-- https://blaster.zipline.com.br/egestor/#378548
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#378548', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#378548', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-15', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#234136
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#234136', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#234136', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/nfemais/#554997 (Rofer Contábil)
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/nfemais/#554997 (Rofer Contábil)', NULL, NULL, 'https://blaster.zipline.com.br/nfemais/#554997', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-15', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#505281
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#505281', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#505281', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-15', NULL, NULL, NULL, NULL, NULL, 'criar (usar site tmb)', NULL);

-- https://blaster.zipline.com.br/egestor/#283831
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#283831', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#283831', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-15', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- Marli Lessa dos Santos
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Marli Lessa dos Santos', 'Marli 55 61 9144-6509 tentando contato novamente para conectar o instagram ao prontopost.', NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#190202atacomp
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#190202atacomp', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#190202', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-20', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#341754
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#341754', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#341754', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-20', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#376399
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#376399', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#376399', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-05-20', NULL, NULL, NULL, NULL, NULL, 'gpoi.net15:48https://share.google/yxbCB9AykiI8AZkY415:51https://www.instagram.com/gpoi_grafica/', NULL);

-- https://blaster.zipline.com.br/egestor/?#317289
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#317289', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-21', '2026-08', NULL, NULL, NULL, NULL, 'os próximos posts, incluir uma chamada pra entrar em contato (cta)', NULL);

-- https://blaster.zipline.com.br/egestor/#357119
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#357119', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-21', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#457575
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#457575', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-21', '2026-08', NULL, NULL, NULL, NULL, 'usar bastante do site (n fez conosco) e mandou um catalogo imenso no email', NULL);

-- cleoartcamisaria
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('cleoartcamisaria', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#473635', (SELECT id FROM origens WHERE nome = '' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-22', '2026-08', NULL, NULL, NULL, NULL, 'usar site de exemplo MANDOU IMAGENS ZAP', NULL);

-- https://blaster.zipline.com.br/egestor/#290094
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#290094', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#290094', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-22', NULL, NULL, NULL, NULL, NULL, 'pegar imagens do instagem  tambem', NULL);

-- https://blaster.zipline.com.br/egestor/?#291515
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#291515', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#291515', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-05-22', NULL, NULL, NULL, NULL, NULL, 'tentando contato 2/6', NULL);

-- https://blaster.zipline.com.br/egestor/?#288604
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#288604', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#288604', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-05-22', NULL, NULL, NULL, NULL, NULL, 'vai criar o instagram, vai mandar imagens e logo vai mandar tmb

Aguardando as fotos', NULL);

-- https://blaster.zipline.com.br/egestor/?#231813
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#231813', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#231813', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-22', NULL, NULL, NULL, NULL, NULL, 'tentando contato 2/6', NULL);

-- https://blaster.zipline.com.br/egestor/?#231813 (1)
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#231813 (1)', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#231813', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-22', NULL, NULL, NULL, NULL, NULL, 'tentando contato 2/6', NULL);

-- https://blaster.zipline.com.br/egestor/#428470https://blaster.zipline.com.br/egestor/#428470
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#428470https://blaster.zipline.com.br/egestor/#428470', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#428470', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-25', '2026-07', NULL, NULL, NULL, NULL, 'usar site e mandou catalgos https://zipline.zipticket.com.br/painel/#245325', NULL);

-- https://blaster.zipline.com.br/egestor/#507764
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#507764', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#507764', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-25', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#336025
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#336025', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#336025', (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-25', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#318829
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#318829', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#318829', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-26', NULL, NULL, NULL, NULL, NULL, 'tentando contato 2/6', NULL);

-- https://blaster.zipline.com.br/egestor/#539048
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#539048', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-05-26', NULL, NULL, NULL, NULL, NULL, 'ainda nao tem instagram, criar logo e fazer posts SEMPRE LIGAR', NULL);

-- https://blaster.zipline.com.br/egestor/?#319457
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#319457', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-05-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#301740
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#301740', NULL, NULL, 'Uma sugestão para os próximos posts, poderia falar tb do nosso site, para irem fazer orçamento por lá tb: http://www.economysuprimentos.com.br/', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-27', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#272238
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#272238', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-28', '2026-08', NULL, NULL, NULL, NULL, 'criar', NULL);

-- https://blaster.zipline.com.br/egestor/#517488
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#517488', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-28', '2026-08', NULL, NULL, NULL, NULL, 'criar', NULL);

-- https://blaster.zipline.com.br/egestor/?#243003
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#243003', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-29', '2026-08', NULL, NULL, NULL, NULL, 'mandou imagens no zap', NULL);

-- https://blaster.zipline.com.br/egestor/#472131
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#472131', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-05-27', NULL, NULL, NULL, NULL, NULL, 'vai mandar fotos dos fornecedores. ESTA COM O INSTA BLOQUEADO e criou t=outro', NULL);

-- https://blaster.zipline.com.br/egestor/?#170184
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#170184', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-29', '2026-07', NULL, NULL, NULL, NULL, 'vai mandar imagens no zap ou email', NULL);

-- https://blaster.zipline.com.br/egestor/?#147023
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#147023', NULL, NULL, 'vai mandar imagens, mas utilizar do site tmb', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), NULL, '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#225922
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#225922', NULL, NULL, 'pegar imagens do site', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-05-28', '2026-08', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#560544
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#560544', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-06-01', NULL, NULL, NULL, NULL, NULL, 'ver site vitrine, colocar cte pra entrar na vitrine', NULL);

-- https://blaster.zipline.com.br/egestor/?#298766
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#298766', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-06-01', NULL, NULL, NULL, NULL, NULL, 'chata pra caramba, quase implorei pra q pudesse mandar fotos, mas acho dificil q mande, então eu disse q provavelmente vamos entegar algo generico pq ela supostamente nao tem como tirar essas fotos', NULL);

-- https://blaster.zipline.com.br/egestor/#118006 (casa dos rolamentos)
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#118006 (casa dos rolamentos)', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-02', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#373510
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#373510', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-05', '2026-08', NULL, NULL, NULL, NULL, 'vai mandar das datas comemorativas, vai mandar as datas que preferem para posts, vai mandar imagens do banco de dados e logo', NULL);

-- https://blaster.zipline.com.br/egestor/?#296869
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#296869', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-05', '2026-08', NULL, NULL, NULL, NULL, 'pegar imagens zap', NULL);

-- https://blaster.zipline.com.br/egestor/#473399
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#473399', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-08', '2026-08', NULL, NULL, NULL, NULL, 'criar, usar imagens da internet dos produtos', NULL);

-- Vinci Litoral
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Vinci Litoral', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#365264', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-08', '2026-08', NULL, NULL, NULL, NULL, 'mandou no zap, mas pegar do site tmb', NULL);

-- Infocenter Comercio e Servicos de Informatica
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Infocenter Comercio e Servicos de Informatica', NULL, NULL, 'fazer', (SELECT id FROM origens WHERE nome = 'Outro' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-09', '2026-08', NULL, NULL, NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#331755', NULL);

-- STE COMERCIO
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('STE COMERCIO', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#269024', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-01', '2026-07', NULL, NULL, NULL, NULL, 'ver quando o site ficar pronto tmb', NULL);

-- https://blaster.zipline.com.br/egestor/?#210871
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#210871', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-06-10', NULL, NULL, NULL, NULL, NULL, 'pegar imagens do instagram', NULL);

-- https://blaster.zipline.com.br/egestor/#513352
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#513352', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-10', '2026-08', NULL, NULL, NULL, NULL, 'fazer, olhar o zap sobre o assunto q ela mandou', NULL);

-- https://blaster.zipline.com.br/egestor/#154763
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#154763', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-10', '2026-07', NULL, NULL, NULL, NULL, 'fazer', NULL);

-- https://blaster.zipline.com.br/egestor/#532335
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#532335', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-06-10', NULL, NULL, NULL, NULL, NULL, 'fazer, pegar imagnes zap', NULL);

-- https://blaster.zipline.com.br/egestor/?#359988
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#359988', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-10', '2026-07', NULL, NULL, NULL, NULL, 'fazer', NULL);

-- https://blaster.zipline.com.br/egestor/?#252209
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#252209', NULL, NULL, 'vai enviar imagens, mas pegar do site tmb, pedir as imagens e logo caso ele esqueça', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-06-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#553076
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#553076', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-11', '2026-08', NULL, NULL, NULL, NULL, 'fazer', NULL);

-- https://blaster.zipline.com.br/egestor/#436933
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#436933', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-16', '2026-08', NULL, NULL, NULL, NULL, 'Elizaldo - 63992317107 fazer', NULL);

-- https://blaster.zipline.com.br/egestor/?#143084
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#143084', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-16', '2026-08', NULL, NULL, NULL, NULL, 'fazer, mas vai mandar tmb ao longo dos dias', NULL);

-- https://blaster.zipline.com.br/egestor/?#508901
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#508901', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-06-16', NULL, NULL, NULL, NULL, NULL, 'no show', NULL);

-- https://blaster.zipline.com.br/egestor/?#305928
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#305928', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-06-16', NULL, NULL, NULL, NULL, NULL, 'vai chamar para agendarmos!!!!', NULL);

-- https://blaster.zipline.com.br/egestor/#241471
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#241471', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-06-16', NULL, NULL, NULL, NULL, NULL, 'vai mandar as datas comemortivas', NULL);

-- https://blaster.zipline.com.br/egestor/#317642
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#317642', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = '' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-06-15', NULL, NULL, NULL, NULL, NULL, 'fazer', NULL);

-- https://blaster.zipline.com.br/egestor/#276007 I.T.GRA Business
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#276007 I.T.GRA Business', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-15', '2026-08', NULL, NULL, NULL, NULL, 'fazer', NULL);

-- GNT Mobilidade Urbana e Engenharia
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('GNT Mobilidade Urbana e Engenharia', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#163546', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-06-16', NULL, NULL, NULL, NULL, NULL, 'fazer, mandou logo no zap', NULL);

-- https://blaster.zipline.com.br/egestor/#124334
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#124334', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-06-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#347386
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#347386', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-06-16', NULL, NULL, NULL, NULL, NULL, 'fazer olhar no zap, nao por foto de cabeca preta de camarao. usar site', NULL);

-- https://blaster.zipline.com.br/egestor/#148175
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#148175', NULL, NULL, 'vai mandar fotos das flores no zap', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-16', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#358006 Dezen
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#358006 Dezen', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-16', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#538099
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#538099', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-16', '2026-07', NULL, NULL, NULL, NULL, 'criar', NULL);

-- Bubininha Facas e Cutelos
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Bubininha Facas e Cutelos', NULL, NULL, 'https://blaster.zipline.com.br/nfemais/?#443705', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-18', '2026-07', NULL, NULL, NULL, NULL, 'fotos no zap, mas fazer caso nao mande', NULL);

-- https://blaster.zipline.com.br/egestor/?#289655
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#289655', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-18', '2026-07', NULL, NULL, NULL, NULL, '1 conteudo de moradia do hoetel mesmo, 1 conteudo sobre cuidado. vai mandar imagens, mas pegar do isnta e site', NULL);

-- https://blaster.zipline.com.br/nfemais/#552389
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/nfemais/#552389', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-17', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#165401
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#165401', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-22', '2026-07', NULL, NULL, NULL, NULL, 'mandou catalogo zap, mas utilizar imagens do catalogo do site e produtos', NULL);

-- https://blaster.zipline.com.br/egestor/?#380912
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#380912', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-06-22', NULL, NULL, NULL, NULL, NULL, 'fazer com base no catalogo que tem no isntagram, mas com nossa base de dados', NULL);

-- Distribuidora Atitude
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Distribuidora Atitude', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#559972', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-17', '2026-07', NULL, NULL, NULL, NULL, 'ver o catalgo que mandou no zap', NULL);

-- suporte licitacoes
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('suporte licitacoes', NULL, NULL, 'https://blaster.zipline.com.br/nfemais/#496884', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-22', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#543057
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#543057', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-22', '2026-07', NULL, NULL, NULL, NULL, 'vai mandar fotos dos pallets, mas fazer', NULL);

-- https://blaster.zipline.com.br/egestor/?#362356
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#362356', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-23', '2026-07', NULL, NULL, NULL, NULL, 'vai mandar iumagens, mas FAZER', NULL);

-- https://blaster.zipline.com.br/egestor/?#379330
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#379330', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-23', '2026-07', NULL, NULL, NULL, NULL, 'vai mandar imagens , mas fazer', NULL);

-- https://blaster.zipline.com.br/egestor/?#283586
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#283586', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-23', '2026-07', NULL, NULL, NULL, NULL, 'pegar fotos dos produtos dentro do egestor', NULL);

-- https://blaster.zipline.com.br/egestor/#293080
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#293080', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-23', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#294789
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#294789', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Cancelados' LIMIT 1), '2026-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#336280
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#336280', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-24', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#456773
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#456773', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#560815
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#560815', NULL, 'ta vendo o @ do insta (chamar ele)', NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-06-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#379065 Saconi Soluções em Engenharia
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#379065 Saconi Soluções em Engenharia', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-25', '2026-07', NULL, NULL, NULL, NULL, 'mandou imagens zap e o insta ficou de ver', NULL);

-- https://blaster.zipline.com.br/egestor/#314579
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#314579', NULL, NULL, 'Palavra chave: enobrecimento do rotulo usar bastante. ir chamando para pedir fotos (se possivel tirar a marca do cliente nas fotos)', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-26', '2026-07', NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#565846
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#565846', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-30', '2026-07', NULL, NULL, NULL, NULL, 'mandou e adiconei as fotos', NULL);

-- https://blaster.zipline.com.br/egestor/?#255374
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#255374', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-06-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/nfemais/#479409 (veglac)
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/nfemais/#479409 (veglac)', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-06-30', NULL, NULL, NULL, NULL, NULL, 'https://zipline.zipticket.com.br/zap/?1150805 pediu algumas alterações', NULL);

-- https://blaster.zipline.com.br/egestor/#350567
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#350567', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-30', '2026-07', NULL, NULL, NULL, NULL, 'nao tem imagens, mas vai tirar e mandando com o tempo', NULL);

-- raphaelleoptica
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('raphaelleoptica', NULL, NULL, 'https://blaster.zipline.com.br/egestor/#556389', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-06-30', '2026-07', NULL, NULL, NULL, NULL, 'pegar imagens do formulário do site quando ele mandar', NULL);

-- https://blaster.zipline.com.br/nfemais/#496809 (ginzi)
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/nfemais/#496809 (ginzi)', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-07-02', '2026-07', NULL, NULL, NULL, NULL, 'vai mandar as imagens, tem bastante coisa no site e no insta de referencia', NULL);

-- Glamour Lizz
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Glamour Lizz', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#167810', (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Enviado e não conectou' LIMIT 1), '2026-07-03', NULL, NULL, NULL, NULL, NULL, 'ficou de mandar fotos e o instagram, mas pegar da vitrine quando tiver pronta', NULL);

-- https://blaster.zipline.com.br/egestor/?#189198
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#189198', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-07-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- JC produtos e serviços para eventos
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('JC produtos e serviços para eventos', NULL, NULL, 'https://zipline.zipticket.com.br/zap/?1151473', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), '2026-07-06', '2026-07', NULL, NULL, NULL, NULL, 'queridona,  pediu que a primeira postagem fosse brnading (algo sobre a história deles), mandou no zap imagens', NULL);

-- STECCA RECHEIOS
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('STECCA RECHEIOS', NULL, NULL, 'https://blaster.zipline.com.br/nfemais/#567535', (SELECT id FROM origens WHERE nome = '' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Prontos' LIMIT 1), NULL, '2026-07', NULL, NULL, NULL, NULL, 'vai criar o instagrama ainda. vai mandar fotos dos rotulos e colocar em balde e a logo marca vai mandar', NULL);

-- https://blaster.zipline.com.br/egestor/?#404550
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#404550', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-07-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/?#421889
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/?#421889', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-07-13', NULL, NULL, NULL, NULL, NULL, 'mandou imagens np zap, coloquei no prontopost o q eu achei melhor', NULL);

-- camilazip LEMON SEMIJOIAS
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('camilazip LEMON SEMIJOIAS', NULL, NULL, 'drive: https://drive.google.com/drive/folders/1L3uuqEuqX6L0ezCEHNIf5iBO7M8hGUC6?usp=drive_link', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Autoridade - 7post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-07-15', NULL, NULL, NULL, NULL, NULL, 'blaster: https://blaster.zipline.com.br/egestor/?#138744   chat: https://zipline.zipticket.com.br/zap/?162302 (importante os audios rs)', NULL);

-- https://blaster.zipline.com.br/egestor/#573585
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#573585', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'FARMERS' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- D. Faustino da Silva LTDA Daniel - 61 9972-8674
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('D. Faustino da Silva LTDA Daniel - 61 9972-8674', NULL, NULL, 'https://blaster.zipline.com.br/egestor/?#331755', (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-07-20', NULL, NULL, NULL, NULL, NULL, 'nao tem logo criada, vai mandar imagens no wpp. mandou sugestoes de instagram', NULL);

-- Kassia cardoso schunck
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('Kassia cardoso schunck', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-07-21', NULL, NULL, NULL, NULL, NULL, 'chamei no zapinho +55 45 9992-9513 (vai mandar imagens) (pegar do site mais infos)', NULL);

-- 31.939.610 Sandra Helena De Lima
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('31.939.610 Sandra Helena De Lima', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-07-21', NULL, NULL, NULL, NULL, NULL, 'chamei no zapinho', NULL);

-- https://blaster.zipline.com.br/egestor/#341878
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#341878', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Crescimento - 4post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Criando posts' LIMIT 1), '2026-07-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- https://blaster.zipline.com.br/egestor/#573665
INSERT INTO clientes (nome, telefone, email, link_atendimento, origem_id) VALUES ('https://blaster.zipline.com.br/egestor/#573665', NULL, NULL, NULL, (SELECT id FROM origens WHERE nome = 'COMERCIAL 2' LIMIT 1));
INSERT INTO projetos (cliente_id, plano_id, etapa_id, chegou_em, mes_conteudo, posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado) VALUES (LAST_INSERT_ID(), (SELECT id FROM planos WHERE nome = 'Presença - 2post' LIMIT 1), (SELECT id FROM etapas WHERE nome = 'Novo contratado' LIMIT 1), '2026-07-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

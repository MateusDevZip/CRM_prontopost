-- Adiciona o registro da data em que o projeto foi finalizado (arrastado para "Prontos").
-- Rodar uma única vez no banco (phpMyAdmin -> aba SQL do banco), tanto local quanto produção.

ALTER TABLE projetos
  ADD COLUMN finalizado_em DATETIME NULL COMMENT 'data/hora em que o card entrou na etapa Prontos'
  AFTER etapa_id;

-- Preenche os projetos que já estão em "Prontos" hoje, usando a última entrada
-- registrada no histórico de etapas; se não houver histórico, usa atualizado_em como estimativa.
UPDATE projetos p
JOIN etapas e ON e.id = p.etapa_id AND e.nome = 'Prontos'
LEFT JOIN (
  SELECT h.projeto_id, MAX(h.criado_em) AS ultima_entrada
  FROM projeto_historico h
  JOIN etapas e2 ON e2.id = h.etapa_nova_id AND e2.nome = 'Prontos'
  GROUP BY h.projeto_id
) hist ON hist.projeto_id = p.id
SET p.finalizado_em = COALESCE(hist.ultima_entrada, p.atualizado_em)
WHERE p.finalizado_em IS NULL;

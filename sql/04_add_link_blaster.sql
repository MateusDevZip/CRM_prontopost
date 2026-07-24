-- Adiciona o campo "Link blaster" aos projetos (separado do link_atendimento do cliente).
-- Rodar uma única vez no banco de produção (phpMyAdmin -> aba SQL do banco).

ALTER TABLE projetos
  ADD COLUMN link_blaster VARCHAR(255) NULL COMMENT 'link do sistema Blaster (blaster.zipline.com.br) referente a este projeto'
  AFTER resultado_aprovacao;

-- Limpeza pontual: muitos clientes vieram da migração do Notion com o link do Blaster
-- gravado por engano no campo "nome". Copia esse link para o novo campo do projeto.
UPDATE projetos p
JOIN clientes c ON c.id = p.cliente_id
SET p.link_blaster = TRIM(SUBSTRING_INDEX(c.nome, ' ', 1))
WHERE c.nome LIKE 'https://blaster.zipline.com.br/egestor%'
  AND p.link_blaster IS NULL;

<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$etapas = listar_etapas();

$projetos = db()->query("
    SELECT p.id, p.valor_estimado, p.chegou_em, p.proximo_passo, p.etapa_id,
           c.nome cliente, c.link_atendimento, pl.nome plano, u.nome responsavel
    FROM projetos p
    JOIN clientes c ON c.id = p.cliente_id
    LEFT JOIN planos pl ON pl.id = p.plano_id
    LEFT JOIN usuarios u ON u.id = p.responsavel_id
    ORDER BY p.atualizado_em DESC
")->fetchAll();

$por_etapa = [];
foreach ($etapas as $e) {
    $por_etapa[$e['id']] = [];
}
foreach ($projetos as $p) {
    $por_etapa[$p['etapa_id']][] = $p;
}

$titulo_pagina = 'Kanban';
require __DIR__ . '/includes/header.php';
?>
<main class="fade" style="padding:24px 0 24px 24px;height:calc(100vh - 60px);display:flex;flex-direction:column">
  <div class="kanban-toolbar">
    <div>
      <h1 style="font-size:24px;font-weight:800;letter-spacing:-.02em;margin-bottom:3px">Kanban de Projetos</h1>
      <p style="font-size:14px;color:var(--muted)">Arraste os cards entre as etapas · <?= count($projetos) ?> projetos no quadro</p>
    </div>
    <a href="projeto_form.php" class="btn btn-primary"><?= icone('plus', 16, '2.4') ?>Novo projeto</a>
  </div>

  <div class="kanban-board" id="kanbanBoard">
    <?php foreach ($etapas as $e): ?>
      <div class="kanban-column" data-etapa-id="<?= (int)$e['id'] ?>">
        <div class="kanban-column-head" style="border-top-color:<?= h($e['cor']) ?>">
          <span class="dot" style="background:<?= h($e['cor']) ?>"></span>
          <span class="kanban-column-title"><?= h($e['nome']) ?></span>
          <span class="kanban-column-count"><?= count($por_etapa[$e['id']]) ?></span>
        </div>
        <div class="kanban-column-body" data-etapa-id="<?= (int)$e['id'] ?>">
          <div class="kanban-drop-overlay"></div>
          <?php foreach ($por_etapa[$e['id']] as $p): [$corPlano, $softPlano] = plano_tag_cor($p['plano']); ?>
            <div class="kanban-card" draggable="true" data-projeto-id="<?= (int)$p['id'] ?>" style="border-left-color:<?= h($e['cor']) ?>">
              <a href="projeto_view.php?id=<?= (int)$p['id'] ?>" class="kanban-card-client"><?= h($p['cliente']) ?></a>
              <div class="kanban-card-date"><?= formatar_data($p['chegou_em']) ?></div>
              <div class="kanban-card-tags">
                <?php if ($p['plano']): ?><span class="tag" style="color:<?= $corPlano ?>;background:<?= $softPlano ?>"><?= h($p['plano']) ?></span><?php endif; ?>
                <?php if ($p['responsavel']): ?><span class="tag" style="color:var(--muted);background:var(--surface3)"><?= h($p['responsavel']) ?></span><?php endif; ?>
              </div>
              <?php if ($p['link_atendimento']): ?>
                <a href="<?= h($p['link_atendimento']) ?>" target="_blank" rel="noopener" class="kanban-card-link" onclick="event.stopPropagation()"><?= h($p['link_atendimento']) ?></a>
              <?php endif; ?>
              <?php if ($p['proximo_passo']): ?><div class="kanban-card-note"><?= h($p['proximo_passo']) ?></div><?php endif; ?>
              <?php if ($p['valor_estimado'] !== null): ?><div class="kanban-card-note" style="font-weight:700;color:var(--text)"><?= formatar_valor((float)$p['valor_estimado']) ?></div><?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<script>window.CSRF_TOKEN = <?= json_encode(csrf_token()) ?>;</script>
<script src="<?= h(asset_versionado('assets/js/kanban.js')) ?>"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>

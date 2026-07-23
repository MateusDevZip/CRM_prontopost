<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$etapas = listar_etapas();

$projetos = db()->query("
    SELECT p.id, p.valor_estimado, p.proxima_acao_data, p.etapa_id,
           c.nome cliente, pl.nome plano, u.nome responsavel
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

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Kanban de Projetos</h1>
  <a href="projeto_form.php" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Novo projeto</a>
</div>

<div class="kanban-board" id="kanbanBoard">
  <?php foreach ($etapas as $e): ?>
    <div class="kanban-coluna" data-etapa-id="<?= (int)$e['id'] ?>">
      <div class="kanban-coluna-header">
        <span><span class="dot" style="background:<?= h($e['cor']) ?>"></span><?= h($e['nome']) ?></span>
        <span class="badge text-bg-secondary"><?= count($por_etapa[$e['id']]) ?></span>
      </div>
      <div class="kanban-cards" data-etapa-id="<?= (int)$e['id'] ?>">
        <?php foreach ($por_etapa[$e['id']] as $p): ?>
          <div class="kanban-card" draggable="true" data-projeto-id="<?= (int)$p['id'] ?>" style="border-left-color:<?= h($e['cor']) ?>">
            <a href="projeto_view.php?id=<?= (int)$p['id'] ?>" class="fw-semibold text-decoration-none d-block text-truncate">
              <?= h($p['cliente']) ?>
            </a>
            <small class="d-block"><?= h($p['plano'] ?? 'sem plano') ?></small>
            <div class="d-flex justify-content-between mt-1">
              <small><?= h($p['responsavel'] ?? '-') ?></small>
              <small><?= formatar_valor($p['valor_estimado'] !== null ? (float)$p['valor_estimado'] : null) ?></small>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<script>window.CSRF_TOKEN = <?= json_encode(csrf_token()) ?>;</script>
<script src="assets/js/kanban.js"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>

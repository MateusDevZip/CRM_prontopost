<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$resumo = db()->query("
    SELECT e.id, e.nome, e.cor, e.is_final, COUNT(p.id) qtd, COALESCE(SUM(p.valor_estimado),0) valor
    FROM etapas e
    LEFT JOIN projetos p ON p.etapa_id = e.id
    GROUP BY e.id, e.nome, e.cor, e.is_final
    ORDER BY e.ordem
")->fetchAll();

$totais = db()->query("
    SELECT
      (SELECT COUNT(*) FROM clientes) total_clientes,
      (SELECT COUNT(*) FROM projetos p JOIN etapas e ON e.id = p.etapa_id WHERE e.is_final = 0) projetos_ativos,
      (SELECT COALESCE(SUM(p.valor_estimado),0) FROM projetos p JOIN etapas e ON e.id = p.etapa_id WHERE e.is_final = 0) valor_ativo
")->fetch();

$proximas_acoes = db()->query("
    SELECT p.id, c.nome cliente, p.proxima_acao_data, p.proximo_passo, e.nome etapa
    FROM projetos p
    JOIN clientes c ON c.id = p.cliente_id
    JOIN etapas e ON e.id = p.etapa_id
    WHERE p.proxima_acao_data IS NOT NULL AND e.is_final = 0
    ORDER BY p.proxima_acao_data ASC
    LIMIT 10
")->fetchAll();

$atencao = db()->query("
    SELECT p.id, c.nome cliente, e.nome etapa, p.resultado_aprovacao
    FROM projetos p
    JOIN clientes c ON c.id = p.cliente_id
    JOIN etapas e ON e.id = p.etapa_id
    WHERE p.resultado_aprovacao IS NOT NULL AND p.resultado_aprovacao <> '' AND e.is_final = 0
    ORDER BY p.atualizado_em DESC
    LIMIT 10
")->fetchAll();

$titulo_pagina = 'Dashboard';
require __DIR__ . '/includes/header.php';
?>

<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <div class="text-muted small">Total de contatos</div>
        <div class="fs-2 fw-bold"><?= (int)$totais['total_clientes'] ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <div class="text-muted small">Projetos ativos (sem cancelados)</div>
        <div class="fs-2 fw-bold"><?= (int)$totais['projetos_ativos'] ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <div class="text-muted small">Valor estimado em aberto</div>
        <div class="fs-2 fw-bold"><?= formatar_valor((float)$totais['valor_ativo']) ?></div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-header fw-semibold">Projetos por etapa</div>
      <div class="card-body">
        <?php foreach ($resumo as $r): ?>
          <div class="d-flex justify-content-between align-items-center mb-1">
            <span><span class="dot" style="background:<?= h($r['cor']) ?>"></span> <?= h($r['nome']) ?></span>
            <span class="fw-semibold"><?= (int)$r['qtd'] ?></span>
          </div>
          <div class="progress mb-3" style="height:6px;">
            <?php $max = max(array_column($resumo, 'qtd')) ?: 1; ?>
            <div class="progress-bar" style="width: <?= ((int)$r['qtd'] / $max) * 100 ?>%; background:<?= h($r['cor']) ?>"></div>
          </div>
        <?php endforeach; ?>
        <a href="kanban.php" class="btn btn-sm btn-outline-primary mt-2">Ver Kanban completo &rarr;</a>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow-sm mb-3">
      <div class="card-header fw-semibold">Próximas ações</div>
      <ul class="list-group list-group-flush">
        <?php if (!$proximas_acoes): ?>
          <li class="list-group-item text-muted">Nenhuma próxima ação cadastrada.</li>
        <?php endif; ?>
        <?php foreach ($proximas_acoes as $a): ?>
          <li class="list-group-item">
            <div class="d-flex justify-content-between">
              <a href="projeto_view.php?id=<?= (int)$a['id'] ?>"><?= h($a['cliente']) ?></a>
              <span class="badge text-bg-light"><?= formatar_data($a['proxima_acao_data']) ?></span>
            </div>
            <?php if ($a['proximo_passo']): ?><small class="text-muted"><?= h($a['proximo_passo']) ?></small><?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="card shadow-sm">
      <div class="card-header fw-semibold">Pontos de atenção (aprovação)</div>
      <ul class="list-group list-group-flush">
        <?php if (!$atencao): ?>
          <li class="list-group-item text-muted">Nenhum ponto de atenção.</li>
        <?php endif; ?>
        <?php foreach ($atencao as $a): ?>
          <li class="list-group-item">
            <a href="projeto_view.php?id=<?= (int)$a['id'] ?>"><?= h($a['cliente']) ?></a>
            <span class="text-danger small ms-2"><?= h($a['resultado_aprovacao']) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

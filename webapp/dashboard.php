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
      (SELECT COUNT(*) FROM projetos p JOIN etapas e ON e.id = p.etapa_id WHERE e.is_final = 0) projetos_ativos
")->fetch();

$proximas_acoes = db()->query("
    SELECT p.id, c.nome cliente, p.proxima_acao_data, p.proximo_passo, e.nome etapa
    FROM projetos p
    JOIN clientes c ON c.id = p.cliente_id
    JOIN etapas e ON e.id = p.etapa_id
    WHERE p.proxima_acao_data IS NOT NULL AND e.is_final = 0
    ORDER BY p.proxima_acao_data ASC
    LIMIT 6
")->fetchAll();

$atencao = db()->query("
    SELECT p.id, c.nome cliente, e.nome etapa, p.resultado_aprovacao
    FROM projetos p
    JOIN clientes c ON c.id = p.cliente_id
    JOIN etapas e ON e.id = p.etapa_id
    WHERE p.resultado_aprovacao IS NOT NULL AND p.resultado_aprovacao <> '' AND e.is_final = 0
    ORDER BY p.atualizado_em DESC
    LIMIT 6
")->fetchAll();

$maxQtd = max(array_column($resumo, 'qtd')) ?: 1;
$totalProjetos = array_sum(array_column($resumo, 'qtd')) ?: 1;

$titulo_pagina = 'Dashboard';
require __DIR__ . '/includes/header.php';
?>
<main class="fade container">
  <div class="page-header">
    <div>
      <h1>Olá, <?= h(usuario_logado()['nome']) ?> 🤌</h1>
      <p><?= date('d/m/Y') ?> · <?= count($proximas_acoes) ?> ação(ões) nas próximas datas.</p>
    </div>
    <a href="projeto_form.php" class="btn btn-primary"><?= icone('plus', 16, '2.4') ?>Novo projeto</a>
  </div>

  <div class="kpi-grid">
    <div class="kpi-card">
      <div class="kpi-head">
        <span class="kpi-label">Total de contatos</span>
        <span class="kpi-icon" style="background:var(--primary-soft);color:var(--primary)"><?= icone('people') ?></span>
      </div>
      <div class="kpi-value"><?= (int)$totais['total_clientes'] ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-head">
        <span class="kpi-label">Projetos ativos</span>
        <span class="kpi-icon" style="background:var(--ok-soft);color:var(--ok)"><?= icone('grid') ?></span>
      </div>
      <div class="kpi-value"><?= (int)$totais['projetos_ativos'] ?></div>
    </div>
  </div>

  <div class="grid-14">
    <div class="card card-pad">
      <div class="card-title">
        <h3>Produção por etapa</h3>
        <a href="kanban.php" style="font-size:12.5px;font-weight:600">Ver Kanban →</a>
      </div>
      <div class="stage-bar">
        <?php foreach ($resumo as $r): ?>
          <div title="<?= h($r['nome']) ?>" style="width:<?= ($r['qtd'] / $totalProjetos) * 100 ?>%;background:<?= h($r['cor']) ?>"></div>
        <?php endforeach; ?>
      </div>
      <div class="stage-legend">
        <?php foreach ($resumo as $r): ?>
          <div class="stage-legend-item">
            <span class="dot" style="background:<?= h($r['cor']) ?>"></span>
            <span class="name"><?= h($r['nome']) ?></span>
            <span class="count"><?= (int)$r['qtd'] ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="card card-pad">
      <h3 style="font-size:15px;font-weight:700;margin-bottom:14px">Próximas ações</h3>
      <?php if (!$proximas_acoes): ?>
        <p style="font-size:13px;color:var(--muted)">Nenhuma próxima ação cadastrada.</p>
      <?php endif; ?>
      <?php foreach ($proximas_acoes as $a): $chip = chip_data($a['proxima_acao_data']); ?>
        <a href="projeto_view.php?id=<?= (int)$a['id'] ?>" class="list-row">
          <span class="list-row-chip" style="color:<?= $chip['cor'] ?>;background:<?= $chip['soft'] ?>"><?= $chip['label'] ?></span>
          <span class="list-row-body">
            <span class="list-row-title"><?= h($a['cliente']) ?></span>
            <span class="list-row-sub"><?= h($a['proximo_passo'] ?: $a['etapa']) ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="card card-pad mt-16">
    <div class="section-title-row">
      <span class="kpi-icon" style="width:26px;height:26px;background:var(--danger-soft);color:var(--danger)"><?= icone('alert-triangle', 15, '2.2') ?></span>
      <h3 style="font-size:15px;font-weight:700">Pontos de atenção</h3>
      <?php if ($atencao): ?><span class="count-pill"><?= count($atencao) ?> cliente(s)</span><?php endif; ?>
    </div>
    <?php if (!$atencao): ?>
      <p style="font-size:13px;color:var(--muted)">Nenhum ponto de atenção.</p>
    <?php endif; ?>
    <?php foreach ($atencao as $w): ?>
      <a href="projeto_view.php?id=<?= (int)$w['id'] ?>" class="list-row">
        <span class="list-row-avatar" style="background:var(--danger-soft);color:var(--danger)"><?= h(iniciais($w['cliente'])) ?></span>
        <span class="list-row-body">
          <span class="list-row-title"><?= h($w['cliente']) ?></span>
          <span class="list-row-sub"><?= h($w['resultado_aprovacao']) ?></span>
        </span>
        <span class="list-row-tag" style="color:var(--danger);background:var(--danger-soft)"><?= h($w['etapa']) ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

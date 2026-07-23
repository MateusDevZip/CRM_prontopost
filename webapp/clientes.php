<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$busca = trim($_GET['q'] ?? '');

if ($busca !== '') {
    $stmt = db()->prepare("
        SELECT c.*, o.nome origem_nome
        FROM clientes c
        LEFT JOIN origens o ON o.id = c.origem_id
        WHERE c.nome LIKE ? OR c.telefone LIKE ? OR c.email LIKE ?
        ORDER BY c.nome
        LIMIT 500
    ");
    $termo = '%' . $busca . '%';
    $stmt->execute([$termo, $termo, $termo]);
} else {
    $stmt = db()->query("
        SELECT c.*, o.nome origem_nome
        FROM clientes c
        LEFT JOIN origens o ON o.id = c.origem_id
        ORDER BY c.nome
        LIMIT 500
    ");
}
$clientes = $stmt->fetchAll();

$idsClientes = array_column($clientes, 'id');
$projetosPorCliente = [];
if ($idsClientes) {
    $placeholders = implode(',', array_fill(0, count($idsClientes), '?'));
    $stmt = db()->prepare("
        SELECT p.id, p.cliente_id, e.nome etapa, e.cor
        FROM projetos p JOIN etapas e ON e.id = p.etapa_id
        WHERE p.cliente_id IN ($placeholders)
    ");
    $stmt->execute($idsClientes);
    foreach ($stmt->fetchAll() as $row) {
        $projetosPorCliente[$row['cliente_id']][] = $row;
    }
}

$titulo_pagina = 'Contatos';
require __DIR__ . '/includes/header.php';
?>
<main class="fade container">
  <div class="page-header">
    <div>
      <h1>Contatos</h1>
      <p><?= count($clientes) ?> clientes cadastrados</p>
    </div>
    <a href="cliente_form.php" class="btn btn-primary"><?= icone('plus', 16, '2.4') ?>Novo contato</a>
  </div>

  <div class="card">
    <div class="table-toolbar">
      <form method="get" class="table-search">
        <?= icone('search', 15, '2') ?>
        <input type="text" name="q" placeholder="Buscar por nome, telefone ou e-mail…" value="<?= h($busca) ?>">
      </form>
      <span style="font-size:12.5px;color:var(--faint);margin-left:auto"><?= count($clientes) ?> resultado(s)</span>
    </div>

    <?php if ($clientes): ?>
    <div class="table-wrap">
      <table class="data-table">
        <thead>
          <tr>
            <th>Cliente</th>
            <th>Contato</th>
            <th>Origem</th>
            <th>Etapas</th>
            <th style="text-align:right">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($clientes as $c): ?>
            <tr>
              <td>
                <div style="display:flex;align-items:center;gap:11px">
                  <span class="avatar avatar-sq" style="width:34px;height:34px;font-size:12.5px;background:<?= h(avatar_cor($c['nome'])) ?>"><?= h(iniciais($c['nome'])) ?></span>
                  <div style="font-weight:700;font-size:13.5px"><?= h($c['nome']) ?></div>
                </div>
              </td>
              <td>
                <?php if ($c['telefone']): ?><div><?= h($c['telefone']) ?></div><?php endif; ?>
                <?php if ($c['email']): ?><div style="font-size:12px;color:var(--muted)"><?= h($c['email']) ?></div><?php endif; ?>
                <?php if (!$c['telefone'] && !$c['email'] && $c['link_atendimento']): ?>
                  <a href="<?= h($c['link_atendimento']) ?>" target="_blank" rel="noopener" style="font-size:12.5px">link de atendimento</a>
                <?php endif; ?>
                <?php if (!$c['telefone'] && !$c['email'] && !$c['link_atendimento']): ?>
                  <span style="color:var(--faint)">-</span>
                <?php endif; ?>
              </td>
              <td><?= $c['origem_nome'] ? '<span class="pill-soft">' . h($c['origem_nome']) . '</span>' : '<span style="color:var(--faint)">-</span>' ?></td>
              <td>
                <?php foreach ($projetosPorCliente[$c['id']] ?? [] as $p): ?>
                  <a href="projeto_view.php?id=<?= (int)$p['id'] ?>" class="pill" style="color:<?= h($p['cor']) ?>;background:color-mix(in srgb, <?= h($p['cor']) ?> 16%, transparent);margin:2px"><?= h($p['etapa']) ?></a>
                <?php endforeach; ?>
                <?php if (empty($projetosPorCliente[$c['id']])): ?>
                  <a href="projeto_form.php?cliente_id=<?= (int)$c['id'] ?>" style="font-size:12.5px">+ criar projeto</a>
                <?php endif; ?>
              </td>
              <td style="text-align:right">
                <a href="cliente_form.php?id=<?= (int)$c['id'] ?>" class="icon-action" title="Editar"><?= icone('edit', 15) ?></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <div class="empty-state">
        <div class="empty-state-icon"><?= icone('search', 24, '1.8') ?></div>
        <p>Nenhum contato encontrado</p>
        <p>Tente outro termo de busca ou cadastre um novo contato.</p>
      </div>
    <?php endif; ?>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

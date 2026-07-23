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

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Contatos</h1>
  <a href="cliente_form.php" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Novo contato</a>
</div>

<form method="get" class="mb-3">
  <div class="input-group" style="max-width:400px;">
    <input type="text" name="q" class="form-control" placeholder="Buscar por nome, telefone ou e-mail" value="<?= h($busca) ?>">
    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-hover align-middle bg-white">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Contato</th>
        <th>Origem</th>
        <th>Projetos</th>
        <th class="text-end">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($clientes as $c): ?>
        <tr>
          <td><?= h($c['nome']) ?></td>
          <td>
            <?php if ($c['telefone']): ?><div><?= h($c['telefone']) ?></div><?php endif; ?>
            <?php if ($c['email']): ?><div class="text-muted small"><?= h($c['email']) ?></div><?php endif; ?>
            <?php if (!$c['telefone'] && !$c['email'] && $c['link_atendimento']): ?>
              <a class="small" href="<?= h($c['link_atendimento']) ?>" target="_blank" rel="noopener">link de atendimento</a>
            <?php endif; ?>
          </td>
          <td><?= h($c['origem_nome'] ?? '-') ?></td>
          <td>
            <?php foreach ($projetosPorCliente[$c['id']] ?? [] as $p): ?>
              <a href="projeto_view.php?id=<?= (int)$p['id'] ?>" class="badge text-decoration-none mb-1" style="background:<?= h($p['cor']) ?>"><?= h($p['etapa']) ?></a>
            <?php endforeach; ?>
            <?php if (empty($projetosPorCliente[$c['id']])): ?>
              <a href="projeto_form.php?cliente_id=<?= (int)$c['id'] ?>" class="small">+ criar projeto</a>
            <?php endif; ?>
          </td>
          <td class="text-end">
            <a href="cliente_form.php?id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$clientes): ?>
        <tr><td colspan="5" class="text-center text-muted py-4">Nenhum contato encontrado.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

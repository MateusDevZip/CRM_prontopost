<?php
require_once __DIR__ . '/functions.php';
$usuario = usuario_logado();
$pagina_atual = basename($_SERVER['SCRIPT_NAME']);

$grupoPorPagina = [
    'dashboard.php' => 'dashboard.php',
    'kanban.php' => 'kanban.php',
    'projeto_form.php' => 'kanban.php',
    'projeto_view.php' => 'kanban.php',
    'clientes.php' => 'clientes.php',
    'cliente_form.php' => 'clientes.php',
    'configuracoes.php' => 'configuracoes.php',
];
$grupoAtivo = $grupoPorPagina[$pagina_atual] ?? $pagina_atual;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($titulo_pagina ?? 'CRM ProntoPost') ?> · ProntoPost</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="<?= h(asset_versionado('assets/css/app.css')) ?>" rel="stylesheet">
<script>
(function () {
  try {
    var t = localStorage.getItem('pp-theme');
    if (t === 'light' || t === 'dark') document.documentElement.setAttribute('data-theme', t);
  } catch (e) {}
})();
</script>
</head>
<body>
<?php if ($usuario): ?>
<header class="topbar">
  <a href="dashboard.php" class="topbar-brand">
    <span class="topbar-logo">🤌</span>
    <span class="topbar-brand-name">ProntoPost</span>
  </a>

  <nav class="topbar-nav">
    <a href="dashboard.php" class="topbar-nav-item <?= $grupoAtivo === 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="kanban.php" class="topbar-nav-item <?= $grupoAtivo === 'kanban.php' ? 'active' : '' ?>">Kanban</a>
    <a href="clientes.php" class="topbar-nav-item <?= $grupoAtivo === 'clientes.php' ? 'active' : '' ?>">Contatos</a>
    <?php if ($usuario['papel'] === 'admin'): ?>
      <a href="configuracoes.php" class="topbar-nav-item <?= $grupoAtivo === 'configuracoes.php' ? 'active' : '' ?>">Configurações</a>
    <?php endif; ?>
  </nav>

  <div class="topbar-actions">
    <form action="clientes.php" method="get" class="topbar-search">
      <?= icone('search', 15, '2') ?>
      <input type="text" name="q" placeholder="Buscar clientes…">
    </form>
    <button type="button" class="icon-btn" id="theme-toggle-btn" title="Alternar tema">
      <span id="theme-icon-sun" style="display:flex"><?= icone('sun', 17) ?></span>
      <span id="theme-icon-moon" style="display:none"><?= icone('moon', 17) ?></span>
    </button>
    <span class="user-chip">
      <span class="avatar" style="width:28px;height:28px;font-size:12px;background:<?= h(avatar_cor($usuario['nome'])) ?>"><?= h(iniciais($usuario['nome'])) ?></span>
      <span class="user-chip-name"><?= h($usuario['nome']) ?></span>
    </span>
    <a href="logout.php" class="logout-link">Sair</a>
  </div>
</header>
<script>
(function () {
  var atual = document.documentElement.getAttribute('data-theme') || 'dark';
  document.getElementById('theme-icon-sun').style.display = atual === 'dark' ? 'flex' : 'none';
  document.getElementById('theme-icon-moon').style.display = atual === 'light' ? 'flex' : 'none';
  document.getElementById('theme-toggle-btn').addEventListener('click', function () {
    var novo = (document.documentElement.getAttribute('data-theme') || 'dark') === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', novo);
    try { localStorage.setItem('pp-theme', novo); } catch (e) {}
    document.getElementById('theme-icon-sun').style.display = novo === 'dark' ? 'flex' : 'none';
    document.getElementById('theme-icon-moon').style.display = novo === 'light' ? 'flex' : 'none';
  });
})();
</script>
<?php endif; ?>

<?php
require_once __DIR__ . '/functions.php';
$usuario = usuario_logado();
$pagina_atual = basename($_SERVER['SCRIPT_NAME']);

function nav_ativo(string $arquivo, string $atual): string
{
    return $arquivo === $atual ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($titulo_pagina ?? 'CRM ProntoPost') ?> - CRM ProntoPost</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="assets/css/app.css" rel="stylesheet">
</head>
<body>
<?php if ($usuario): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.php">ProntoPost CRM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link <?= nav_ativo('dashboard.php', $pagina_atual) ?>" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?= nav_ativo('kanban.php', $pagina_atual) ?>" href="kanban.php">Kanban</a></li>
        <li class="nav-item"><a class="nav-link <?= nav_ativo('clientes.php', $pagina_atual) ?>" href="clientes.php">Contatos</a></li>
        <?php if ($usuario['papel'] === 'admin'): ?>
        <li class="nav-item"><a class="nav-link <?= nav_ativo('configuracoes.php', $pagina_atual) ?>" href="configuracoes.php">Configurações</a></li>
        <?php endif; ?>
      </ul>
      <span class="navbar-text text-light me-3"><?= h($usuario['nome']) ?></span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
    </div>
  </div>
</nav>
<?php endif; ?>
<main class="container-fluid px-4">

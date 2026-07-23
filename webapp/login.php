<?php
require_once __DIR__ . '/includes/auth.php';

if (usuario_logado()) {
    redirecionar('dashboard.php');
}

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (tentar_login($email, $senha)) {
        redirecionar('dashboard.php');
    }
    $erro = 'E-mail ou senha inválidos.';
}

$titulo_pagina = 'Login';
require __DIR__ . '/includes/header.php';
?>
<main class="fade login-page">
  <div class="login-form-col">
    <div class="login-form-wrap">
      <div class="login-brand">
        <span class="topbar-logo">🤌</span>
        <span class="login-brand-name">ProntoPost</span>
      </div>
      <h1>Bem-vindo de volta</h1>
      <p>Entre para acompanhar a produção de conteúdo.</p>

      <?php if ($erro): ?><div class="login-error"><?= h($erro) ?></div><?php endif; ?>

      <form method="post" class="login-fields">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <div class="field">
          <label>E-mail</label>
          <input type="email" name="email" required autofocus>
        </div>
        <div class="field">
          <label>Senha</label>
          <input type="password" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="margin-top:6px">Entrar</button>
      </form>
      <p class="login-footnote">Ferramenta interna · acesso restrito à equipe ProntoPost</p>
    </div>
  </div>
  <div class="login-panel">
    <div class="blob-a"></div>
    <div class="blob-b"></div>
    <div class="login-panel-content">
      <div class="login-kicker">✦ Feito para quem cria conteúdo</div>
      <h2>Do primeiro contato ao post agendado, tudo num lugar.</h2>
      <p>Acompanhe cada cliente pelo Kanban, registre notas da equipe e nunca perca uma próxima ação.</p>
    </div>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

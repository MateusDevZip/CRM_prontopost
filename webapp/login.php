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

require_once __DIR__ . '/includes/functions.php';
$titulo_pagina = 'Login';
require __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center mt-5">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h1 class="h4 mb-4 text-center">ProntoPost CRM</h1>
        <?php if ($erro): ?>
          <div class="alert alert-danger"><?= h($erro) ?></div>
        <?php endif; ?>
        <form method="post">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>

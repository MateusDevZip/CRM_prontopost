<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$usuario = usuario_logado();
$erro = null;
$sucesso = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();

    $senhaAtual = (string)($_POST['senha_atual'] ?? '');
    $novaSenha = (string)($_POST['nova_senha'] ?? '');
    $confirmarSenha = (string)($_POST['confirmar_senha'] ?? '');

    $stmt = db()->prepare('SELECT senha_hash FROM usuarios WHERE id = ?');
    $stmt->execute([$usuario['id']]);
    $hashAtual = $stmt->fetchColumn();

    if (!password_verify($senhaAtual, $hashAtual)) {
        $erro = 'Senha atual incorreta.';
    } elseif (strlen($novaSenha) < 6) {
        $erro = 'A nova senha deve ter pelo menos 6 caracteres.';
    } elseif ($novaSenha !== $confirmarSenha) {
        $erro = 'A confirmação não confere com a nova senha.';
    } else {
        $novoHash = password_hash($novaSenha, PASSWORD_BCRYPT);
        db()->prepare('UPDATE usuarios SET senha_hash = ? WHERE id = ?')->execute([$novoHash, $usuario['id']]);
        $sucesso = 'Senha atualizada com sucesso.';
    }
}

$titulo_pagina = 'Meu perfil';
require __DIR__ . '/includes/header.php';
?>
<main class="fade container-md">
  <h1 style="font-size:23px;font-weight:800;letter-spacing:-.02em;margin-bottom:3px">Meu perfil</h1>
  <p style="font-size:14px;color:var(--muted);margin-bottom:24px">Gerencie os dados de acesso da sua conta.</p>

  <div class="card card-pad-lg" style="max-width:440px">
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px;padding-bottom:20px;border-bottom:1px solid var(--border)">
      <span class="avatar avatar-lg" style="background:<?= h(avatar_cor($usuario['nome'])) ?>"><?= h(iniciais($usuario['nome'])) ?></span>
      <div>
        <div style="font-weight:700;font-size:15px"><?= h($usuario['nome']) ?></div>
        <div style="font-size:12.5px;color:var(--muted)"><?= h($usuario['email']) ?> · <?= $usuario['papel'] === 'admin' ? 'Administrador' : 'Equipe' ?></div>
      </div>
    </div>

    <h3 style="font-size:14.5px;font-weight:700;margin-bottom:14px">Trocar senha</h3>

    <?php if ($erro): ?><div class="login-error"><?= h($erro) ?></div><?php endif; ?>
    <?php if ($sucesso): ?><div class="alert-success"><?= h($sucesso) ?></div><?php endif; ?>

    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
      <div class="field" style="margin-bottom:14px">
        <label>Senha atual</label>
        <input type="password" name="senha_atual" required autocomplete="current-password">
      </div>
      <div class="field" style="margin-bottom:14px">
        <label>Nova senha</label>
        <input type="password" name="nova_senha" required minlength="6" autocomplete="new-password">
      </div>
      <div class="field" style="margin-bottom:20px">
        <label>Confirmar nova senha</label>
        <input type="password" name="confirmar_senha" required minlength="6" autocomplete="new-password">
      </div>
      <div class="form-actions" style="justify-content:flex-start">
        <button type="submit" class="btn btn-primary">Salvar nova senha</button>
      </div>
    </form>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$cliente = [
    'nome' => '', 'telefone' => '', 'email' => '', 'link_atendimento' => '',
    'observacoes' => '', 'origem_id' => null,
];
$erro = null;

if ($id) {
    $stmt = db()->prepare('SELECT * FROM clientes WHERE id = ?');
    $stmt->execute([$id]);
    $encontrado = $stmt->fetch();
    if (!$encontrado) {
        redirecionar('clientes.php');
    }
    $cliente = $encontrado;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();

    $nome = trim($_POST['nome'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '') ?: null;
    $email = trim($_POST['email'] ?? '') ?: null;
    $link = trim($_POST['link_atendimento'] ?? '') ?: null;
    $observacoes = trim($_POST['observacoes'] ?? '') ?: null;
    $origemId = filter_input(INPUT_POST, 'origem_id', FILTER_VALIDATE_INT) ?: null;

    if ($nome === '') {
        $erro = 'O nome é obrigatório.';
        $cliente = array_merge($cliente, compact('nome', 'telefone', 'email', 'observacoes') + ['link_atendimento' => $link, 'origem_id' => $origemId]);
    } else {
        if ($id) {
            db()->prepare('UPDATE clientes SET nome=?, telefone=?, email=?, link_atendimento=?, observacoes=?, origem_id=? WHERE id=?')
                ->execute([$nome, $telefone, $email, $link, $observacoes, $origemId, $id]);
            redirecionar('clientes.php');
        } else {
            db()->prepare('INSERT INTO clientes (nome, telefone, email, link_atendimento, observacoes, origem_id) VALUES (?,?,?,?,?,?)')
                ->execute([$nome, $telefone, $email, $link, $observacoes, $origemId]);
            $novoId = (int)db()->lastInsertId();
            redirecionar('projeto_form.php?cliente_id=' . $novoId);
        }
    }
}

$origens = listar_origens();
$titulo_pagina = $id ? 'Editar contato' : 'Novo contato';
require __DIR__ . '/includes/header.php';
?>
<main class="fade container-sm">
  <a href="clientes.php" class="back-link"><?= icone('chevron-left', 15, '2.2') ?>Contatos</a>
  <h1 style="font-size:23px;font-weight:800;letter-spacing:-.02em;margin-bottom:3px"><?= h($titulo_pagina) ?></h1>
  <p style="font-size:14px;color:var(--muted);margin-bottom:24px"><?= $id ? h($cliente['nome']) : 'Cadastre um novo cliente.' ?></p>

  <?php if ($erro): ?><div class="login-error"><?= h($erro) ?></div><?php endif; ?>

  <div class="card card-pad-lg">
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
      <div class="field-grid">
        <div class="field field-span-2">
          <label>Nome do cliente *</label>
          <input type="text" name="nome" required value="<?= h($cliente['nome']) ?>">
        </div>
        <div class="field">
          <label>Telefone</label>
          <input type="text" name="telefone" value="<?= h($cliente['telefone']) ?>">
        </div>
        <div class="field">
          <label>E-mail</label>
          <input type="email" name="email" value="<?= h($cliente['email']) ?>">
        </div>
        <div class="field">
          <label>Link de atendimento</label>
          <input type="text" name="link_atendimento" value="<?= h($cliente['link_atendimento']) ?>">
        </div>
        <div class="field">
          <label>Origem</label>
          <select name="origem_id">
            <option value="">-</option>
            <?php foreach ($origens as $o): ?>
              <option value="<?= (int)$o['id'] ?>" <?= $cliente['origem_id'] == $o['id'] ? 'selected' : '' ?>><?= h($o['nome']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field field-span-2">
          <label>Observações</label>
          <textarea name="observacoes" rows="4"><?= h($cliente['observacoes']) ?></textarea>
        </div>
      </div>
      <div class="form-actions">
        <a href="clientes.php" class="btn btn-outline">Cancelar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

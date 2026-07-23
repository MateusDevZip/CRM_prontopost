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

<div class="row justify-content-center">
  <div class="col-lg-7">
    <h1 class="h4 mb-3"><?= h($titulo_pagina) ?></h1>
    <?php if ($erro): ?><div class="alert alert-danger"><?= h($erro) ?></div><?php endif; ?>
    <div class="card shadow-sm">
      <div class="card-body">
        <form method="post">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
          <div class="mb-3">
            <label class="form-label">Nome *</label>
            <input type="text" name="nome" class="form-control" required value="<?= h($cliente['nome']) ?>">
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Telefone</label>
              <input type="text" name="telefone" class="form-control" value="<?= h($cliente['telefone']) ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">E-mail</label>
              <input type="email" name="email" class="form-control" value="<?= h($cliente['email']) ?>">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Link de atendimento (egestor/zap)</label>
            <input type="text" name="link_atendimento" class="form-control" value="<?= h($cliente['link_atendimento']) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Origem</label>
            <select name="origem_id" class="form-select">
              <option value="">-</option>
              <?php foreach ($origens as $o): ?>
                <option value="<?= (int)$o['id'] ?>" <?= $cliente['origem_id'] == $o['id'] ? 'selected' : '' ?>><?= h($o['nome']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea name="observacoes" class="form-control" rows="3"><?= h($cliente['observacoes']) ?></textarea>
          </div>
          <div class="d-flex justify-content-between">
            <a href="clientes.php" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

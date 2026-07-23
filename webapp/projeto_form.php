<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$clienteIdFixo = filter_input(INPUT_GET, 'cliente_id', FILTER_VALIDATE_INT);

$projeto = [
    'cliente_id' => $clienteIdFixo, 'plano_id' => null, 'etapa_id' => null, 'responsavel_id' => null,
    'chegou_em' => date('Y-m-d'), 'mes_conteudo' => '', 'posts_no_mes' => '',
    'aprovacao_primeiro_post' => '', 'resultado_aprovacao' => '', 'proxima_acao_data' => '',
    'proximo_passo' => '', 'valor_estimado' => '',
];
$erro = null;

if ($id) {
    $stmt = db()->prepare('SELECT * FROM projetos WHERE id = ?');
    $stmt->execute([$id]);
    $encontrado = $stmt->fetch();
    if (!$encontrado) {
        redirecionar('kanban.php');
    }
    $projeto = $encontrado;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();

    $clienteId = filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT);
    $planoId = filter_input(INPUT_POST, 'plano_id', FILTER_VALIDATE_INT) ?: null;
    $etapaId = filter_input(INPUT_POST, 'etapa_id', FILTER_VALIDATE_INT);
    $responsavelId = filter_input(INPUT_POST, 'responsavel_id', FILTER_VALIDATE_INT) ?: null;
    $chegouEm = $_POST['chegou_em'] ?: null;
    $mesConteudo = trim($_POST['mes_conteudo'] ?? '') ?: null;
    $postsNoMes = filter_input(INPUT_POST, 'posts_no_mes', FILTER_VALIDATE_INT) ?: null;
    $aprovacao = $_POST['aprovacao_primeiro_post'] ?: null;
    $resultadoAprovacao = trim($_POST['resultado_aprovacao'] ?? '') ?: null;
    $proximaAcao = $_POST['proxima_acao_data'] ?: null;
    $proximoPasso = trim($_POST['proximo_passo'] ?? '') ?: null;
    $valorEstimado = $_POST['valor_estimado'] !== '' ? (float)str_replace(',', '.', $_POST['valor_estimado']) : null;

    if (!$clienteId || !$etapaId) {
        $erro = 'Cliente e etapa são obrigatórios.';
        $projeto = compact(
            'clienteId', 'planoId', 'etapaId', 'responsavelId', 'chegouEm', 'mesConteudo',
            'postsNoMes', 'aprovacao', 'resultadoAprovacao', 'proximaAcao', 'proximoPasso', 'valorEstimado'
        );
    } else {
        $pdo = db();
        if ($id) {
            $stmt = $pdo->prepare('SELECT etapa_id FROM projetos WHERE id = ?');
            $stmt->execute([$id]);
            $etapaAnteriorId = (int)$stmt->fetchColumn();

            $pdo->prepare("UPDATE projetos SET cliente_id=?, plano_id=?, etapa_id=?, responsavel_id=?, chegou_em=?, mes_conteudo=?,
                posts_no_mes=?, aprovacao_primeiro_post=?, resultado_aprovacao=?, proxima_acao_data=?, proximo_passo=?, valor_estimado=?
                WHERE id=?")
                ->execute([$clienteId, $planoId, $etapaId, $responsavelId, $chegouEm, $mesConteudo, $postsNoMes,
                    $aprovacao, $resultadoAprovacao, $proximaAcao, $proximoPasso, $valorEstimado, $id]);

            if ($etapaAnteriorId !== $etapaId) {
                $pdo->prepare('INSERT INTO projeto_historico (projeto_id, etapa_anterior_id, etapa_nova_id, usuario_id) VALUES (?,?,?,?)')
                    ->execute([$id, $etapaAnteriorId, $etapaId, usuario_logado()['id']]);
            }
            redirecionar('projeto_view.php?id=' . $id);
        } else {
            $pdo->prepare("INSERT INTO projetos (cliente_id, plano_id, etapa_id, responsavel_id, chegou_em, mes_conteudo,
                posts_no_mes, aprovacao_primeiro_post, resultado_aprovacao, proxima_acao_data, proximo_passo, valor_estimado)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)")
                ->execute([$clienteId, $planoId, $etapaId, $responsavelId, $chegouEm, $mesConteudo, $postsNoMes,
                    $aprovacao, $resultadoAprovacao, $proximaAcao, $proximoPasso, $valorEstimado]);
            $novoId = (int)$pdo->lastInsertId();
            $pdo->prepare('INSERT INTO projeto_historico (projeto_id, etapa_anterior_id, etapa_nova_id, usuario_id) VALUES (?,NULL,?,?)')
                ->execute([$novoId, $etapaId, usuario_logado()['id']]);
            redirecionar('projeto_view.php?id=' . $novoId);
        }
    }
}

$clientes = db()->query('SELECT id, nome FROM clientes ORDER BY nome')->fetchAll();
$planos = listar_planos();
$etapas = listar_etapas();
$usuarios = listar_usuarios_ativos();

if (!$projeto['etapa_id'] && $etapas) {
    $projeto['etapa_id'] = $etapas[0]['id'];
}

$titulo_pagina = $id ? 'Editar projeto' : 'Novo projeto';
require __DIR__ . '/includes/header.php';
?>

<main class="fade container-md">
  <a href="<?= $id ? 'projeto_view.php?id=' . (int)$id : 'kanban.php' ?>" class="back-link"><?= icone('chevron-left', 15, '2.2') ?>Voltar</a>
  <h1 style="font-size:23px;font-weight:800;letter-spacing:-.02em;margin-bottom:3px"><?= h($titulo_pagina) ?></h1>
  <p style="font-size:14px;color:var(--muted);margin-bottom:24px">Vincule um cliente e configure a produção do mês.</p>

  <?php if ($erro): ?><div class="login-error"><?= h($erro) ?></div><?php endif; ?>

  <div class="card card-pad-lg">
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">

      <div class="form-section-label">Geral</div>
      <div class="field-grid-3" style="margin-bottom:24px">
        <div class="field field-span-2">
          <label>Cliente *</label>
          <select name="cliente_id" required <?= $clienteIdFixo ? 'disabled' : '' ?>>
            <option value="">Selecione</option>
            <?php foreach ($clientes as $c): ?>
              <option value="<?= (int)$c['id'] ?>" <?= $projeto['cliente_id'] == $c['id'] ? 'selected' : '' ?>><?= h($c['nome']) ?></option>
            <?php endforeach; ?>
          </select>
          <?php if ($clienteIdFixo): ?>
            <input type="hidden" name="cliente_id" value="<?= (int)$clienteIdFixo ?>">
          <?php endif; ?>
        </div>
        <div class="field">
          <label>Etapa *</label>
          <select name="etapa_id" required>
            <?php foreach ($etapas as $e): ?>
              <option value="<?= (int)$e['id'] ?>" <?= $projeto['etapa_id'] == $e['id'] ? 'selected' : '' ?>><?= h($e['nome']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label>Plano</label>
          <select name="plano_id">
            <option value="">-</option>
            <?php foreach ($planos as $p): ?>
              <option value="<?= (int)$p['id'] ?>" <?= $projeto['plano_id'] == $p['id'] ? 'selected' : '' ?>><?= h($p['nome']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label>Responsável</label>
          <select name="responsavel_id">
            <option value="">-</option>
            <?php foreach ($usuarios as $u): ?>
              <option value="<?= (int)$u['id'] ?>" <?= $projeto['responsavel_id'] == $u['id'] ? 'selected' : '' ?>><?= h($u['nome']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-section-label">Datas &amp; conteúdo</div>
      <div class="field-grid-3" style="margin-bottom:24px">
        <div class="field">
          <label>Chegou em</label>
          <input type="date" name="chegou_em" value="<?= h($projeto['chegou_em']) ?>">
        </div>
        <div class="field">
          <label>Aprovação 1º post</label>
          <input type="date" name="aprovacao_primeiro_post" value="<?= h($projeto['aprovacao_primeiro_post']) ?>">
        </div>
        <div class="field">
          <label>Próxima ação</label>
          <input type="date" name="proxima_acao_data" value="<?= h($projeto['proxima_acao_data']) ?>">
        </div>
        <div class="field">
          <label>Mês de conteúdo</label>
          <input type="month" name="mes_conteudo" value="<?= h($projeto['mes_conteudo']) ?>">
        </div>
        <div class="field">
          <label>Posts no mês</label>
          <input type="number" name="posts_no_mes" value="<?= h((string)($projeto['posts_no_mes'] ?? '')) ?>">
        </div>
        <div class="field">
          <label>Resultado da aprovação</label>
          <input type="text" name="resultado_aprovacao" value="<?= h($projeto['resultado_aprovacao']) ?>">
        </div>
      </div>

      <div class="field-grid" style="grid-template-columns:1fr 220px">
        <div class="field">
          <label>Próximo passo</label>
          <textarea name="proximo_passo" rows="3"><?= h($projeto['proximo_passo']) ?></textarea>
        </div>
        <div class="field">
          <label>Valor estimado (R$)</label>
          <input type="text" name="valor_estimado" value="<?= h((string)($projeto['valor_estimado'] ?? '')) ?>">
        </div>
      </div>

      <div class="form-actions">
        <a href="<?= $id ? 'projeto_view.php?id=' . (int)$id : 'kanban.php' ?>" class="btn btn-outline">Cancelar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

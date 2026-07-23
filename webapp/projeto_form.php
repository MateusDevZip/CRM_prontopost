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

<div class="row justify-content-center">
  <div class="col-lg-8">
    <h1 class="h4 mb-3"><?= h($titulo_pagina) ?></h1>
    <?php if ($erro): ?><div class="alert alert-danger"><?= h($erro) ?></div><?php endif; ?>
    <div class="card shadow-sm">
      <div class="card-body">
        <form method="post">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Cliente *</label>
              <select name="cliente_id" class="form-select" required <?= $clienteIdFixo ? 'disabled' : '' ?>>
                <option value="">Selecione</option>
                <?php foreach ($clientes as $c): ?>
                  <option value="<?= (int)$c['id'] ?>" <?= $projeto['cliente_id'] == $c['id'] ? 'selected' : '' ?>><?= h($c['nome']) ?></option>
                <?php endforeach; ?>
              </select>
              <?php if ($clienteIdFixo): ?>
                <input type="hidden" name="cliente_id" value="<?= (int)$clienteIdFixo ?>">
              <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Etapa *</label>
              <select name="etapa_id" class="form-select" required>
                <?php foreach ($etapas as $e): ?>
                  <option value="<?= (int)$e['id'] ?>" <?= $projeto['etapa_id'] == $e['id'] ? 'selected' : '' ?>><?= h($e['nome']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Plano</label>
              <select name="plano_id" class="form-select">
                <option value="">-</option>
                <?php foreach ($planos as $p): ?>
                  <option value="<?= (int)$p['id'] ?>" <?= $projeto['plano_id'] == $p['id'] ? 'selected' : '' ?>><?= h($p['nome']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Responsável</label>
              <select name="responsavel_id" class="form-select">
                <option value="">-</option>
                <?php foreach ($usuarios as $u): ?>
                  <option value="<?= (int)$u['id'] ?>" <?= $projeto['responsavel_id'] == $u['id'] ? 'selected' : '' ?>><?= h($u['nome']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Chegou em</label>
              <input type="date" name="chegou_em" class="form-control" value="<?= h($projeto['chegou_em']) ?>">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Mês de conteúdo</label>
              <input type="month" name="mes_conteudo" class="form-control" value="<?= h($projeto['mes_conteudo']) ?>">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Posts no mês</label>
              <input type="number" name="posts_no_mes" class="form-control" value="<?= h((string)($projeto['posts_no_mes'] ?? '')) ?>">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Aprovação do 1º post</label>
              <input type="date" name="aprovacao_primeiro_post" class="form-control" value="<?= h($projeto['aprovacao_primeiro_post']) ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Resultado da aprovação</label>
              <input type="text" name="resultado_aprovacao" class="form-control" value="<?= h($projeto['resultado_aprovacao']) ?>">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Próxima ação (data)</label>
              <input type="date" name="proxima_acao_data" class="form-control" value="<?= h($projeto['proxima_acao_data']) ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Valor estimado (R$)</label>
              <input type="text" name="valor_estimado" class="form-control" value="<?= h((string)($projeto['valor_estimado'] ?? '')) ?>">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Próximo passo</label>
            <textarea name="proximo_passo" class="form-control" rows="3"><?= h($projeto['proximo_passo']) ?></textarea>
          </div>

          <div class="d-flex justify-content-between">
            <a href="<?= $id ? 'projeto_view.php?id=' . (int)$id : 'kanban.php' ?>" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

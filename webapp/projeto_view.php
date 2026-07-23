<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirecionar('kanban.php');
}

$stmt = db()->prepare("
    SELECT p.*, c.nome cliente_nome, c.telefone, c.email, c.link_atendimento,
           pl.nome plano_nome, e.nome etapa_nome, e.cor etapa_cor, u.nome responsavel_nome
    FROM projetos p
    JOIN clientes c ON c.id = p.cliente_id
    LEFT JOIN planos pl ON pl.id = p.plano_id
    JOIN etapas e ON e.id = p.etapa_id
    LEFT JOIN usuarios u ON u.id = p.responsavel_id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$projeto = $stmt->fetch();

if (!$projeto) {
    redirecionar('kanban.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['texto'])) {
    csrf_verificar();
    $texto = trim($_POST['texto']);
    if ($texto !== '') {
        db()->prepare('INSERT INTO notas (projeto_id, usuario_id, texto) VALUES (?, ?, ?)')
            ->execute([$id, usuario_logado()['id'], $texto]);
    }
    redirecionar('projeto_view.php?id=' . $id . '#notas');
}

$notas = db()->prepare("
    SELECT n.*, u.nome usuario_nome FROM notas n
    LEFT JOIN usuarios u ON u.id = n.usuario_id
    WHERE n.projeto_id = ? ORDER BY n.criado_em DESC
");
$notas->execute([$id]);
$notas = $notas->fetchAll();

$historico = db()->prepare("
    SELECT h.*, ea.nome etapa_anterior_nome, en.nome etapa_nova_nome, u.nome usuario_nome
    FROM projeto_historico h
    LEFT JOIN etapas ea ON ea.id = h.etapa_anterior_id
    JOIN etapas en ON en.id = h.etapa_nova_id
    LEFT JOIN usuarios u ON u.id = h.usuario_id
    WHERE h.projeto_id = ? ORDER BY h.criado_em DESC
");
$historico->execute([$id]);
$historico = $historico->fetchAll();

$titulo_pagina = $projeto['cliente_nome'];
require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-start mb-3">
  <div>
    <h1 class="h4 mb-1"><?= h($projeto['cliente_nome']) ?></h1>
    <span class="badge" style="background:<?= h($projeto['etapa_cor']) ?>"><?= h($projeto['etapa_nome']) ?></span>
  </div>
  <div>
    <a href="cliente_form.php?id=<?= (int)$projeto['cliente_id'] ?>" class="btn btn-sm btn-outline-secondary">Editar contato</a>
    <a href="projeto_form.php?id=<?= (int)$projeto['id'] ?>" class="btn btn-sm btn-primary">Editar projeto</a>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-7">
    <div class="card shadow-sm mb-3">
      <div class="card-header fw-semibold">Dados do projeto</div>
      <div class="card-body">
        <dl class="row mb-0">
          <dt class="col-sm-4">Plano</dt><dd class="col-sm-8"><?= h($projeto['plano_nome'] ?? '-') ?></dd>
          <dt class="col-sm-4">Responsável</dt><dd class="col-sm-8"><?= h($projeto['responsavel_nome'] ?? '-') ?></dd>
          <dt class="col-sm-4">Chegou em</dt><dd class="col-sm-8"><?= formatar_data($projeto['chegou_em']) ?></dd>
          <dt class="col-sm-4">Mês de conteúdo</dt><dd class="col-sm-8"><?= h($projeto['mes_conteudo'] ?? '-') ?></dd>
          <dt class="col-sm-4">Posts no mês</dt><dd class="col-sm-8"><?= h((string)($projeto['posts_no_mes'] ?? '-')) ?></dd>
          <dt class="col-sm-4">Aprovação 1º post</dt><dd class="col-sm-8"><?= formatar_data($projeto['aprovacao_primeiro_post']) ?></dd>
          <dt class="col-sm-4">Resultado aprovação</dt><dd class="col-sm-8"><?= h($projeto['resultado_aprovacao'] ?? '-') ?></dd>
          <dt class="col-sm-4">Próxima ação</dt><dd class="col-sm-8"><?= formatar_data($projeto['proxima_acao_data']) ?></dd>
          <dt class="col-sm-4">Próximo passo</dt><dd class="col-sm-8"><?= nl2br(h($projeto['proximo_passo'] ?? '-')) ?></dd>
          <dt class="col-sm-4">Valor estimado</dt><dd class="col-sm-8"><?= formatar_valor($projeto['valor_estimado'] !== null ? (float)$projeto['valor_estimado'] : null) ?></dd>
        </dl>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-header fw-semibold">Contato</div>
      <div class="card-body">
        <dl class="row mb-0">
          <dt class="col-sm-4">Telefone</dt><dd class="col-sm-8"><?= h($projeto['telefone'] ?? '-') ?></dd>
          <dt class="col-sm-4">E-mail</dt><dd class="col-sm-8"><?= h($projeto['email'] ?? '-') ?></dd>
          <dt class="col-sm-4">Link de atendimento</dt>
          <dd class="col-sm-8">
            <?php if ($projeto['link_atendimento']): ?>
              <a href="<?= h($projeto['link_atendimento']) ?>" target="_blank" rel="noopener"><?= h($projeto['link_atendimento']) ?></a>
            <?php else: ?>-<?php endif; ?>
          </dd>
        </dl>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card shadow-sm mb-3" id="notas">
      <div class="card-header fw-semibold">Notas</div>
      <div class="card-body">
        <form method="post" class="mb-3">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
          <textarea name="texto" class="form-control mb-2" rows="2" placeholder="Adicionar anotação..." required></textarea>
          <button type="submit" class="btn btn-sm btn-primary">Adicionar</button>
        </form>
        <?php if (!$notas): ?>
          <p class="text-muted small mb-0">Nenhuma nota ainda.</p>
        <?php endif; ?>
        <?php foreach ($notas as $n): ?>
          <div class="border-bottom pb-2 mb-2">
            <div class="small text-muted"><?= h($n['usuario_nome'] ?? 'Sistema') ?> - <?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></div>
            <div><?= nl2br(h($n['texto'])) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-header fw-semibold">Histórico de etapas</div>
      <ul class="list-group list-group-flush">
        <?php foreach ($historico as $h): ?>
          <li class="list-group-item small">
            <?= h($h['etapa_anterior_nome'] ?? 'Criado') ?> &rarr; <strong><?= h($h['etapa_nova_nome']) ?></strong>
            <div class="text-muted"><?= h($h['usuario_nome'] ?? 'Sistema') ?> - <?= date('d/m/Y H:i', strtotime($h['criado_em'])) ?></div>
          </li>
        <?php endforeach; ?>
        <?php if (!$historico): ?>
          <li class="list-group-item text-muted small">Sem histórico.</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

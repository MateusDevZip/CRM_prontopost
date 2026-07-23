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

$campos = [
    'Plano' => $projeto['plano_nome'] ?? '-',
    'Responsável' => $projeto['responsavel_nome'] ?? '-',
    'Chegou em' => formatar_data($projeto['chegou_em']),
    'Aprovação 1º post' => formatar_data($projeto['aprovacao_primeiro_post']),
    'Resultado aprovação' => $projeto['resultado_aprovacao'] ?? '-',
    'Mês de conteúdo' => $projeto['mes_conteudo'] ?? '-',
    'Posts no mês' => $projeto['posts_no_mes'] !== null ? (string)$projeto['posts_no_mes'] : '-',
    'Valor estimado' => formatar_valor($projeto['valor_estimado'] !== null ? (float)$projeto['valor_estimado'] : null),
];

$titulo_pagina = $projeto['cliente_nome'];
require __DIR__ . '/includes/header.php';
?>
<main class="fade container">
  <a href="kanban.php" class="back-link"><?= icone('chevron-left', 15, '2.2') ?>Kanban</a>
  <div class="page-header" style="align-items:flex-start">
    <div style="display:flex;align-items:center;gap:14px">
      <span class="avatar avatar-lg"><?= h(iniciais($projeto['cliente_nome'])) ?></span>
      <div>
        <h1 style="font-size:23px;margin-bottom:5px"><?= h($projeto['cliente_nome']) ?></h1>
        <span class="badge" style="color:<?= h($projeto['etapa_cor']) ?>;background:color-mix(in srgb, <?= h($projeto['etapa_cor']) ?> 14%, transparent)">
          <span class="badge-dot" style="background:<?= h($projeto['etapa_cor']) ?>"></span><?= h($projeto['etapa_nome']) ?>
        </span>
      </div>
    </div>
    <div style="display:flex;gap:10px">
      <a href="cliente_form.php?id=<?= (int)$projeto['cliente_id'] ?>" class="btn btn-outline">Editar contato</a>
      <a href="projeto_form.php?id=<?= (int)$projeto['id'] ?>" class="btn btn-primary"><?= icone('edit', 15) ?>Editar projeto</a>
    </div>
  </div>

  <div class="two-col">
    <div class="stack-16">
      <div class="card card-pad">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:16px">Dados do projeto</h3>
        <div class="detail-grid">
          <?php foreach ($campos as $label => $valor): ?>
            <div class="detail-field">
              <div class="label"><?= h($label) ?></div>
              <div class="value"><?= h($valor) ?></div>
            </div>
          <?php endforeach; ?>
        </div>
        <div style="margin-top:18px;padding-top:16px;border-top:1px solid var(--border)">
          <div class="detail-field">
            <div class="label">Próximo passo</div>
            <div class="value" style="font-weight:400;line-height:1.5"><?= nl2br(h($projeto['proximo_passo'] ?: '-')) ?></div>
          </div>
        </div>
      </div>

      <div class="card card-pad">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:16px">Contato do cliente</h3>
        <div class="stack-16" style="gap:13px">
          <div class="contact-row">
            <span class="icon-wrap"><?= icone('phone', 15) ?></span>
            <span class="value"><?= h($projeto['telefone'] ?? '-') ?></span>
          </div>
          <div class="contact-row">
            <span class="icon-wrap"><?= icone('mail', 15) ?></span>
            <span class="value"><?= h($projeto['email'] ?? '-') ?></span>
          </div>
          <div class="contact-row">
            <span class="icon-wrap"><?= icone('link', 15) ?></span>
            <?php if ($projeto['link_atendimento']): ?>
              <a href="<?= h($projeto['link_atendimento']) ?>" target="_blank" rel="noopener" class="value">Abrir atendimento →</a>
            <?php else: ?>
              <span class="value">-</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="stack-16">
      <div class="card card-pad" id="notas">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:14px">Notas da equipe</h3>
        <form method="post" class="note-composer">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
          <input type="text" name="texto" placeholder="Adicionar uma nota…" required>
          <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
        </form>
        <div>
          <?php if (!$notas): ?><p style="font-size:13px;color:var(--muted)">Nenhuma nota ainda.</p><?php endif; ?>
          <?php foreach ($notas as $n): ?>
            <div class="note-item">
              <span class="avatar" style="width:32px;height:32px;font-size:11.5px;background:<?= h(avatar_cor($n['usuario_nome'] ?? 'Sistema')) ?>"><?= h(iniciais($n['usuario_nome'] ?? 'Sistema')) ?></span>
              <div style="flex:1">
                <span class="note-author"><?= h($n['usuario_nome'] ?? 'Sistema') ?></span>
                <span class="note-time"><?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></span>
                <div class="note-text"><?= nl2br(h($n['texto'])) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="card card-pad">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:16px">Histórico de etapas</h3>
        <?php if (!$historico): ?><p style="font-size:13px;color:var(--muted)">Sem histórico.</p><?php endif; ?>
        <div class="timeline">
          <?php foreach ($historico as $ev): ?>
            <div class="timeline-item">
              <span class="timeline-dot" style="background:<?= h($ev['etapa_nova_nome'] ? '#7c6cff' : '#7c6cff') ?>"></span>
              <div class="timeline-text"><strong><?= h($ev['usuario_nome'] ?? 'Sistema') ?></strong> moveu <?= h($ev['etapa_anterior_nome'] ?? 'criação') ?> → <strong><?= h($ev['etapa_nova_nome']) ?></strong></div>
              <div class="timeline-time"><?= date('d/m/Y H:i', strtotime($ev['criado_em'])) ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

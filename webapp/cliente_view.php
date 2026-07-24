<?php
require_once __DIR__ . '/includes/auth.php';
exigir_login();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirecionar('clientes.php');
}

$stmt = db()->prepare('SELECT c.*, o.nome origem_nome FROM clientes c LEFT JOIN origens o ON o.id = c.origem_id WHERE c.id = ?');
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if (!$cliente) {
    redirecionar('clientes.php');
}

$projetos = db()->prepare("
    SELECT p.id, p.chegou_em, p.proxima_acao_data, p.proximo_passo, p.valor_estimado,
           e.nome etapa_nome, e.cor etapa_cor, pl.nome plano_nome, u.nome responsavel_nome
    FROM projetos p
    JOIN etapas e ON e.id = p.etapa_id
    LEFT JOIN planos pl ON pl.id = p.plano_id
    LEFT JOIN usuarios u ON u.id = p.responsavel_id
    WHERE p.cliente_id = ?
    ORDER BY p.criado_em DESC
");
$projetos->execute([$id]);
$projetos = $projetos->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['texto'])) {
    csrf_verificar();
    $texto = trim($_POST['texto']);
    $projetoIdNota = filter_input(INPUT_POST, 'projeto_id', FILTER_VALIDATE_INT);
    $pertence = $projetoIdNota && in_array($projetoIdNota, array_column($projetos, 'id'), true);
    if ($texto !== '' && $pertence) {
        db()->prepare('INSERT INTO notas (projeto_id, usuario_id, texto) VALUES (?, ?, ?)')
            ->execute([$projetoIdNota, usuario_logado()['id'], $texto]);
    }
    redirecionar('cliente_view.php?id=' . $id . '#notas');
}

$idsProjetos = array_column($projetos, 'id');
$notas = [];
if ($idsProjetos) {
    $placeholders = implode(',', array_fill(0, count($idsProjetos), '?'));
    $stmt = db()->prepare("
        SELECT n.texto, n.criado_em, n.projeto_id, u.nome usuario_nome
        FROM notas n
        LEFT JOIN usuarios u ON u.id = n.usuario_id
        WHERE n.projeto_id IN ($placeholders)
        ORDER BY n.criado_em DESC
    ");
    $stmt->execute($idsProjetos);
    $notas = $stmt->fetchAll();
}

$titulo_pagina = $cliente['nome'];
require __DIR__ . '/includes/header.php';
?>
<main class="fade container">
  <a href="clientes.php" class="back-link"><?= icone('chevron-left', 15, '2.2') ?>Contatos</a>
  <div class="page-header" style="align-items:flex-start">
    <div style="display:flex;align-items:center;gap:14px">
      <span class="avatar avatar-lg" style="background:<?= h(avatar_cor($cliente['nome'])) ?>"><?= h(iniciais($cliente['nome'])) ?></span>
      <div>
        <h1 style="font-size:23px;margin-bottom:5px"><?= h($cliente['nome']) ?></h1>
        <?php if ($cliente['origem_nome']): ?><span class="pill-soft"><?= h($cliente['origem_nome']) ?></span><?php endif; ?>
      </div>
    </div>
    <div style="display:flex;gap:10px">
      <a href="cliente_form.php?id=<?= (int)$cliente['id'] ?>" class="btn btn-outline"><?= icone('edit', 15) ?>Editar contato</a>
      <a href="projeto_form.php?cliente_id=<?= (int)$cliente['id'] ?>" class="btn btn-primary"><?= icone('plus', 16, '2.4') ?>Novo projeto</a>
    </div>
  </div>

  <div class="two-col">
    <div class="stack-16">
      <div class="card card-pad">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:16px">Dados do cliente</h3>
        <div class="stack-16" style="gap:13px">
          <div class="contact-row">
            <span class="icon-wrap"><?= icone('phone', 15) ?></span>
            <span class="value"><?= h($cliente['telefone'] ?? '-') ?></span>
          </div>
          <div class="contact-row">
            <span class="icon-wrap"><?= icone('mail', 15) ?></span>
            <span class="value"><?= h($cliente['email'] ?? '-') ?></span>
          </div>
          <div class="contact-row">
            <span class="icon-wrap"><?= icone('link', 15) ?></span>
            <?php if ($cliente['link_atendimento']): ?>
              <a href="<?= h($cliente['link_atendimento']) ?>" target="_blank" rel="noopener" class="value">Abrir atendimento →</a>
            <?php else: ?>
              <span class="value">-</span>
            <?php endif; ?>
          </div>
        </div>
        <?php if ($cliente['observacoes']): ?>
          <div style="margin-top:18px;padding-top:16px;border-top:1px solid var(--border)">
            <div class="detail-field">
              <div class="label">Observações</div>
              <div class="value" style="font-weight:400;line-height:1.5"><?= nl2br(h($cliente['observacoes'])) ?></div>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <div class="card card-pad">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:14px">Projetos <span class="count-pill" style="color:var(--muted);background:var(--surface3)"><?= count($projetos) ?></span></h3>
        <?php if (!$projetos): ?>
          <p style="font-size:13px;color:var(--muted)">Nenhum projeto cadastrado ainda.</p>
        <?php endif; ?>
        <?php foreach ($projetos as $p): ?>
          <a href="projeto_view.php?id=<?= (int)$p['id'] ?>" class="list-row">
            <span class="badge" style="color:<?= h($p['etapa_cor']) ?>;background:color-mix(in srgb, <?= h($p['etapa_cor']) ?> 14%, transparent)">
              <span class="badge-dot" style="background:<?= h($p['etapa_cor']) ?>"></span><?= h($p['etapa_nome']) ?>
            </span>
            <span class="list-row-body">
              <span class="list-row-title"><?= h($p['plano_nome'] ?: 'Sem plano') ?></span>
              <span class="list-row-sub">Chegou em <?= formatar_data($p['chegou_em']) ?><?= $p['responsavel_nome'] ? ' · ' . h($p['responsavel_nome']) : '' ?></span>
            </span>
            <span class="list-row-tag" style="color:var(--text);background:var(--surface3)"><?= h(formatar_valor($p['valor_estimado'] !== null ? (float)$p['valor_estimado'] : null)) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="stack-16">
      <div class="card card-pad" id="notas">
        <h3 style="font-size:15px;font-weight:700;margin-bottom:14px">Notas da equipe <span class="count-pill" style="color:var(--muted);background:var(--surface3)"><?= count($notas) ?></span></h3>

        <?php if (!$projetos): ?>
          <p style="font-size:13px;color:var(--muted);margin-bottom:16px">Cadastre um projeto para começar a registrar notas.</p>
        <?php else: ?>
          <form method="post" class="note-composer">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <?php if (count($projetos) === 1): ?>
              <input type="hidden" name="projeto_id" value="<?= (int)$projetos[0]['id'] ?>">
            <?php else: ?>
              <select name="projeto_id" style="flex:none;max-width:170px">
                <?php foreach ($projetos as $p): ?>
                  <option value="<?= (int)$p['id'] ?>"><?= h($p['plano_nome'] ?: 'Projeto') ?> · <?= h($p['etapa_nome']) ?></option>
                <?php endforeach; ?>
              </select>
            <?php endif; ?>
            <input type="text" name="texto" placeholder="Adicionar uma nota…" required>
            <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
          </form>
        <?php endif; ?>

        <?php if (!$notas): ?><p style="font-size:13px;color:var(--muted)">Nenhuma nota ainda.</p><?php endif; ?>
        <?php foreach ($notas as $n): ?>
          <div class="note-item">
            <span class="avatar" style="width:32px;height:32px;font-size:11.5px;background:<?= h(avatar_cor($n['usuario_nome'] ?? 'Sistema')) ?>"><?= h(iniciais($n['usuario_nome'] ?? 'Sistema')) ?></span>
            <div style="flex:1">
              <span class="note-author"><?= h($n['usuario_nome'] ?? 'Sistema') ?></span>
              <span class="note-time"><?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></span>
              <div class="note-text"><?= nl2br(h($n['texto'])) ?></div>
              <a href="projeto_view.php?id=<?= (int)$n['projeto_id'] ?>#notas" style="font-size:11.5px">Ver projeto →</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

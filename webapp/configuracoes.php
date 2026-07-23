<?php
require_once __DIR__ . '/includes/auth.php';
exigir_admin();

$pdo = db();
$erro = null;
$aba = $_GET['aba'] ?? 'etapas';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $entidade = $_POST['entidade'] ?? '';
    $acao = $_POST['acao'] ?? '';
    $abasPorEntidade = ['etapa' => 'etapas', 'plano' => 'planos', 'origem' => 'origens', 'usuario' => 'usuarios'];
    $aba = $abasPorEntidade[$entidade] ?? 'etapas';

    try {
        if ($entidade === 'etapa') {
            if ($acao === 'criar') {
                $pdo->prepare('INSERT INTO etapas (nome, ordem, cor, is_final) VALUES (?,?,?,?)')
                    ->execute([trim($_POST['nome']), (int)$_POST['ordem'], $_POST['cor'], isset($_POST['is_final']) ? 1 : 0]);
            } elseif ($acao === 'editar') {
                $pdo->prepare('UPDATE etapas SET nome=?, ordem=?, cor=?, is_final=? WHERE id=?')
                    ->execute([trim($_POST['nome']), (int)$_POST['ordem'], $_POST['cor'], isset($_POST['is_final']) ? 1 : 0, (int)$_POST['id']]);
            } elseif ($acao === 'excluir') {
                $pdo->prepare('DELETE FROM etapas WHERE id=?')->execute([(int)$_POST['id']]);
            }
        } elseif ($entidade === 'plano') {
            if ($acao === 'criar') {
                $pdo->prepare('INSERT INTO planos (nome, posts_por_mes, valor_padrao) VALUES (?,?,?)')
                    ->execute([trim($_POST['nome']), $_POST['posts_por_mes'] ?: null, $_POST['valor_padrao'] !== '' ? (float)str_replace(',', '.', $_POST['valor_padrao']) : null]);
            } elseif ($acao === 'editar') {
                $pdo->prepare('UPDATE planos SET nome=?, posts_por_mes=?, valor_padrao=? WHERE id=?')
                    ->execute([trim($_POST['nome']), $_POST['posts_por_mes'] ?: null, $_POST['valor_padrao'] !== '' ? (float)str_replace(',', '.', $_POST['valor_padrao']) : null, (int)$_POST['id']]);
            } elseif ($acao === 'excluir') {
                $pdo->prepare('DELETE FROM planos WHERE id=?')->execute([(int)$_POST['id']]);
            }
        } elseif ($entidade === 'origem') {
            if ($acao === 'criar') {
                $pdo->prepare('INSERT INTO origens (nome) VALUES (?)')->execute([trim($_POST['nome'])]);
            } elseif ($acao === 'editar') {
                $pdo->prepare('UPDATE origens SET nome=? WHERE id=?')->execute([trim($_POST['nome']), (int)$_POST['id']]);
            } elseif ($acao === 'excluir') {
                $pdo->prepare('DELETE FROM origens WHERE id=?')->execute([(int)$_POST['id']]);
            }
        } elseif ($entidade === 'usuario') {
            if ($acao === 'criar') {
                $hash = password_hash($_POST['senha'], PASSWORD_BCRYPT);
                $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash, papel, ativo) VALUES (?,?,?,?,1)')
                    ->execute([trim($_POST['nome']), trim($_POST['email']), $hash, $_POST['papel']]);
            } elseif ($acao === 'editar') {
                if (!empty($_POST['senha'])) {
                    $hash = password_hash($_POST['senha'], PASSWORD_BCRYPT);
                    $pdo->prepare('UPDATE usuarios SET nome=?, email=?, papel=?, senha_hash=? WHERE id=?')
                        ->execute([trim($_POST['nome']), trim($_POST['email']), $_POST['papel'], $hash, (int)$_POST['id']]);
                } else {
                    $pdo->prepare('UPDATE usuarios SET nome=?, email=?, papel=? WHERE id=?')
                        ->execute([trim($_POST['nome']), trim($_POST['email']), $_POST['papel'], (int)$_POST['id']]);
                }
            } elseif ($acao === 'alternar_ativo') {
                $pdo->prepare('UPDATE usuarios SET ativo = 1 - ativo WHERE id=?')->execute([(int)$_POST['id']]);
            }
        }
    } catch (Throwable $e) {
        $erro = 'Não foi possível concluir: verifique se este item ainda está em uso em algum projeto.';
    }

    if (!$erro) {
        redirecionar('configuracoes.php?aba=' . $aba);
    }
}

$etapas = listar_etapas();
$planos = listar_planos();
$origensComContagem = $pdo->query("
    SELECT o.*, COUNT(c.id) total_clientes FROM origens o
    LEFT JOIN clientes c ON c.origem_id = o.id
    GROUP BY o.id ORDER BY o.nome
")->fetchAll();
$usuarios = $pdo->query('SELECT * FROM usuarios ORDER BY nome')->fetchAll();

$titulo_pagina = 'Configurações';
require __DIR__ . '/includes/header.php';

$tabDefs = [
    'etapas' => 'Etapas do Kanban',
    'planos' => 'Planos',
    'origens' => 'Origens',
    'usuarios' => 'Usuários',
];
?>
<main class="fade container-lg">
  <h1 style="font-size:24px;font-weight:800;letter-spacing:-.02em;margin-bottom:3px">Configurações</h1>
  <p style="font-size:14px;color:var(--muted);margin-bottom:22px">Gerencie as bases do sistema · área de administrador</p>

  <?php if ($erro): ?><div class="login-error"><?= h($erro) ?></div><?php endif; ?>

  <div class="tabs">
    <?php foreach ($tabDefs as $chave => $label): ?>
      <a href="?aba=<?= $chave ?>" class="tab-btn <?= $aba === $chave ? 'active' : '' ?>"><?= h($label) ?></a>
    <?php endforeach; ?>
  </div>

  <div class="card">
    <?php if ($aba === 'etapas'): ?>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Ordem</th><th>Nome da etapa</th><th>Cor</th><th>Etapa final</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($etapas as $e): ?>
            <tr>
              <td style="width:70px">
                <form method="post" id="etapa-<?= (int)$e['id'] ?>">
                  <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                  <input type="hidden" name="entidade" value="etapa">
                  <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">
                  <input type="number" name="ordem" form="etapa-<?= (int)$e['id'] ?>" class="cell-inline-input" style="width:56px" value="<?= (int)$e['ordem'] ?>">
                </form>
              </td>
              <td><input type="text" name="nome" form="etapa-<?= (int)$e['id'] ?>" class="cell-inline-input" value="<?= h($e['nome']) ?>"></td>
              <td>
                <span style="display:inline-flex;align-items:center;gap:8px">
                  <input type="color" name="cor" form="etapa-<?= (int)$e['id'] ?>" value="<?= h($e['cor']) ?>" style="width:22px;height:22px;padding:0;border:none;border-radius:7px;background:none;cursor:pointer">
                  <span style="font-size:12px;color:var(--faint);font-variant-numeric:tabular-nums"><?= h(strtoupper($e['cor'])) ?></span>
                </span>
              </td>
              <td>
                <label class="toggle">
                  <input type="checkbox" name="is_final" form="etapa-<?= (int)$e['id'] ?>" <?= $e['is_final'] ? 'checked' : '' ?>>
                  <span class="toggle-track"></span>
                  <span class="toggle-thumb"></span>
                </label>
              </td>
              <td style="text-align:right;white-space:nowrap">
                <button type="submit" name="acao" value="editar" form="etapa-<?= (int)$e['id'] ?>" class="btn btn-outline btn-sm">Salvar</button>
                <button type="submit" name="acao" value="excluir" form="etapa-<?= (int)$e['id'] ?>" class="icon-action danger" title="Remover" onclick="return confirm('Excluir esta etapa?')"><?= icone('trash', 14) ?></button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <form method="post" class="table-add-row">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="etapa">
        <input type="hidden" name="acao" value="criar">
        <input type="number" name="ordem" placeholder="Ordem" value="<?= count($etapas) + 1 ?>" style="width:80px">
        <input type="text" name="nome" placeholder="Nome da nova etapa" style="flex:1;min-width:160px" required>
        <input type="color" name="cor" value="#7c6cff" style="width:42px;height:38px;padding:2px;cursor:pointer">
        <button type="submit" class="btn btn-primary btn-sm"><?= icone('plus', 15, '2.4') ?>Adicionar etapa</button>
      </form>

    <?php elseif ($aba === 'planos'): ?>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Plano</th><th>Posts / mês</th><th>Valor padrão</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($planos as $p): ?>
            <tr>
              <td>
                <form method="post" id="plano-<?= (int)$p['id'] ?>">
                  <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                  <input type="hidden" name="entidade" value="plano">
                  <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                </form>
                <input type="text" name="nome" form="plano-<?= (int)$p['id'] ?>" class="cell-inline-input" value="<?= h($p['nome']) ?>">
              </td>
              <td><input type="number" name="posts_por_mes" form="plano-<?= (int)$p['id'] ?>" class="cell-inline-input" style="width:80px" value="<?= h((string)($p['posts_por_mes'] ?? '')) ?>"></td>
              <td><input type="text" name="valor_padrao" form="plano-<?= (int)$p['id'] ?>" class="cell-inline-input" style="width:130px" value="<?= h((string)($p['valor_padrao'] ?? '')) ?>"></td>
              <td style="text-align:right;white-space:nowrap">
                <button type="submit" name="acao" value="editar" form="plano-<?= (int)$p['id'] ?>" class="btn btn-outline btn-sm">Salvar</button>
                <button type="submit" name="acao" value="excluir" form="plano-<?= (int)$p['id'] ?>" class="icon-action danger" title="Remover" onclick="return confirm('Excluir este plano?')"><?= icone('trash', 14) ?></button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <form method="post" class="table-add-row">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="plano">
        <input type="hidden" name="acao" value="criar">
        <input type="text" name="nome" placeholder="Nome do plano" style="flex:1;min-width:140px" required>
        <input type="number" name="posts_por_mes" placeholder="Posts" style="width:90px">
        <input type="text" name="valor_padrao" placeholder="R$ 0,00" style="width:120px">
        <button type="submit" class="btn btn-primary btn-sm"><?= icone('plus', 15, '2.4') ?>Adicionar plano</button>
      </form>

    <?php elseif ($aba === 'origens'): ?>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Origem</th><th>Clientes</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($origensComContagem as $o): ?>
            <tr>
              <td>
                <form method="post" id="origem-<?= (int)$o['id'] ?>">
                  <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                  <input type="hidden" name="entidade" value="origem">
                  <input type="hidden" name="id" value="<?= (int)$o['id'] ?>">
                </form>
                <input type="text" name="nome" form="origem-<?= (int)$o['id'] ?>" class="cell-inline-input" value="<?= h($o['nome']) ?>">
              </td>
              <td><span style="font-size:13px;color:var(--muted);font-variant-numeric:tabular-nums"><?= (int)$o['total_clientes'] ?></span></td>
              <td style="text-align:right;white-space:nowrap">
                <button type="submit" name="acao" value="editar" form="origem-<?= (int)$o['id'] ?>" class="btn btn-outline btn-sm">Salvar</button>
                <button type="submit" name="acao" value="excluir" form="origem-<?= (int)$o['id'] ?>" class="icon-action danger" title="Remover" onclick="return confirm('Excluir esta origem?')"><?= icone('trash', 14) ?></button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <form method="post" class="table-add-row">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="origem">
        <input type="hidden" name="acao" value="criar">
        <input type="text" name="nome" placeholder="Nome da origem" style="flex:1;max-width:280px" required>
        <button type="submit" class="btn btn-primary btn-sm"><?= icone('plus', 15, '2.4') ?>Adicionar origem</button>
      </form>

    <?php elseif ($aba === 'usuarios'): ?>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Usuário</th><th>Papel</th><th>Nova senha</th><th>Status</th><th style="text-align:right">Ações</th></tr></thead>
          <tbody>
          <?php foreach ($usuarios as $u): ?>
            <tr>
              <td>
                <form method="post" id="usuario-<?= (int)$u['id'] ?>">
                  <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                  <input type="hidden" name="entidade" value="usuario">
                  <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                </form>
                <div style="display:flex;align-items:center;gap:11px">
                  <span class="avatar" style="width:34px;height:34px;font-size:12.5px;background:<?= h(avatar_cor($u['nome'])) ?>"><?= h(iniciais($u['nome'])) ?></span>
                  <div>
                    <input type="text" name="nome" form="usuario-<?= (int)$u['id'] ?>" class="cell-inline-input" style="font-weight:700" value="<?= h($u['nome']) ?>">
                    <input type="email" name="email" form="usuario-<?= (int)$u['id'] ?>" class="cell-inline-input" style="font-size:12px;color:var(--muted)" value="<?= h($u['email']) ?>">
                  </div>
                </div>
              </td>
              <td style="width:120px">
                <select name="papel" form="usuario-<?= (int)$u['id'] ?>" class="cell-inline-input">
                  <option value="equipe" <?= $u['papel'] === 'equipe' ? 'selected' : '' ?>>Equipe</option>
                  <option value="admin" <?= $u['papel'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
              </td>
              <td style="width:150px"><input type="password" name="senha" form="usuario-<?= (int)$u['id'] ?>" class="cell-inline-input" placeholder="(manter atual)"></td>
              <td>
                <span style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:600;color:<?= $u['ativo'] ? 'var(--ok)' : 'var(--faint)' ?>">
                  <span style="width:7px;height:7px;border-radius:50%;background:<?= $u['ativo'] ? 'var(--ok)' : 'var(--faint)' ?>"></span><?= $u['ativo'] ? 'Ativo' : 'Inativo' ?>
                </span>
              </td>
              <td style="text-align:right;white-space:nowrap">
                <button type="submit" name="acao" value="editar" form="usuario-<?= (int)$u['id'] ?>" class="btn btn-outline btn-sm">Salvar</button>
                <button type="submit" name="acao" value="alternar_ativo" form="usuario-<?= (int)$u['id'] ?>" class="btn btn-outline btn-sm" style="color:<?= $u['ativo'] ? 'var(--danger)' : 'var(--ok)' ?>"><?= $u['ativo'] ? 'Desativar' : 'Ativar' ?></button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <form method="post" class="table-add-row">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="usuario">
        <input type="hidden" name="acao" value="criar">
        <input type="text" name="nome" placeholder="Nome" style="flex:1;min-width:120px" required>
        <input type="email" name="email" placeholder="E-mail" style="flex:1.4;min-width:160px" required>
        <select name="papel">
          <option value="equipe">Equipe</option>
          <option value="admin">Admin</option>
        </select>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" class="btn btn-primary btn-sm"><?= icone('plus', 15, '2.4') ?>Adicionar usuário</button>
      </form>
    <?php endif; ?>
  </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

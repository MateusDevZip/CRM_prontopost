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
$origens = listar_origens();
$usuarios = $pdo->query('SELECT * FROM usuarios ORDER BY nome')->fetchAll();

$titulo_pagina = 'Configurações';
require __DIR__ . '/includes/header.php';
?>

<h1 class="h4 mb-3">Configurações</h1>
<?php if ($erro): ?><div class="alert alert-danger"><?= h($erro) ?></div><?php endif; ?>

<ul class="nav nav-tabs mb-3">
  <li class="nav-item"><a class="nav-link <?= $aba === 'etapas' ? 'active' : '' ?>" href="?aba=etapas">Etapas (Kanban)</a></li>
  <li class="nav-item"><a class="nav-link <?= $aba === 'planos' ? 'active' : '' ?>" href="?aba=planos">Planos</a></li>
  <li class="nav-item"><a class="nav-link <?= $aba === 'origens' ? 'active' : '' ?>" href="?aba=origens">Origens</a></li>
  <li class="nav-item"><a class="nav-link <?= $aba === 'usuarios' ? 'active' : '' ?>" href="?aba=usuarios">Usuários</a></li>
</ul>

<?php if ($aba === 'etapas'): ?>
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <table class="table align-middle">
        <thead><tr><th>Ordem</th><th>Nome</th><th>Cor</th><th>Final?</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($etapas as $e): ?>
          <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <input type="hidden" name="entidade" value="etapa">
            <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">
            <tr>
              <td style="width:90px"><input type="number" name="ordem" class="form-control form-control-sm" value="<?= (int)$e['ordem'] ?>"></td>
              <td><input type="text" name="nome" class="form-control form-control-sm" value="<?= h($e['nome']) ?>"></td>
              <td style="width:70px"><input type="color" name="cor" class="form-control form-control-sm" value="<?= h($e['cor']) ?>"></td>
              <td style="width:70px" class="text-center"><input type="checkbox" name="is_final" <?= $e['is_final'] ? 'checked' : '' ?>></td>
              <td class="text-end" style="white-space:nowrap">
                <button type="submit" name="acao" value="editar" class="btn btn-sm btn-outline-primary">Salvar</button>
                <button type="submit" name="acao" value="excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir esta etapa?')">Excluir</button>
              </td>
            </tr>
          </form>
        <?php endforeach; ?>
        </tbody>
      </table>
      <form method="post" class="row g-2 align-items-end border-top pt-3">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="etapa">
        <input type="hidden" name="acao" value="criar">
        <div class="col-auto"><input type="number" name="ordem" class="form-control form-control-sm" placeholder="Ordem" value="<?= count($etapas) + 1 ?>" style="width:90px"></div>
        <div class="col"><input type="text" name="nome" class="form-control form-control-sm" placeholder="Nova etapa" required></div>
        <div class="col-auto"><input type="color" name="cor" class="form-control form-control-sm" value="#6c757d" style="width:70px"></div>
        <div class="col-auto"><button class="btn btn-sm btn-primary" type="submit">Adicionar etapa</button></div>
      </form>
    </div>
  </div>

<?php elseif ($aba === 'planos'): ?>
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <table class="table align-middle">
        <thead><tr><th>Nome</th><th>Posts/mês</th><th>Valor padrão</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($planos as $p): ?>
          <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <input type="hidden" name="entidade" value="plano">
            <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
            <tr>
              <td><input type="text" name="nome" class="form-control form-control-sm" value="<?= h($p['nome']) ?>"></td>
              <td style="width:120px"><input type="number" name="posts_por_mes" class="form-control form-control-sm" value="<?= h((string)($p['posts_por_mes'] ?? '')) ?>"></td>
              <td style="width:140px"><input type="text" name="valor_padrao" class="form-control form-control-sm" value="<?= h((string)($p['valor_padrao'] ?? '')) ?>"></td>
              <td class="text-end" style="white-space:nowrap">
                <button type="submit" name="acao" value="editar" class="btn btn-sm btn-outline-primary">Salvar</button>
                <button type="submit" name="acao" value="excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este plano?')">Excluir</button>
              </td>
            </tr>
          </form>
        <?php endforeach; ?>
        </tbody>
      </table>
      <form method="post" class="row g-2 align-items-end border-top pt-3">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="plano">
        <input type="hidden" name="acao" value="criar">
        <div class="col"><input type="text" name="nome" class="form-control form-control-sm" placeholder="Novo plano" required></div>
        <div class="col-auto"><input type="number" name="posts_por_mes" class="form-control form-control-sm" placeholder="Posts/mês" style="width:120px"></div>
        <div class="col-auto"><input type="text" name="valor_padrao" class="form-control form-control-sm" placeholder="Valor R$" style="width:120px"></div>
        <div class="col-auto"><button class="btn btn-sm btn-primary" type="submit">Adicionar plano</button></div>
      </form>
    </div>
  </div>

<?php elseif ($aba === 'origens'): ?>
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <table class="table align-middle">
        <thead><tr><th>Nome</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($origens as $o): ?>
          <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <input type="hidden" name="entidade" value="origem">
            <input type="hidden" name="id" value="<?= (int)$o['id'] ?>">
            <tr>
              <td><input type="text" name="nome" class="form-control form-control-sm" value="<?= h($o['nome']) ?>"></td>
              <td class="text-end" style="white-space:nowrap">
                <button type="submit" name="acao" value="editar" class="btn btn-sm btn-outline-primary">Salvar</button>
                <button type="submit" name="acao" value="excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir esta origem?')">Excluir</button>
              </td>
            </tr>
          </form>
        <?php endforeach; ?>
        </tbody>
      </table>
      <form method="post" class="row g-2 align-items-end border-top pt-3">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="origem">
        <input type="hidden" name="acao" value="criar">
        <div class="col"><input type="text" name="nome" class="form-control form-control-sm" placeholder="Nova origem" required></div>
        <div class="col-auto"><button class="btn btn-sm btn-primary" type="submit">Adicionar origem</button></div>
      </form>
    </div>
  </div>

<?php elseif ($aba === 'usuarios'): ?>
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <table class="table align-middle">
        <thead><tr><th>Nome</th><th>E-mail</th><th>Papel</th><th>Nova senha</th><th>Ativo</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($usuarios as $u): ?>
          <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <input type="hidden" name="entidade" value="usuario">
            <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
            <tr>
              <td><input type="text" name="nome" class="form-control form-control-sm" value="<?= h($u['nome']) ?>"></td>
              <td><input type="email" name="email" class="form-control form-control-sm" value="<?= h($u['email']) ?>"></td>
              <td style="width:130px">
                <select name="papel" class="form-select form-select-sm">
                  <option value="equipe" <?= $u['papel'] === 'equipe' ? 'selected' : '' ?>>Equipe</option>
                  <option value="admin" <?= $u['papel'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
              </td>
              <td style="width:150px"><input type="password" name="senha" class="form-control form-control-sm" placeholder="(manter atual)"></td>
              <td class="text-center"><?= $u['ativo'] ? '<span class="badge text-bg-success">sim</span>' : '<span class="badge text-bg-secondary">não</span>' ?></td>
              <td class="text-end" style="white-space:nowrap">
                <button type="submit" name="acao" value="editar" class="btn btn-sm btn-outline-primary">Salvar</button>
                <button type="submit" name="acao" value="alternar_ativo" class="btn btn-sm btn-outline-warning">Ativar/Desativar</button>
              </td>
            </tr>
          </form>
        <?php endforeach; ?>
        </tbody>
      </table>
      <form method="post" class="row g-2 align-items-end border-top pt-3">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="entidade" value="usuario">
        <input type="hidden" name="acao" value="criar">
        <div class="col"><input type="text" name="nome" class="form-control form-control-sm" placeholder="Nome" required></div>
        <div class="col"><input type="email" name="email" class="form-control form-control-sm" placeholder="E-mail" required></div>
        <div class="col-auto">
          <select name="papel" class="form-select form-select-sm">
            <option value="equipe">Equipe</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="col"><input type="password" name="senha" class="form-control form-control-sm" placeholder="Senha" required></div>
        <div class="col-auto"><button class="btn btn-sm btn-primary" type="submit">Adicionar usuário</button></div>
      </form>
    </div>
  </div>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>

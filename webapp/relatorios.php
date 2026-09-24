<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/relatorio.php';
exigir_login();

$filtros = relatorio_filtros_da_requisicao($_GET);
$linhas = relatorio_buscar($filtros);

$exportar = $_GET['exportar'] ?? '';
if ($exportar === 'csv' || $exportar === 'xlsx') {
    if (!$filtros['colunas']) {
        $filtros['colunas'] = relatorio_colunas_padrao();
    }
    $exportar === 'csv'
        ? relatorio_exportar_csv($linhas, $filtros['colunas'])
        : relatorio_exportar_xlsx($linhas, $filtros['colunas']);
}

$etapas = listar_etapas();
$usuarios = listar_usuarios_ativos();
$planos = listar_planos();
$origens = listar_origens();
$colunas = relatorio_colunas();
$resumo = relatorio_resumo($linhas);

$totalPaginas = max(1, (int) ceil(count($linhas) / RELATORIO_POR_PAGINA));
$pagina = min($totalPaginas, max(1, (int) ($_GET['pagina'] ?? 1)));
$linhasPagina = array_slice($linhas, ($pagina - 1) * RELATORIO_POR_PAGINA, RELATORIO_POR_PAGINA);
$colunasVisiveis = array_intersect_key($colunas, array_flip($filtros['colunas']));

$query = $_GET;
unset($query['exportar'], $query['pagina']);
$url = fn(array $extra) => 'relatorios.php?' . http_build_query(array_merge($query, $extra));

$nomesEtapasSelecionadas = [];
foreach ($etapas as $e) {
    if (in_array((string) $e['id'], $filtros['etapas'], true)) {
        $nomesEtapasSelecionadas[] = $e['nome'];
    }
}
if (in_array('sem', $filtros['etapas'], true)) {
    $nomesEtapasSelecionadas[] = 'Sem projeto';
}

$titulo_pagina = 'Relatórios';
require __DIR__ . '/includes/header.php';
?>
<main class="fade container">
  <div class="page-header">
    <div>
      <h1>Relatórios</h1>
      <p>Filtre contatos e projetos, escolha as colunas e exporte em planilha.</p>
    </div>
    <div style="display:flex;gap:10px">
      <a href="<?= h($url(['exportar' => 'csv'])) ?>" class="btn btn-outline"><?= icone('download', 16, '2.2') ?>CSV</a>
      <a href="<?= h($url(['exportar' => 'xlsx'])) ?>" class="btn btn-primary"><?= icone('download', 16, '2.2') ?>Exportar Excel</a>
    </div>
  </div>

  <div class="kpi-grid kpi-grid-4">
    <div class="kpi-card">
      <div class="kpi-head"><span class="kpi-label">Leads no relatório</span></div>
      <div class="kpi-value"><?= (int) $resumo['total'] ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-head"><span class="kpi-label">Vinculados a projeto</span></div>
      <div class="kpi-value"><?= (int) $resumo['vinculados'] ?> <span class="kpi-sub">(<?= (int) $resumo['pct_vinculados'] ?>%)</span></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-head"><span class="kpi-label">Média dias sem resposta</span></div>
      <div class="kpi-value"><?= (int) $resumo['media_dias'] ?></div>
    </div>
    <div class="kpi-card">
      <div class="kpi-head"><span class="kpi-label">Situação mais comum</span></div>
      <div class="kpi-value kpi-value-text" title="<?= h($resumo['situacao_top']) ?>"><?= h($resumo['situacao_top']) ?></div>
    </div>
  </div>

  <div class="card">
    <form method="get" class="report-filters" id="relatorioFiltros">
      <input type="hidden" name="colunas_enviadas" value="1">

      <div class="table-search" style="max-width:280px">
        <?= icone('search', 15, '2') ?>
        <input type="text" name="q" placeholder="Nome, telefone ou e-mail…" value="<?= h($filtros['q']) ?>">
      </div>

      <details class="report-dropdown">
        <summary><?= $nomesEtapasSelecionadas ? h(count($nomesEtapasSelecionadas) === 1 ? $nomesEtapasSelecionadas[0] : count($nomesEtapasSelecionadas) . ' etapas') : 'Todas as etapas' ?></summary>
        <div class="report-dropdown-panel">
          <?php foreach ($etapas as $e): ?>
            <label class="checkbox-row">
              <input type="checkbox" name="etapa[]" value="<?= (int) $e['id'] ?>" <?= in_array((string) $e['id'], $filtros['etapas'], true) ? 'checked' : '' ?>>
              <span class="dot" style="background:<?= h($e['cor']) ?>"></span><?= h($e['nome']) ?>
            </label>
          <?php endforeach; ?>
          <label class="checkbox-row">
            <input type="checkbox" name="etapa[]" value="sem" <?= in_array('sem', $filtros['etapas'], true) ? 'checked' : '' ?>>
            <span class="dot" style="background:var(--faint)"></span>Sem projeto
          </label>
        </div>
      </details>

      <select name="responsavel">
        <option value="">Todos os responsáveis</option>
        <?php foreach ($usuarios as $u): ?>
          <option value="<?= (int) $u['id'] ?>" <?= $filtros['responsavel'] === (string) $u['id'] ? 'selected' : '' ?>><?= h($u['nome']) ?></option>
        <?php endforeach; ?>
        <option value="sem" <?= $filtros['responsavel'] === 'sem' ? 'selected' : '' ?>>Sem responsável</option>
      </select>

      <select name="plano">
        <option value="">Todos os planos</option>
        <?php foreach ($planos as $p): ?>
          <option value="<?= (int) $p['id'] ?>" <?= $filtros['plano'] === (string) $p['id'] ? 'selected' : '' ?>><?= h($p['nome']) ?></option>
        <?php endforeach; ?>
        <option value="sem" <?= $filtros['plano'] === 'sem' ? 'selected' : '' ?>>Sem plano</option>
      </select>

      <select name="origem">
        <option value="">Todas as origens</option>
        <?php foreach ($origens as $o): ?>
          <option value="<?= (int) $o['id'] ?>" <?= $filtros['origem'] === (string) $o['id'] ? 'selected' : '' ?>><?= h($o['nome']) ?></option>
        <?php endforeach; ?>
        <option value="sem" <?= $filtros['origem'] === 'sem' ? 'selected' : '' ?>>Sem origem</option>
      </select>

      <select name="contato">
        <option value="">Qualquer contato</option>
        <option value="com_telefone" <?= $filtros['contato'] === 'com_telefone' ? 'selected' : '' ?>>Com telefone</option>
        <option value="sem_telefone" <?= $filtros['contato'] === 'sem_telefone' ? 'selected' : '' ?>>Sem telefone</option>
        <option value="com_email" <?= $filtros['contato'] === 'com_email' ? 'selected' : '' ?>>Com e-mail</option>
      </select>

      <span class="kanban-filtro-data">
        <select name="periodo_campo">
          <option value="chegou_em" <?= $filtros['periodo_campo'] === 'chegou_em' ? 'selected' : '' ?>>Chegou</option>
          <option value="finalizado_em" <?= $filtros['periodo_campo'] === 'finalizado_em' ? 'selected' : '' ?>>Finalizado</option>
          <option value="cliente_criado_em" <?= $filtros['periodo_campo'] === 'cliente_criado_em' ? 'selected' : '' ?>>Contato cadastrado</option>
        </select>
        <label for="relDe">de</label>
        <input type="date" id="relDe" name="de" value="<?= h($filtros['de']) ?>">
        <label for="relAte">até</label>
        <input type="date" id="relAte" name="ate" value="<?= h($filtros['ate']) ?>">
      </span>

      <details class="report-dropdown">
        <summary>Colunas (<?= count($filtros['colunas']) ?>)</summary>
        <div class="report-dropdown-panel">
          <div class="report-dropdown-actions">
            <button type="button" data-colunas="todas">Todas</button>
            <button type="button" data-colunas="nenhuma">Nenhuma</button>
          </div>
          <?php foreach ($colunas as $chave => $c): ?>
            <label class="checkbox-row">
              <input type="checkbox" name="col[]" value="<?= h($chave) ?>" <?= in_array($chave, $filtros['colunas'], true) ? 'checked' : '' ?>><?= h($c['label']) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </details>

      <button type="submit" class="btn btn-primary btn-sm">Gerar relatório</button>
      <?php if (relatorio_tem_filtro($filtros)): ?>
        <a href="relatorios.php" class="btn btn-outline btn-sm">Limpar</a>
      <?php endif; ?>
    </form>

    <?php if (!$colunasVisiveis): ?>
      <div class="empty-state">
        <div class="empty-state-icon"><?= icone('grid', 24, '1.8') ?></div>
        <p>Nenhuma coluna selecionada</p>
        <p>Escolha ao menos uma coluna para visualizar o relatório.</p>
      </div>
    <?php elseif ($linhas): ?>
      <div class="table-toolbar" style="border-bottom:none;padding-bottom:0">
        <span style="font-size:12.5px;color:var(--faint)"><strong style="color:var(--text)"><?= count($linhas) ?></strong> linha(s) com os filtros atuais</span>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <?php foreach ($colunasVisiveis as $c): ?><th style="white-space:nowrap"><?= h($c['label']) ?></th><?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($linhasPagina as $l): ?>
              <tr>
                <?php foreach ($colunasVisiveis as $chave => $c): $valor = (string) $c['valor']($l); ?>
                  <td class="report-cell" title="<?= h($valor) ?>">
                    <?php if ($chave === 'empresa' || $chave === 'nome_cliente'): ?>
                      <a href="cliente_view.php?id=<?= (int) $l['cliente_id'] ?>" style="font-weight:700;color:var(--text)"><?= h($valor) ?></a>
                    <?php elseif (($chave === 'situacao' || $chave === 'status_projeto') && $l['etapa']): ?>
                      <a href="projeto_view.php?id=<?= (int) $l['projeto_id'] ?>" class="pill" style="color:<?= h($l['etapa_cor']) ?>;background:color-mix(in srgb, <?= h($l['etapa_cor']) ?> 16%, transparent)"><?= h($valor) ?></a>
                    <?php elseif ($valor === ''): ?>
                      <span style="color:var(--faint)">-</span>
                    <?php else: ?>
                      <?= h($valor) ?>
                    <?php endif; ?>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php if ($totalPaginas > 1): ?>
        <div class="report-pagination">
          <?php if ($pagina > 1): ?><a href="<?= h($url(['pagina' => $pagina - 1])) ?>" class="btn btn-outline btn-sm">← Anterior</a><?php endif; ?>
          <span>Página <?= $pagina ?> de <?= $totalPaginas ?></span>
          <?php if ($pagina < $totalPaginas): ?><a href="<?= h($url(['pagina' => $pagina + 1])) ?>" class="btn btn-outline btn-sm">Próxima →</a><?php endif; ?>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="empty-state">
        <div class="empty-state-icon"><?= icone('search', 24, '1.8') ?></div>
        <p>Nenhum resultado</p>
        <p>Nenhum contato ou projeto encontrado com os filtros selecionados.</p>
      </div>
    <?php endif; ?>
  </div>
</main>

<script>
(function () {
  var form = document.getElementById('relatorioFiltros');
  form.querySelectorAll('[data-colunas]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var marcar = btn.getAttribute('data-colunas') === 'todas';
      form.querySelectorAll('input[name="col[]"]').forEach(function (cb) { cb.checked = marcar; });
    });
  });
  document.addEventListener('click', function (e) {
    form.querySelectorAll('details.report-dropdown[open]').forEach(function (d) {
      if (!d.contains(e.target)) d.removeAttribute('open');
    });
  });
})();
</script>
<?php require __DIR__ . '/includes/footer.php'; ?>

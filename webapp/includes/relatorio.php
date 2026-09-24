<?php
// Relatórios: uma linha por projeto (cliente sem projeto aparece uma vez, com etapa "Sem projeto").

const RELATORIO_POR_PAGINA = 50;

// Colunas iguais às do relatório de leads do CRM Montesite (src/lib/reports/columns.ts): mesmos nomes,
// mesma ordem e mesmas marcadas por padrão, porque o arquivo vai para o mesmo software de disparo.
// Cada coluna é preenchida com o campo equivalente do ProntoPost; o que não existe aqui sai vazio.
function relatorio_colunas(): array
{
    $data = fn(string $campo) => fn(array $l) => $l[$campo] ? date('d/m/Y', strtotime($l[$campo])) : '';
    $texto = fn(string $campo) => fn(array $l) => (string) ($l[$campo] ?? '');
    $vazio = fn(array $l) => '';

    return [
        'empresa' => ['label' => 'Empresa', 'padrao' => true, 'valor' => $texto('cliente')],
        'nome_cliente' => ['label' => 'Cliente', 'padrao' => true, 'valor' => $texto('cliente')],
        'telefone' => ['label' => 'Número de Contato', 'padrao' => true, 'valor' => fn(array $l) => relatorio_formatar_telefone($l['telefone'])],
        'vendedor' => ['label' => 'Vendedor', 'padrao' => true, 'valor' => $texto('responsavel')],
        'situacao' => ['label' => 'Situação', 'padrao' => true, 'valor' => fn(array $l) => relatorio_situacao($l)],
        'tipo_servico' => ['label' => 'Tipo de Serviço', 'padrao' => true, 'valor' => $texto('plano')],
        'data_ultimo_contato' => ['label' => 'Último Contato', 'padrao' => true, 'valor' => $data('ultimo_contato')],
        'dias_sem_resposta' => ['label' => 'Dias sem Resposta', 'padrao' => true, 'valor' => fn(array $l) => relatorio_dias_sem_resposta($l)],
        'created_at' => ['label' => 'Data de Cadastro', 'padrao' => true, 'valor' => $data('cliente_criado_em')],
        'observacoes' => ['label' => 'Observações', 'padrao' => true, 'valor' => $texto('observacoes')],
        'email' => ['label' => 'E-mail', 'padrao' => false, 'valor' => $texto('email')],
        'cnpj' => ['label' => 'CNPJ', 'padrao' => false, 'valor' => $vazio],
        'projeto_vinculado' => ['label' => 'Projeto Vinculado', 'padrao' => false, 'valor' => fn(array $l) => $l['projeto_id'] ? (string) $l['cliente'] : ''],
        'status_projeto' => ['label' => 'Status do Projeto', 'padrao' => false, 'valor' => $texto('etapa')],
        'link_blaster' => ['label' => 'Link Blaster', 'padrao' => false, 'valor' => $texto('link_blaster')],
        'link_chat' => ['label' => 'Link Chat', 'padrao' => false, 'valor' => $texto('link_atendimento')],
    ];
}

function relatorio_situacao(array $l): string
{
    return $l['etapa'] ?? 'Sem projeto';
}

// Mesma regra do Montesite (calcDiasSemResposta): 0 quando está pronto, senão dias desde o último contato.
function relatorio_dias_sem_resposta(array $l): int
{
    if ($l['etapa'] === 'Prontos' || !$l['ultimo_contato']) {
        return 0;
    }
    return max(0, (int) ceil((time() - strtotime($l['ultimo_contato'])) / 86400));
}

// Mesmo formato do CRM Montesite (src/lib/phone.ts): "(11) 98888-7777", sem o +55,
// para o arquivo continuar compatível com o software de disparo que já lê o relatório de lá.
function relatorio_formatar_telefone(?string $telefone): string
{
    $digitos = preg_replace('/\D/', '', $telefone ?? '');
    if (strlen($digitos) >= 12 && str_starts_with($digitos, '55')) {
        $digitos = substr($digitos, 2);
    }
    $digitos = substr($digitos, 0, 11);

    if (strlen($digitos) <= 2) {
        return $digitos;
    }
    if (strlen($digitos) <= 6) {
        return '(' . substr($digitos, 0, 2) . ') ' . substr($digitos, 2);
    }
    if (strlen($digitos) <= 10) {
        return '(' . substr($digitos, 0, 2) . ') ' . substr($digitos, 2, 4) . '-' . substr($digitos, 6);
    }
    return '(' . substr($digitos, 0, 2) . ') ' . substr($digitos, 2, 5) . '-' . substr($digitos, 7);
}

function relatorio_colunas_padrao(): array
{
    return array_keys(array_filter(relatorio_colunas(), fn($c) => $c['padrao']));
}

function relatorio_data_valida(string $data): ?string
{
    $dt = DateTime::createFromFormat('Y-m-d', $data);
    return $dt && $dt->format('Y-m-d') === $data ? $data : null;
}

function relatorio_filtros_da_requisicao(array $get): array
{
    $ids = fn($valor) => array_values(array_filter(array_map('strval', (array) ($valor ?? [])), fn($v) => $v === 'sem' || ctype_digit($v)));

    if (isset($get['colunas_enviadas'])) {
        $colunas = array_values(array_intersect(array_keys(relatorio_colunas()), (array) ($get['col'] ?? [])));
    } else {
        $colunas = relatorio_colunas_padrao();
    }

    $campoData = $get['periodo_campo'] ?? 'chegou_em';
    if (!in_array($campoData, ['chegou_em', 'finalizado_em', 'cliente_criado_em'], true)) {
        $campoData = 'chegou_em';
    }

    return [
        'q' => trim((string) ($get['q'] ?? '')),
        'etapas' => $ids($get['etapa'] ?? []),
        'responsavel' => $ids([$get['responsavel'] ?? ''])[0] ?? '',
        'plano' => $ids([$get['plano'] ?? ''])[0] ?? '',
        'origem' => $ids([$get['origem'] ?? ''])[0] ?? '',
        'contato' => in_array($get['contato'] ?? '', ['com_telefone', 'sem_telefone', 'com_email'], true) ? $get['contato'] : '',
        'periodo_campo' => $campoData,
        'de' => relatorio_data_valida((string) ($get['de'] ?? '')) ?? '',
        'ate' => relatorio_data_valida((string) ($get['ate'] ?? '')) ?? '',
        'colunas' => $colunas,
    ];
}

function relatorio_tem_filtro(array $f): bool
{
    return $f['q'] !== '' || $f['etapas'] || $f['responsavel'] !== '' || $f['plano'] !== ''
        || $f['origem'] !== '' || $f['contato'] !== '' || $f['de'] !== '' || $f['ate'] !== '';
}

function relatorio_buscar(array $f): array
{
    $where = [];
    $params = [];

    if ($f['q'] !== '') {
        $where[] = '(c.nome LIKE ? OR c.telefone LIKE ? OR c.email LIKE ?)';
        $termo = '%' . $f['q'] . '%';
        array_push($params, $termo, $termo, $termo);
    }

    if ($f['etapas']) {
        $partes = [];
        $ids = array_values(array_filter($f['etapas'], 'ctype_digit'));
        if ($ids) {
            $partes[] = 'p.etapa_id IN (' . implode(',', array_fill(0, count($ids), '?')) . ')';
            array_push($params, ...array_map('intval', $ids));
        }
        if (in_array('sem', $f['etapas'], true)) {
            $partes[] = 'p.id IS NULL';
        }
        $where[] = '(' . implode(' OR ', $partes) . ')';
    }

    foreach (['responsavel' => 'p.responsavel_id', 'plano' => 'p.plano_id', 'origem' => 'c.origem_id'] as $chave => $coluna) {
        if ($f[$chave] === 'sem') {
            $where[] = "$coluna IS NULL";
        } elseif ($f[$chave] !== '') {
            $where[] = "$coluna = ?";
            $params[] = (int) $f[$chave];
        }
    }

    if ($f['contato'] === 'com_telefone') {
        $where[] = "(c.telefone IS NOT NULL AND TRIM(c.telefone) <> '')";
    } elseif ($f['contato'] === 'sem_telefone') {
        $where[] = "(c.telefone IS NULL OR TRIM(c.telefone) = '')";
    } elseif ($f['contato'] === 'com_email') {
        $where[] = "(c.email IS NOT NULL AND TRIM(c.email) <> '')";
    }

    $colunaData = [
        'chegou_em' => 'p.chegou_em',
        'finalizado_em' => 'DATE(p.finalizado_em)',
        'cliente_criado_em' => 'DATE(c.criado_em)',
    ][$f['periodo_campo']];
    if ($f['de'] !== '') {
        $where[] = "$colunaData >= ?";
        $params[] = $f['de'];
    }
    if ($f['ate'] !== '') {
        $where[] = "$colunaData <= ?";
        $params[] = $f['ate'];
    }

    $sql = "
        SELECT c.id cliente_id, c.nome cliente, c.telefone, c.email, c.link_atendimento, c.observacoes,
               c.criado_em cliente_criado_em, o.nome origem,
               p.id projeto_id, p.chegou_em, p.finalizado_em, p.proxima_acao_data, p.proximo_passo,
               p.resultado_aprovacao, p.link_blaster, p.mes_conteudo, p.posts_no_mes,
               e.nome etapa, e.cor etapa_cor, pl.nome plano, u.nome responsavel,
               COALESCE(n.qtd, 0) notas_qtd,
               COALESCE(n.ultima, p.atualizado_em, c.atualizado_em) ultimo_contato
        FROM clientes c
        LEFT JOIN origens o ON o.id = c.origem_id
        LEFT JOIN projetos p ON p.cliente_id = c.id
        LEFT JOIN etapas e ON e.id = p.etapa_id
        LEFT JOIN planos pl ON pl.id = p.plano_id
        LEFT JOIN usuarios u ON u.id = p.responsavel_id
        LEFT JOIN (SELECT projeto_id, COUNT(*) qtd, MAX(criado_em) ultima FROM notas GROUP BY projeto_id) n ON n.projeto_id = p.id
        " . ($where ? 'WHERE ' . implode(' AND ', $where) : '') . "
        ORDER BY e.ordem IS NULL, e.ordem, c.nome
    ";

    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function relatorio_contar_por(array $linhas, callable $chave): array
{
    $contagem = [];
    foreach ($linhas as $l) {
        $k = $chave($l) ?: 'Não definido';
        $contagem[$k] = ($contagem[$k] ?? 0) + 1;
    }
    arsort($contagem);
    return $contagem;
}

function relatorio_resumo(array $linhas): array
{
    $total = count($linhas);
    $vinculados = count(array_filter($linhas, fn($l) => $l['projeto_id']));
    $porSituacao = relatorio_contar_por($linhas, 'relatorio_situacao');

    return [
        'total' => $total,
        'vinculados' => $vinculados,
        'pct_vinculados' => $total ? (int) round($vinculados / $total * 100) : 0,
        'media_dias' => $total ? (int) round(array_sum(array_map('relatorio_dias_sem_resposta', $linhas)) / $total) : 0,
        'situacao_top' => $porSituacao ? array_key_first($porSituacao) . ' (' . reset($porSituacao) . ')' : '—',
        'por_situacao' => $porSituacao,
        'por_vendedor' => relatorio_contar_por($linhas, fn($l) => $l['responsavel']),
        'por_tipo_servico' => relatorio_contar_por($linhas, fn($l) => $l['plano']),
    ];
}

function relatorio_montar_tabela(array $linhas, array $chavesColunas): array
{
    $colunas = array_intersect_key(relatorio_colunas(), array_flip($chavesColunas));
    $cabecalho = array_column($colunas, 'label');
    $dados = [];
    foreach ($linhas as $l) {
        $dados[] = array_map(fn($c) => $c['valor']($l), array_values($colunas));
    }
    return [$cabecalho, $dados];
}

function relatorio_nome_arquivo(string $extensao): string
{
    return 'relatorio-leads_' . date('Y-m-d') . '.' . $extensao;
}

// Mesmo formato do CSV do CRM Montesite (SheetJS sheet_to_csv): vírgula como separador,
// aspas só quando o campo tem vírgula, aspas ou quebra de linha, linhas separadas por \n.
function relatorio_csv_campo($valor): string
{
    $texto = (string) $valor;
    return strpbrk($texto, ",\"\n") !== false ? '"' . str_replace('"', '""', $texto) . '"' : $texto;
}

function relatorio_gerar_csv(array $cabecalho, array $dados): string
{
    $linhas = [implode(',', array_map('relatorio_csv_campo', $cabecalho))];
    foreach ($dados as $linha) {
        $linhas[] = implode(',', array_map('relatorio_csv_campo', $linha));
    }
    return "\xEF\xBB\xBF" . implode("\n", $linhas);
}

function relatorio_exportar_csv(array $linhas, array $chavesColunas): void
{
    [$cabecalho, $dados] = relatorio_montar_tabela($linhas, $chavesColunas);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . relatorio_nome_arquivo('csv') . '"');
    echo relatorio_gerar_csv($cabecalho, $dados);
    exit;
}

// Mesmas abas e mesmo resumo do Montesite (src/lib/reports/export.ts).
function relatorio_exportar_xlsx(array $linhas, array $chavesColunas): void
{
    [$cabecalho, $dados] = relatorio_montar_tabela($linhas, $chavesColunas);
    $resumo = relatorio_resumo($linhas);

    $linhasResumo = [
        ['Total de leads no relatório', $resumo['total']],
        ['Leads vinculados a projeto', $resumo['vinculados']],
        ['Média de dias sem resposta', $resumo['media_dias']],
    ];
    foreach (['Por Situação' => 'por_situacao', 'Por Vendedor' => 'por_vendedor', 'Por Tipo de Serviço' => 'por_tipo_servico'] as $titulo => $chave) {
        $linhasResumo[] = ['', ''];
        $linhasResumo[] = [$titulo, ''];
        foreach ($resumo[$chave] as $nome => $qtd) {
            $linhasResumo[] = [(string) $nome, $qtd];
        }
    }

    $conteudo = xlsx_gerar([
        'Leads' => [$cabecalho, $dados],
        'Resumo' => [['Indicador', 'Valor'], $linhasResumo],
    ]);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . relatorio_nome_arquivo('xlsx') . '"');
    header('Content-Length: ' . strlen($conteudo));
    echo $conteudo;
    exit;
}

// ---------------------------------------------------------------------------
// Gerador de .xlsx mínimo (sem dependências: não exige ZipArchive no servidor)
// ---------------------------------------------------------------------------

function xlsx_texto(string $valor): string
{
    $valor = preg_replace('/[^\x{9}\x{A}\x{D}\x{20}-\x{D7FF}\x{E000}-\x{FFFD}]/u', '', $valor) ?? '';
    return htmlspecialchars($valor, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

function xlsx_coluna(int $indice): string
{
    $letra = '';
    for ($n = $indice + 1; $n > 0; $n = intdiv($n - 1, 26)) {
        $letra = chr(65 + ($n - 1) % 26) . $letra;
    }
    return $letra;
}

function xlsx_planilha(array $cabecalho, array $dados): string
{
    $xmlLinhas = '';
    foreach (array_merge([$cabecalho], $dados) as $r => $linha) {
        $celulas = '';
        foreach (array_values($linha) as $c => $v) {
            $ref = xlsx_coluna($c) . ($r + 1);
            if (is_int($v) || is_float($v)) {
                $celulas .= '<c r="' . $ref . '"><v>' . $v . '</v></c>';
            } else {
                $celulas .= '<c r="' . $ref . '" t="inlineStr"><is><t xml:space="preserve">' . xlsx_texto((string) $v) . '</t></is></c>';
            }
        }
        $xmlLinhas .= '<row r="' . ($r + 1) . '">' . $celulas . '</row>';
    }

    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
        . '<sheetData>' . $xmlLinhas . '</sheetData></worksheet>';
}

function xlsx_gerar(array $planilhas): string
{
    $arquivos = [];
    $sheetsXml = '';
    $relsXml = '';
    $overrides = '';
    $i = 0;
    foreach ($planilhas as $nome => [$cabecalho, $dados]) {
        $i++;
        $arquivos["xl/worksheets/sheet$i.xml"] = xlsx_planilha($cabecalho, $dados);
        $sheetsXml .= '<sheet name="' . xlsx_texto(mb_substr($nome, 0, 31)) . '" sheetId="' . $i . '" r:id="rId' . $i . '"/>';
        $relsXml .= '<Relationship Id="rId' . $i . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet' . $i . '.xml"/>';
        $overrides .= '<Override PartName="/xl/worksheets/sheet' . $i . '.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>';
    }
    $relsXml .= '<Relationship Id="rId' . ($i + 1) . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>';

    $arquivos['[Content_Types].xml'] = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
        . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
        . '<Default Extension="xml" ContentType="application/xml"/>'
        . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
        . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
        . $overrides . '</Types>';
    $arquivos['_rels/.rels'] = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
        . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
        . '</Relationships>';
    $arquivos['xl/workbook.xml'] = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
        . '<sheets>' . $sheetsXml . '</sheets></workbook>';
    $arquivos['xl/_rels/workbook.xml.rels'] = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' . $relsXml . '</Relationships>';
    $arquivos['xl/styles.xml'] = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
        . '<fonts count="2"><font><sz val="11"/><name val="Calibri"/></font><font><b/><sz val="11"/><name val="Calibri"/></font></fonts>'
        . '<fills count="2"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill></fills>'
        . '<borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders>'
        . '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
        . '<cellXfs count="2"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1"/></cellXfs>'
        . '<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles>'
        . '</styleSheet>';

    return zip_gerar($arquivos);
}

function zip_gerar(array $arquivos): string
{
    $corpo = '';
    $central = '';
    [$hora, $data] = zip_data_dos(time());

    foreach ($arquivos as $nome => $conteudo) {
        $comprimido = gzdeflate($conteudo, 6);
        $crc = crc32($conteudo);
        $offset = strlen($corpo);
        $cabecalhoComum = pack('vvvvvVVV', 20, 0x0800, 8, $hora, $data, $crc, strlen($comprimido), strlen($conteudo));

        $corpo .= "PK\x03\x04" . $cabecalhoComum . pack('vv', strlen($nome), 0) . $nome . $comprimido;
        $central .= "PK\x01\x02" . pack('v', 20) . $cabecalhoComum . pack('vvvvvVV', strlen($nome), 0, 0, 0, 0, 0, $offset) . $nome;
    }

    return $corpo . $central . "PK\x05\x06" . pack('vvvvVVv', 0, 0, count($arquivos), count($arquivos), strlen($central), strlen($corpo), 0);
}

function zip_data_dos(int $ts): array
{
    $d = getdate($ts);
    $hora = ($d['hours'] << 11) | ($d['minutes'] << 5) | intdiv($d['seconds'], 2);
    $data = (max(0, $d['year'] - 1980) << 9) | ($d['mon'] << 5) | $d['mday'];
    return [$hora, $data];
}

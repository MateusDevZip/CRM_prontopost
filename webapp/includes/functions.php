<?php

function h(?string $valor): string
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}

function formatar_data(?string $data): string
{
    if (!$data) {
        return '-';
    }
    return date('d/m/Y', strtotime($data));
}

function formatar_valor(?float $valor): string
{
    if ($valor === null) {
        return '-';
    }
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function redirecionar(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function listar_origens(): array
{
    return db()->query('SELECT * FROM origens ORDER BY nome')->fetchAll();
}

function listar_planos(): array
{
    return db()->query('SELECT * FROM planos ORDER BY posts_por_mes')->fetchAll();
}

function listar_etapas(): array
{
    return db()->query('SELECT * FROM etapas ORDER BY ordem')->fetchAll();
}

function listar_usuarios_ativos(): array
{
    return db()->query("SELECT id, nome FROM usuarios WHERE ativo = 1 ORDER BY nome")->fetchAll();
}

function iniciais(string $nome): string
{
    $partes = preg_split('/\s+/', trim($nome));
    $partes = array_filter($partes);
    if (!$partes) {
        return '?';
    }
    if (count($partes) === 1) {
        return mb_strtoupper(mb_substr($partes[0], 0, 2));
    }
    return mb_strtoupper(mb_substr($partes[0], 0, 1) . mb_substr(end($partes), 0, 1));
}

function avatar_cor(string $semente): string
{
    $paleta = ['#7c6cff', '#14b8a6', '#f43f5e', '#3b82f6', '#f59e0b', '#a855f7', '#10b981', '#ec4899', '#06b6d4', '#6366f1'];
    $indice = crc32($semente) % count($paleta);
    return $paleta[$indice];
}

function plano_tag_cor(?string $nomePlano): array
{
    $nome = mb_strtolower($nomePlano ?? '');
    if (str_contains($nome, 'presença') || str_contains($nome, 'presenca')) {
        return ['#60a5fa', 'rgba(96,165,250,.16)'];
    }
    if (str_contains($nome, 'crescimento')) {
        return ['#f472b6', 'rgba(244,114,182,.16)'];
    }
    if (str_contains($nome, 'autoridade')) {
        return ['#e0ac00', 'rgba(224,172,0,.16)'];
    }
    return ['#818cf8', 'rgba(129,140,248,.16)'];
}

function chip_data(string $data): array
{
    $meses = ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'];
    $ts = strtotime($data);
    $hoje = strtotime(date('Y-m-d'));
    $dias = (int) round(($ts - $hoje) / 86400);

    if ($dias === 0) {
        return ['label' => 'HOJE', 'cor' => 'var(--danger)', 'soft' => 'var(--danger-soft)'];
    }
    if ($dias < 0) {
        return ['label' => 'ATRASADO', 'cor' => 'var(--danger)', 'soft' => 'var(--danger-soft)'];
    }
    $label = date('d', $ts) . ' ' . $meses[(int) date('n', $ts) - 1];
    if ($dias <= 3) {
        return ['label' => $label, 'cor' => 'var(--warn)', 'soft' => 'var(--warn-soft)'];
    }
    return ['label' => $label, 'cor' => 'var(--primary)', 'soft' => 'var(--primary-soft)'];
}

function icone(string $nome, int $tamanho = 16, string $largura = '2'): string
{
    $paths = [
        'search' => '<circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4-4"></path>',
        'sun' => '<circle cx="12" cy="12" r="4.2"></circle><path d="M12 2v2.5M12 19.5V22M4.9 4.9l1.8 1.8M17.3 17.3l1.8 1.8M2 12h2.5M19.5 12H22M4.9 19.1l1.8-1.8M17.3 6.7l1.8-1.8"></path>',
        'moon' => '<path d="M20 14.5A8 8 0 019.5 4 7 7 0 1020 14.5z"></path>',
        'plus' => '<path d="M12 5v14M5 12h14"></path>',
        'chevron-left' => '<path d="M15 18l-6-6 6-6"></path>',
        'edit' => '<path d="M11 4H5a2 2 0 00-2 2v13a2 2 0 002 2h13a2 2 0 002-2v-6"></path><path d="M18.5 2.5a2.1 2.1 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path>',
        'trash' => '<path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"></path>',
        'phone' => '<path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.7A2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.6a2 2 0 01-.5 2.1L8 9.6a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.8.3 1.7.5 2.6.6a2 2 0 011.7 2z"></path>',
        'mail' => '<rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="m22 7-10 6L2 7"></path>',
        'link' => '<path d="M10 13a5 5 0 007.5.5l3-3a5 5 0 00-7-7l-1.7 1.7"></path><path d="M14 11a5 5 0 00-7.5-.5l-3 3a5 5 0 007 7l1.7-1.7"></path>',
        'alert-triangle' => '<path d="M12 9v4M12 17h.01M10.3 3.9L2.4 18a2 2 0 001.7 3h15.8a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"></path>',
        'people' => '<path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 00-3-3.9M16 3.1a4 4 0 010 7.8"></path>',
        'grid' => '<rect x="3" y="3" width="7" height="7" rx="1.5"></rect><rect x="14" y="3" width="7" height="7" rx="1.5"></rect><rect x="14" y="14" width="7" height="7" rx="1.5"></rect><rect x="3" y="14" width="7" height="7" rx="1.5"></rect>',
    ];
    $inner = $paths[$nome] ?? '';
    return '<svg width="' . $tamanho . '" height="' . $tamanho . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . $largura . '">' . $inner . '</svg>';
}

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

<?php
require_once __DIR__ . '/../includes/auth.php';
header('Content-Type: application/json');

if (!usuario_logado()) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'erro' => 'não autenticado']);
    exit;
}

$projetoId = filter_input(INPUT_GET, 'projeto_id', FILTER_VALIDATE_INT);
if (!$projetoId) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'erro' => 'parâmetros inválidos']);
    exit;
}

$stmt = db()->prepare('SELECT p.id, p.proximo_passo, c.nome cliente_nome FROM projetos p JOIN clientes c ON c.id = p.cliente_id WHERE p.id = ?');
$stmt->execute([$projetoId]);
$projeto = $stmt->fetch();

if (!$projeto) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'erro' => 'projeto não encontrado']);
    exit;
}

$stmt = db()->prepare("
    SELECT n.texto, n.criado_em, u.nome usuario_nome
    FROM notas n
    LEFT JOIN usuarios u ON u.id = n.usuario_id
    WHERE n.projeto_id = ?
    ORDER BY n.criado_em DESC
");
$stmt->execute([$projetoId]);
$notas = $stmt->fetchAll();

echo json_encode([
    'ok' => true,
    'cliente_nome' => $projeto['cliente_nome'],
    'proximo_passo' => $projeto['proximo_passo'],
    'notas' => array_map(function ($n) {
        return [
            'texto' => $n['texto'],
            'usuario_nome' => $n['usuario_nome'] ?? 'Sistema',
            'criado_em' => date('d/m/Y H:i', strtotime($n['criado_em'])),
        ];
    }, $notas),
]);

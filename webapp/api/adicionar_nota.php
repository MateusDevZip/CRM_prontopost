<?php
require_once __DIR__ . '/../includes/auth.php';
header('Content-Type: application/json');

if (!usuario_logado()) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'erro' => 'não autenticado']);
    exit;
}

$token = $_POST['csrf_token'] ?? '';
if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'erro' => 'csrf inválido']);
    exit;
}

$projetoId = filter_input(INPUT_POST, 'projeto_id', FILTER_VALIDATE_INT);
$texto = trim($_POST['texto'] ?? '');

if (!$projetoId || $texto === '') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'erro' => 'parâmetros inválidos']);
    exit;
}

$stmt = db()->prepare('SELECT id FROM projetos WHERE id = ?');
$stmt->execute([$projetoId]);
if (!$stmt->fetch()) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'erro' => 'projeto não encontrado']);
    exit;
}

$usuario = usuario_logado();
db()->prepare('INSERT INTO notas (projeto_id, usuario_id, texto) VALUES (?, ?, ?)')
    ->execute([$projetoId, $usuario['id'], $texto]);

$stmt = db()->prepare('SELECT COUNT(*) FROM notas WHERE projeto_id = ?');
$stmt->execute([$projetoId]);
$qtd = (int) $stmt->fetchColumn();

echo json_encode([
    'ok' => true,
    'notas_qtd' => $qtd,
    'nota' => [
        'texto' => $texto,
        'usuario_nome' => $usuario['nome'],
        'criado_em' => date('d/m/Y H:i'),
    ],
]);

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
$responsavelId = filter_input(INPUT_POST, 'responsavel_id', FILTER_VALIDATE_INT) ?: null;

if (!$projetoId) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'erro' => 'parâmetros inválidos']);
    exit;
}

$pdo = db();

$stmt = $pdo->prepare('SELECT id FROM projetos WHERE id = ?');
$stmt->execute([$projetoId]);
if (!$stmt->fetch()) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'erro' => 'projeto não encontrado']);
    exit;
}

if ($responsavelId) {
    $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE id = ? AND ativo = 1');
    $stmt->execute([$responsavelId]);
    if (!$stmt->fetch()) {
        http_response_code(422);
        echo json_encode(['ok' => false, 'erro' => 'responsável inválido']);
        exit;
    }
}

try {
    $pdo->prepare('UPDATE projetos SET responsavel_id = ? WHERE id = ?')->execute([$responsavelId, $projetoId]);
    echo json_encode(['ok' => true]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'erro' => 'falha ao salvar']);
}

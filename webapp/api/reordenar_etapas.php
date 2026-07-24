<?php
require_once __DIR__ . '/../includes/auth.php';
header('Content-Type: application/json');

if (!usuario_logado()) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'erro' => 'não autenticado']);
    exit;
}

if (usuario_logado()['papel'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['ok' => false, 'erro' => 'acesso restrito a administradores']);
    exit;
}

$token = $_POST['csrf_token'] ?? '';
if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'erro' => 'csrf inválido']);
    exit;
}

$ids = $_POST['ids'] ?? [];
if (!is_array($ids) || !$ids) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'erro' => 'parâmetros inválidos']);
    exit;
}

$pdo = db();
try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare('UPDATE etapas SET ordem = ? WHERE id = ?');
    foreach ($ids as $posicao => $id) {
        $stmt->execute([$posicao + 1, (int)$id]);
    }
    $pdo->commit();
    echo json_encode(['ok' => true]);
} catch (Throwable $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['ok' => false, 'erro' => 'falha ao salvar']);
}

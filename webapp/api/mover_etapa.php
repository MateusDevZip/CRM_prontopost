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
$etapaId = filter_input(INPUT_POST, 'etapa_id', FILTER_VALIDATE_INT);

if (!$projetoId || !$etapaId) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'erro' => 'parâmetros inválidos']);
    exit;
}

$pdo = db();

$stmt = $pdo->prepare('SELECT etapa_id FROM projetos WHERE id = ?');
$stmt->execute([$projetoId]);
$projeto = $stmt->fetch();

if (!$projeto) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'erro' => 'projeto não encontrado']);
    exit;
}

$etapaAnteriorId = (int)$projeto['etapa_id'];

if ($etapaAnteriorId === $etapaId) {
    echo json_encode(['ok' => true]);
    exit;
}

$pdo->beginTransaction();
try {
    $pdo->prepare('UPDATE projetos SET etapa_id = ? WHERE id = ?')->execute([$etapaId, $projetoId]);
    $pdo->prepare('INSERT INTO projeto_historico (projeto_id, etapa_anterior_id, etapa_nova_id, usuario_id) VALUES (?, ?, ?, ?)')
        ->execute([$projetoId, $etapaAnteriorId, $etapaId, usuario_logado()['id']]);
    $pdo->commit();
    echo json_encode(['ok' => true]);
} catch (Throwable $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['ok' => false, 'erro' => 'falha ao salvar']);
}

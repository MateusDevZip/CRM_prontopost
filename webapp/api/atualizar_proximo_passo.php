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
if (!$projetoId) {
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

$texto = trim($_POST['proximo_passo'] ?? '') ?: null;

db()->prepare('UPDATE projetos SET proximo_passo = ? WHERE id = ?')->execute([$texto, $projetoId]);

echo json_encode(['ok' => true, 'proximo_passo' => $texto]);

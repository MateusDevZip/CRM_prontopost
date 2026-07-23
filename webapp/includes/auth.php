<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuario_logado(): ?array
{
    return $_SESSION['usuario'] ?? null;
}

function exigir_login(): void
{
    if (!usuario_logado()) {
        header('Location: login.php');
        exit;
    }
}

function exigir_admin(): void
{
    exigir_login();
    if (usuario_logado()['papel'] !== 'admin') {
        http_response_code(403);
        echo 'Acesso restrito a administradores.';
        exit;
    }
}

function tentar_login(string $email, string $senha): bool
{
    $stmt = db()->prepare('SELECT id, nome, email, senha_hash, papel FROM usuarios WHERE email = ? AND ativo = 1');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (!$usuario || !password_verify($senha, $usuario['senha_hash'])) {
        return false;
    }

    unset($usuario['senha_hash']);
    $_SESSION['usuario'] = $usuario;
    return true;
}

function fazer_logout(): void
{
    unset($_SESSION['usuario']);
    session_destroy();
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verificar(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(400);
        echo 'Requisição inválida (CSRF).';
        exit;
    }
}

<?php
// Copie este arquivo para config.php e preencha com os dados do seu banco
// (hPanel da Hostinger -> Bancos de Dados -> MySQL Databases).
// config.php NÃO deve ir para o Git (já está no .gitignore).

define('DB_HOST', 'localhost');
define('DB_NAME', 'uXXXXXXXX_prontopost');
define('DB_USER', 'uXXXXXXXX_usuario');
define('DB_PASS', 'sua-senha-aqui');

// Gerado com bin2hex(random_bytes(32)) - usado para proteger a sessão de login.
define('APP_SECRET', 'troque-por-uma-string-aleatoria-grande');

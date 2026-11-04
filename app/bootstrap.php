<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $file = dirname(__DIR__) . '/config/database.php';
    if (!is_file($file)) throw new RuntimeException('Copia config/database.example.php como config/database.php y configura las credenciales.');
    $c = require $file;
    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $c['host'], $c['port'], $c['database']);
    return $pdo = new PDO($dsn, $c['username'], $c['password'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]);
}
function e(string $s): string {return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');}
function url(string $route='home'): string {return 'index.php?route='.rawurlencode($route);}
function csrf_token(): string {if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32));return $_SESSION['csrf'];}
function verify_csrf(): void {if (!hash_equals(csrf_token(), (string)($_POST['csrf']??''))) {http_response_code(419);exit('Solicitud inválida (CSRF).');}}
function user(): ?array {return $_SESSION['user']??null;}
function require_login(): void {if (!user()){header('Location: '.url('login'));exit;}}
function render(string $view,array $data=[]): void {extract($data,EXTR_SKIP);require __DIR__.'/Views/partials/header.php';require __DIR__.'/Views/'.$view.'.php';require __DIR__.'/Views/partials/footer.php';}

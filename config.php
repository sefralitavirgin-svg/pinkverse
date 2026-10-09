<?php
declare(strict_types=1);
session_start();

$host = '127.0.0.1';
$db   = 'pinkverse';
$user = 'root';
$pass = ''; // Default Laragon/XAMPP local MySQL password is often blank.
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database belum tersambung. Pastikan MySQL aktif dan database pinkverse sudah di-import dari database.sql.');
}

function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}
function current_user(PDO $pdo): ?array {
    if (!is_logged_in()) return null;
    $stmt = $pdo->prepare('SELECT id, username, email, created_at FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}
function require_login(): void {
    if (!is_logged_in()) {
        $_SESSION['flash'] = 'Login dulu untuk menyimpan favoritmu 💗';
        header('Location: login.php');
        exit;
    }
}
function flash_message(): ?string {
    if (empty($_SESSION['flash'])) return null;
    $message = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $message;
}

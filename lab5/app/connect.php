<?php
$host = getenv('DB_HOST') ?: 'db';
$user = 'root';
$pass = 'root';
$dbname = 'guitarshop';

$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die("DB connection failed: " . $e->getMessage());
}

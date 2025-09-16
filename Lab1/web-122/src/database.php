<?php
$host = getenv('DB_HOST') ?: 'db';
$db = getenv('DB_NAME') ?: 'my_guitar_shop';
$user = getenv('DB_USER') ?: 'mgs_user';
$pass = getenv('DB_PASS') ?: 'pa55word';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
  $db = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (PDOException $e) {
  $error_message = $e->getMessage();
  include('database_error.php');
  exit();
}

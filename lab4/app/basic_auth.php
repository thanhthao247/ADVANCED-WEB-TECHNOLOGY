<?php
require_once __DIR__.'/util/secure_conn.php';
require_once __DIR__.'/model/database.php';
require_once __DIR__.'/model/admin_db.php';

$email = $_SERVER['PHP_AUTH_USER'] ?? '';
$pass  = $_SERVER['PHP_AUTH_PW']   ?? '';

if (!is_valid_admin_login($email,$pass)) {
  header('WWW-Authenticate: Basic realm="Admin"');
  header('HTTP/1.0 401 Unauthorized');
  echo "<h3>Unauthorized</h3>";
  exit;
}

echo "<h2>Basic Auth OK</h2><p>Welcome, ".htmlspecialchars($email)."</p>";

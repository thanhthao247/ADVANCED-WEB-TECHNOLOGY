<?php
session_start();
require_once __DIR__.'/util/secure_conn.php';
require_once __DIR__.'/model/database.php';
require_once __DIR__.'/model/admin_db.php';

$action = $_POST['action'] ?? ($_GET['action'] ?? 'show_admin_menu');

if (!isset($_SESSION['is_valid_admin'])) {
  $action = 'login';
}

switch ($action) {
  case 'login':
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    if ($email && $password && is_valid_admin_login($email,$password)) {
      $_SESSION['is_valid_admin'] = true;
      include __DIR__.'/view/admin_menu.php';
    } else {
      $login_message = 'You must login to view this page.';
      include __DIR__.'/view/login.php';
    }
    break;

  case 'logout':
    $_SESSION = [];
    session_destroy();
    $login_message = 'You have been logged out.';
    include __DIR__.'/view/login.php';
    break;

  case 'show_admin_menu':
  default:
    include __DIR__.'/view/admin_menu.php';
}

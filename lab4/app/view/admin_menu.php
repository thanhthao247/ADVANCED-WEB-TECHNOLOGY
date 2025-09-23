<?php
require_once __DIR__.'/../util/secure_conn.php';
require_once __DIR__.'/../util/valid_admin.php';
?>
<!doctype html><meta charset="utf-8">
<h2>Admin menu</h2>
<ul>
  <li><a href="/crypto/demo.php">Crypto demo</a></li>
  <li><a href="/basic_auth.php">Basic Auth demo</a></li>
  <li><a href="/?action=logout">Logout</a></li>
</ul>

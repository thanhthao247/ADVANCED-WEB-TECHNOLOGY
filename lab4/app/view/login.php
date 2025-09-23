<?php require_once __DIR__.'/../util/secure_conn.php'; ?>
<!doctype html><meta charset="utf-8">
<h2>Admin login</h2>
<form method="post" action=".">
  <input type="hidden" name="action" value="login">
  <p><input name="email" placeholder="Email" required></p>
  <p><input name="password" type="password" placeholder="Password" required></p>
  <button type="submit">Login</button>
</form>
<p style="color:#c00"><?php echo htmlspecialchars($login_message ?? ''); ?></p>

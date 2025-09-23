<?php
function add_admin($email, $password) {
  global $db;
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $st = $db->prepare('INSERT INTO administrators (emailAddress,password) VALUES (:e,:p)');
  $st->execute([':e'=>$email, ':p'=>$hash]);
}

function is_valid_admin_login($email, $password) {
  global $db;
  $st = $db->prepare('SELECT password FROM administrators WHERE emailAddress = :e');
  $st->execute([':e'=>$email]);
  $row = $st->fetch();
  if (!$row) return false;
  return password_verify($password, $row['password']);
}

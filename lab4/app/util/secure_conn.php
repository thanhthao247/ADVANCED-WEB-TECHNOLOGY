<?php
$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
       || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);

if (getenv('HTTPS_BEHIND_PROXY') === '1') {
  if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $https = true;
  }
}

if (!$https) {
  $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  $uri  = $_SERVER['REQUEST_URI'] ?? '/';
  $url  = 'https://' . $host . ':8443' . $uri;
  header("Location: $url");
  exit;
}

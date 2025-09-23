<?php
require_once __DIR__.'/../util/secure_conn.php';
require_once __DIR__.'/../util/valid_admin.php';
require_once __DIR__.'/crypt.php';

$cc = '4111111111111111';
$c = new Crypt();
$enc = $c->encrypt($cc);
$dec = $c->decrypt($enc);
echo "<pre>Encrypted: $enc\nDecrypted: $dec</pre>";

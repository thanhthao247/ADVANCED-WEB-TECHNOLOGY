<?php
require_once __DIR__ . '/defuse-crypto.phar';
use Defuse\Crypto\Key;
$key = Key::createNewRandomKey();
file_put_contents(__DIR__ . '/defuse-key.txt', $key->saveToAsciiSafeString());
echo "Key generated.\n";

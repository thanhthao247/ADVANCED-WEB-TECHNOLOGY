<?php
require_once __DIR__.'/defuse-crypto.phar';
use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;

class Crypt {
  private $key;
  public function __construct() {
    $keyAscii = file_get_contents(__DIR__.'/defuse-key.txt');
    $this->key = Key::loadFromAsciiSafeString($keyAscii);
  }
  public function encrypt($data) { return Crypto::encrypt($data, $this->key); }
  public function decrypt($enc) {
    try { return Crypto::decrypt($enc, $this->key); }
    catch (WrongKeyOrModifiedCiphertextException $ex) { throw new \Exception($ex->getMessage()); }
  }
}

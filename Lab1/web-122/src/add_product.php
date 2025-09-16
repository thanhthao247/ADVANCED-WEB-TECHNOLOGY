<?php
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
if ($category_id == null || $category_id == false || $code == null || $name == null || $price == null || $price == false) {
  $error = "Invalid product data. Check all fields and try again.";
  include('error.php');
  exit;
}
require_once('database.php');
try {
  $st = $db->prepare('INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES (:category_id,:code,:name,:price)');
  $st->bindValue(':category_id', $category_id);
  $st->bindValue(':code', $code);
  $st->bindValue(':name', $name);
  $st->bindValue(':price', $price);
  $st->execute();
  $st->closeCursor();
} catch (PDOException $e) {
  $driver = $e->errorInfo[1] ?? null;
  if ($driver == 1062) {
    $error = "Duplicate product code.";
    include('error.php');
    exit;
  }
  throw $e;
}
include('index.php');

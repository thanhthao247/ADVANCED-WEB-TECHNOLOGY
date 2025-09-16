<?php
require_once('database.php');
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
if ($product_id && $category_id) {
  $st = $db->prepare('DELETE FROM products WHERE productID=:id');
  $st->bindValue(':id', $product_id);
  $st->execute();
  $st->closeCursor();
}
include('index.php');

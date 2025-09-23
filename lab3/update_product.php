<?php
require('database.php');

if (!isset($_GET['productID'])) {
    $error = "Missing product ID.";
    include('error.php');
    exit();
}

$product_id = $_GET['productID'];

$query = 'SELECT * FROM product WHERE productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_code = $_POST['productCode'];
    $product_name = $_POST['productName'];
    $list_price   = $_POST['listPrice'];
    $category_id  = $_POST['categoryID'];

    $query = 'UPDATE product 
              SET productCode = :product_code, 
                  productName = :product_name, 
                  listPrice = :list_price,
                  categoryID = :category_id
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':list_price', $list_price);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();

    header("Location: index.php");
    exit();
}
include('update_product_form.php');
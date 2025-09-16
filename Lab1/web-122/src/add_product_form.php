<?php
require('database.php');
$st = $db->prepare('SELECT * FROM categories ORDER BY categoryID');
$st->execute();
$categories = $st->fetchAll();
$st->closeCursor();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <h1>Add Product</h1>
    </header>
    <main>
        <form action="add_product.php" method="post" id="add_product_form">
            <label>Category:</label><select name="category_id">
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['categoryID'] ?>"><?= htmlspecialchars($c['categoryName']) ?></option>
                <?php endforeach; ?>
            </select><br>
            <label>Code:</label><input type="text" name="code"><br>
            <label>Name:</label><input type="text" name="name"><br>
            <label>List Price:</label><input type="text" name="price"><br>
            <label>&nbsp;</label><input type="submit" value="Add Product"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>
</body>

</html>
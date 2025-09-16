<?php
require_once('database.php');
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if (!$category_id) {
    $category_id = 1;
}
$st1 = $db->prepare('SELECT * FROM categories WHERE categoryID=:id');
$st1->bindValue(':id', $category_id);
$st1->execute();
$cat = $st1->fetch();
$category_name = $cat ? $cat['categoryName'] : 'Unknown';
$st1->closeCursor();
$st2 = $db->prepare('SELECT * FROM categories ORDER BY categoryID');
$st2->execute();
$categories = $st2->fetchAll();
$st2->closeCursor();
$st3 = $db->prepare('SELECT * FROM products WHERE categoryID=:id ORDER BY productID');
$st3->bindValue(':id', $category_id);
$st3->execute();
$products = $st3->fetchAll();
$st3->closeCursor();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Guitar Shop</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <h1>Guitar Shop</h1>
    </header>
    <main class="layout">
        <aside>
            <h2>Categories</h2>
            <nav>
                <ul>
                    <?php foreach ($categories as $c): ?>
                        <li><a href=".?category_id=<?= $c['categoryID'] ?>"><?= htmlspecialchars($c['categoryName']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>
        <section>
            <h2><?= htmlspecialchars($category_name) ?></h2>
            <table>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th class="right">Price</th>
                    <th></th>
                </tr>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['productCode']) ?></td>
                        <td><?= htmlspecialchars($p['productName']) ?></td>
                        <td class="right"><?= htmlspecialchars($p['listPrice']) ?></td>
                        <td>
                            <form action="delete_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $p['productID'] ?>">
                                <input type="hidden" name="category_id" value="<?= $p['categoryID'] ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr><?php endforeach; ?>
            </table>
            <p><a class="btn" href="add_product_form.php">Add Product</a></p>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>

</html>
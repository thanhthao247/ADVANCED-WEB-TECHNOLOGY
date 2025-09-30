<?php
require 'connect.php';
$stmt = $pdo->query('SELECT p.id, p.code, p.name, p.listPrice, c.name AS category FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Guitar Shop - Catalog</title>
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <h1>Guitar Shop - Product Catalog</h1>
  <p><a href="/admin.php">Product Manager</a></p>
  <table border="1" cellpadding="8">
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th>Code</th>
      <th>Name</th>
      <th>List Price</th>
    </tr>
    <?php foreach ($products as $p): ?>
      <tr>
        <td><?php echo htmlspecialchars($p['id']); ?></td>
        <td><?php echo htmlspecialchars($p['category']); ?></td>
        <td><?php echo htmlspecialchars($p['code']); ?></td>
        <td><?php echo htmlspecialchars($p['name']); ?></td>
        <td><?php echo number_format($p['listPrice'], 2); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>
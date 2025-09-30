<?php
require 'connect.php';
$action = $_GET['action'] ?? '';
if ($action == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $st = $pdo->prepare('DELETE FROM products WHERE id=?');
    $st->execute([$id]);
    header('Location: /admin.php');
    exit;
}

$st = $pdo->query('SELECT p.id, p.code, p.name, p.listPrice, c.name AS category FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC');
$products = $st->fetchAll(PDO::FETCH_ASSOC);

$cats = $pdo->query('SELECT id, name FROM categories')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Product Manager</title>
<link rel="stylesheet" href="/css/style.css"></head><body>
<h1>Product Manager</h1>
<p><a href="/catalog.php">Catalog</a></p>
<p><a href="/admin.php?action=add">Add new product</a></p>
<?php if($action == 'add' || $action == 'edit'): 
    if ($action == 'edit') {
        $id = (int)$_GET['id'];
        $st = $pdo->prepare('SELECT * FROM products WHERE id=?');
        $st->execute([$id]);
        $prod = $st->fetch(PDO::FETCH_ASSOC);
    } else { $prod = null; }
?>
<form method="post" action="/admin.php?action=save">
  <p>Category: <select name="category_id"><?php foreach($cats as $c){ $sel = ($prod && $prod['category_id']==$c['id']) ? 'selected':''; echo "<option value={$c['id']} $sel>".htmlspecialchars($c['name'])."</option>"; }?></select></p>
  <p>Code: <input name="code" value="<?php echo htmlspecialchars($prod['code'] ?? '') ?>"></p>
  <p>Name: <input name="name" value="<?php echo htmlspecialchars($prod['name'] ?? '') ?>"></p>
  <p>List Price: <input name="listPrice" value="<?php echo htmlspecialchars($prod['listPrice'] ?? '') ?>"></p>
  <?php if($prod): ?><input type="hidden" name="id" value="<?php echo $prod['id']; ?>"><?php endif; ?>
  <p><button type="submit">Save</button> <a href="/admin.php">Cancel</a></p>
</form>
<?php elseif($action == 'save' && $_SERVER['REQUEST_METHOD']=='POST'):
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $category_id = (int)$_POST['category_id'];
    $code = trim($_POST['code']);
    $name = trim($_POST['name']);
    $listPrice = (float)$_POST['listPrice'];
    if ($id) {
        $st = $pdo->prepare('UPDATE products SET category_id=?, code=?, name=?, listPrice=? WHERE id=?');
        $st->execute([$category_id, $code, $name, $listPrice, $id]);
    } else {
        $st = $pdo->prepare('INSERT INTO products (category_id, code, name, listPrice) VALUES (?,?,?,?)');
        $st->execute([$category_id, $code, $name, $listPrice]);
    }
    header('Location: /admin.php');
    exit;
else: ?>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Category</th><th>Code</th><th>Name</th><th>List Price</th><th>Action</th></tr>
<?php foreach($products as $p): ?>
<tr>
  <td><?php echo htmlspecialchars($p['id']);?></td>
  <td><?php echo htmlspecialchars($p['category']);?></td>
  <td><?php echo htmlspecialchars($p['code']);?></td>
  <td><?php echo htmlspecialchars($p['name']);?></td>
  <td><?php echo number_format($p['listPrice'],2);?></td>
  <td><a href="/admin.php?action=edit&id=<?php echo $p['id'];?>">Edit</a> | <a href="/admin.php?action=delete&id=<?php echo $p['id'];?>" onclick="return confirm('Delete?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</body></html>

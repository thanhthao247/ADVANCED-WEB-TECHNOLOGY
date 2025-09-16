<?php
$host = getenv('DB_HOST');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (Throwable $e) {
  http_response_code(500);
  echo "<h1>DB connection failed</h1><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
  exit;
}
$action = $_POST['action'] ?? $_GET['action'] ?? '';
if ($action === 'create') {
  $name = trim($_POST['name'] ?? '');
  if ($name !== '') {
    $stmt = $pdo->prepare("INSERT INTO categories (categoryName) VALUES (?)");
    $stmt->execute([$name]);
    header("Location: /");
    exit;
  }
}
if ($action === 'update') {
  $id = intval($_POST['id'] ?? 0);
  $name = trim($_POST['name'] ?? '');
  if ($id > 0 && $name !== '') {
    $stmt = $pdo->prepare("UPDATE categories SET categoryName=? WHERE categoryID=?");
    $stmt->execute([$name, $id]);
    header("Location: /");
    exit;
  }
}
if ($action === 'delete') {
  $id = intval($_GET['id'] ?? 0);
  if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM categories WHERE categoryID=?");
    $stmt->execute([$id]);
    header("Location: /");
    exit;
  }
}
$rows = $pdo->query("SELECT categoryID, categoryName FROM categories ORDER BY categoryID")->fetchAll();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>My Guitar Shop - Categories (Docker Lab)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      margin: 2rem;
      line-height: 1.5;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 1rem;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: .5rem .75rem;
      text-align: left;
    }

    th {
      background: #f8f8f8;
    }

    form.inline {
      display: inline;
    }

    .grid {
      display: grid;
      gap: 1rem;
      grid-template-columns: 1fr;
    }

    .card {
      border: 1px solid #e5e5e5;
      border-radius: 12px;
      padding: 1rem;
    }

    .muted {
      color: #666;
    }

    .row {
      display: flex;
      gap: .5rem;
      align-items: center;
    }

    input[type=text] {
      padding: .5rem .75rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      min-width: 250px;
    }

    button {
      padding: .5rem .9rem;
      border-radius: 8px;
      background: black;
      color: white;
      border: none;
      cursor: pointer;
    }

    button.secondary {
      background: #555;
    }

    a.btn {
      display: inline-block;
      padding: .35rem .6rem;
      border-radius: 8px;
      background: #e53935;
      color: white;
      text-decoration: none;
    }

    code {
      background: #f0f0f0;
      padding: .1rem .3rem;
      border-radius: 6px;
    }
  </style>
</head>

<body>
  <h1>My Guitar Shop - Categories</h1>
  <div class="card">
    <h2>Create a new category</h2>
    <form method="post" class="row">
      <input type="hidden" name="action" value="create">
      <input type="text" name="name" placeholder="Category name" required>
      <button type="submit">Add</button>
    </form>
  </div>

  <div class="card">
    <h2>Existing categories</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['categoryID']) ?></td>
            <td>
              <form method="post" class="inline">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= htmlspecialchars($r['categoryID']) ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($r['categoryName']) ?>">
                <button type="submit" class="secondary">Save</button>
              </form>
            </td>
            <td>
              <a class="btn" href="?action=delete&id=<?= urlencode($r['categoryID']) ?>"
                onclick="return confirm('Delete this category?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <p class="muted">Try adding, renaming, and deleting categories above to exercise CRUD.</p>
  </div>

  <div class="card">
    <h2>Connection info</h2>
    <ul>
      <li>phpMyAdmin: <code>http://localhost:8081</code> (server: <code>db</code>, user: <code>root</code>, password:
        <code>rootpass</code>)
      </li>
      <li>Web app: <code>http://localhost:8080</code></li>
    </ul>
  </div>
</body>

</html>
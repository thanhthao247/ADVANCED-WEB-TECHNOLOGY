<?php
$kq = "";
$a = isset($_POST['a']) ? trim($_POST['a']) : "";
$b = isset($_POST['b']) ? trim($_POST['b']) : "";
if (isset($_POST['giai'])) {
  if ($a === "" || $b === "" || !is_numeric($a) || !is_numeric($b)) {
    $kq = "Vui lòng nhập a, b là số.";
  } else {
    $a = floatval($a); $b = floatval($b);
    if ($a == 0) {
      $kq = ($b == 0) ? "Phương trình có vô số nghiệm" : "Phương trình vô nghiệm";
    } else {
      $x = -$b / $a;
      $kq = "x = " . round($x, 2);
    }
  }
}
?><!doctype html><html lang="vi"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Bài 2 — Giải phương trình bậc 1</title><link rel="stylesheet" href="/assets/main.css">
</head><body><div class="container">
  <div class="card">
    <h1>Bài 2 — Giải phương trình bậc 1</h1>
    <form method="post">
      <p><label>a</label><input type="text" name="a" value="<?php echo htmlspecialchars($a); ?>"></p>
      <p><label>b</label><input type="text" name="b" value="<?php echo htmlspecialchars($b); ?>"></p>
      <p><button name="giai">Giải</button> <a class="tile" href="/">Về trang chủ</a></p>
      <?php if($kq!==""): ?><p>Kết quả: <code class="kq"><?php echo htmlspecialchars($kq); ?></code></p><?php endif; ?>
    </form>
  </div>
</div></body></html>

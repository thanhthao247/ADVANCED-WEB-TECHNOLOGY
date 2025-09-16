<?php
function giai_pt_bac1($a, $b)
{
  if ($a == 0)
    return ($b == 0) ? "Vô số nghiệm" : "Vô nghiệm";
  $x = -$b / $a;
  return "x = " . round($x, 2);
}
function giai_pt_bac2($a, $b, $c)
{
  if ($a == 0)
    return giai_pt_bac1($b, $c);
  $delta = $b * $b - 4 * $a * $c;
  if ($delta < 0)
    return "Vô nghiệm";
  if ($delta == 0)
    return "Nghiệm kép x1 = x2 = " . round(-$b / (2 * $a), 2);
  $can = sqrt($delta);
  $x1 = (-$b + $can) / (2 * $a);
  $x2 = (-$b - $can) / (2 * $a);
  return "2 nghiệm phân biệt: x1 = " . round($x1, 2) . ", x2 = " . round($x2, 2);
}
$kq = "";
$a = isset($_POST['a']) ? trim($_POST['a']) : "";
$b = isset($_POST['b']) ? trim($_POST['b']) : "";
$c = isset($_POST['c']) ? trim($_POST['c']) : "";
if (isset($_POST['giai'])) {
  if ($a === "" || $b === "" || $c === "" || !is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
    $kq = "Vui lòng nhập a, b, c là số.";
  } else {
    $kq = giai_pt_bac2(floatval($a), floatval($b), floatval($c));
  }
}
?><!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bài 5 — Giải phương trình bậc 2</title>
  <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Bài 5 — Giải phương trình bậc 2 (dùng hàm)</h1>
      <form method="post">
        <p><label>a</label><input type="text" name="a" value="<?php echo htmlspecialchars($a); ?>"></p>
        <p><label>b</label><input type="text" name="b" value="<?php echo htmlspecialchars($b); ?>"></p>
        <p><label>c</label><input type="text" name="c" value="<?php echo htmlspecialchars($c); ?>"></p>
        <p><button name="giai">Giải</button> <a class="tile" href="/">Về trang chủ</a></p>
        <?php if ($kq !== ""): ?>
          <p>Kết quả: <code class="kq"><?php echo htmlspecialchars($kq); ?></code></p><?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>
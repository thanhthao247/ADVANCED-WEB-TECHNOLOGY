<?php
$n = isset($_POST['so_phan_tu']) ? trim($_POST['so_phan_tu']) : "";
$mang = [];
$err = "";
$maxv = $minv = $tong = null;
if (isset($_POST['tinh'])) {
  if ($n === "" || !ctype_digit($n) || intval($n) <= 0) {
    $err = "Số phần tử phải là số nguyên dương.";
  } else {
    $n = intval($n);
    for ($i = 0; $i < $n; $i++) {
      $mang[$i] = mt_rand(0, 20);
    }
    $maxv = max($mang);
    $minv = min($mang);
    $tong = array_sum($mang);
  }
}
function xuat_mang($arr)
{
  if (!$arr)
    return "";
  return implode(" ", $arr);
}
?><!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bài 6.2 — Phát sinh mảng, tính toán</title>
  <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Bài 6.2 — Phát sinh mảng và tính toán</h1>
      <form method="post">
        <p><label>Nhập số phần tử</label><input type="text" name="so_phan_tu"
            value="<?php echo htmlspecialchars($n); ?>"></p>
        <p><input type="submit" name="tinh" value="Phát sinh và tính toán"> <a class="tile" href="/">Về trang chủ</a>
        </p>
        <?php if ($err): ?>
          <p class="notice"><?php echo htmlspecialchars($err); ?></p><?php endif; ?>
        <?php if ($err === "" && $mang): ?>
          <p>Mảng: <code class="kq"><?php echo htmlspecialchars(xuat_mang($mang)); ?></code></p>
          <p>GTLN (max): <code class="kq"><?php echo htmlspecialchars($maxv); ?></code></p>
          <p>GTNN (min): <code class="kq"><?php echo htmlspecialchars($minv); ?></code></p>
          <p>Tổng mảng: <code class="kq"><?php echo htmlspecialchars($tong); ?></code></p>
        <?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>
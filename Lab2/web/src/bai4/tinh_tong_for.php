<?php
$tong = $tich = $tong_chan = $tong_le = null;
$so_dau = isset($_POST['so_dau']) ? trim($_POST['so_dau']) : "";
$so_cuoi = isset($_POST['so_cuoi']) ? trim($_POST['so_cuoi']) : "";
$err = "";
if (isset($_POST['tinh'])) {
  if ($so_dau === "" || $so_cuoi === "" || !is_numeric($so_dau) || !is_numeric($so_cuoi)) {
    $err = "Vui lòng nhập số bắt đầu / kết thúc là số.";
  } else {
    $d = intval($so_dau);
    $c = intval($so_cuoi);
    if ($d > $c):
      $err = "Số bắt đầu phải ≤ số kết thúc.";
    else:
      $tong = 0;
      $tich = 1;
      $tong_chan = 0;
      $tong_le = 0;
      for ($i = $d; $i <= $c; $i++) {
        $tong += $i;
      }
      $range = $c - $d + 1;
      if ($range > 100) {
        $tich = "Quá lớn (vượt 100 phần tử)";
      } else {
        for ($i = $d; $i <= $c; $i++) {
          $tich *= $i;
        }
      }
      for ($i = $d; $i <= $c; $i++) {
        if ($i % 2 == 0)
          $tong_chan += $i;
      }
      for ($i = $d; $i <= $c; $i++) {
        if ($i % 2 != 0)
          $tong_le += $i;
      }
    endif;
  }
}
?><!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bài 4 — Tính toán dãy số (for)</title>
  <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Bài 4 — Tính toán dãy số</h1>
      <form method="post">
        <p><label>Số bắt đầu</label><input type="text" name="so_dau" value="<?php echo htmlspecialchars($so_dau); ?>">
        </p>
        <p><label>Số kết thúc</label><input type="text" name="so_cuoi"
            value="<?php echo htmlspecialchars($so_cuoi); ?>"></p>
        <p><input type="submit" name="tinh" value="Tính toán"> <a class="tile" href="/">Về trang chủ</a></p>
        <?php if ($err): ?>
          <p class="notice"><?php echo htmlspecialchars($err); ?></p><?php endif; ?>
        <?php if ($err === "" && $tong !== null): ?>
          <p>Tổng các số: <code class="kq"><?php echo htmlspecialchars($tong); ?></code></p>
          <p>Tích các số: <code class="kq"><?php echo is_numeric($tich) ? htmlspecialchars($tich) : $tich; ?></code></p>
          <p>Tổng các số chẵn: <code class="kq"><?php echo htmlspecialchars($tong_chan); ?></code></p>
          <p>Tổng các số lẻ: <code class="kq"><?php echo htmlspecialchars($tong_le); ?></code></p>
        <?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>
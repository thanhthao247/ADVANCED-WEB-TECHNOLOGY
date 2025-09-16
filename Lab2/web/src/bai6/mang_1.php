<?php
$nhap = isset($_POST['nhap_mang']) ? $_POST['nhap_mang'] : "";
$ket_qua = null;
$err = "";
if (isset($_POST['goi'])) {
  if ($nhap === "") {
    $err = "Vui lòng nhập dãy số, cách nhau bằng dấu phẩy (,).";
  } else {
    $parts = array_map('trim', explode(',', $nhap));
    $nums = [];
    foreach ($parts as $p) {
      if ($p === "" || !is_numeric($p)) {
        $err = "Dãy chứa giá trị không hợp lệ.";
        break;
      }
      $nums[] = floatval($p);
    }
    if ($err === "") {
      $ket_qua = array_sum($nums);
    }
  }
}
?><!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bài 6.1 — Tổng dãy số</title>
  <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Bài 6.1 — Nhập và tính trên dãy số</h1>
      <form method="post">
        <p><label>Nhập dãy số</label><input type="text" name="nhap_mang" value="<?php echo htmlspecialchars($nhap); ?>"
            placeholder="vd: 1,2,3,4"></p>
        <p><input type="submit" name="goi" value="Tổng dãy số"> <a class="tile" href="/">Về trang chủ</a></p>
        <?php if ($err): ?>
          <p class="notice"><?php echo htmlspecialchars($err); ?></p><?php endif; ?>
        <?php if ($err === "" && $ket_qua !== null): ?>
          <p>Tổng: <code class="kq"><?php echo htmlspecialchars($ket_qua); ?></code></p><?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>
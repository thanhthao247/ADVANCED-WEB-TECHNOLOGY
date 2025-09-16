<?php
$nhap = isset($_POST['nhap_mang']) ? $_POST['nhap_mang'] : "";
$chuoi = "";
$unique_str = "";
$err = "";
if (isset($_POST['thuchien'])) {
  if ($nhap === "") {
    $err = "Vui lòng nhập mảng (các số cách nhau bởi dấu phẩy ,).";
  } else {
    $parts = array_map('trim', explode(',', $nhap));
    $nums = [];
    foreach ($parts as $p) {
      if ($p === "" || !is_numeric($p)) {
        $err = "Chuỗi có phần tử không hợp lệ.";
        break;
      }
      $nums[] = $p + 0;
    }
    if ($err === "") {
      $count = array_count_values($nums);
      $uni = array_unique($nums);
      $pairs = [];
      foreach ($count as $k => $v) {
        $pairs[] = $k . ':' . $v;
      }
      $chuoi = implode(' ', $pairs);
      $unique_str = implode(', ', $uni);
    }
  }
}
?><!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bài 6.3 — Đếm số lần & mảng duy nhất</title>
  <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Bài 6.3 — Đếm số lần xuất hiện & tạo mảng duy nhất</h1>
      <form method="post">
        <p><label>Mảng</label><input type="text" name="nhap_mang" value="<?php echo htmlspecialchars($nhap); ?>"
            placeholder="vd: 1,2,2,3,4,4,4"></p>
        <p><input type="submit" name="thuchien" value="Thực hiện"> <a class="tile" href="/">Về trang chủ</a></p>
        <?php if ($err): ?>
          <p class="notice"><?php echo htmlspecialchars($err); ?></p><?php endif; ?>
        <?php if ($err === "" && $chuoi !== ""): ?>
          <p>Số lần xuất hiện: <code class="kq"><?php echo htmlspecialchars($chuoi); ?></code></p>
          <p>Mảng duy nhất: <code class="kq"><?php echo htmlspecialchars($unique_str); ?></code></p>
        <?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>
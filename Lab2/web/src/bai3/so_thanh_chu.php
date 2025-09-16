<?php
$chu = "";
$so = isset($_POST['so']) ? trim($_POST['so']) : "";
if (isset($_POST['submit'])) {
  if ($so === "" || !is_numeric($so)) {
    $chu = "Không hợp lệ";
  } else {
    switch (intval($so)) {
      case 0:
        $chu = "Không";
        break;
      case 1:
        $chu = "Một";
        break;
      case 2:
        $chu = "Hai";
        break;
      case 3:
        $chu = "Ba";
        break;
      case 4:
        $chu = "Bốn";
        break;
      case 5:
        $chu = "Năm";
        break;
      case 6:
        $chu = "Sáu";
        break;
      case 7:
        $chu = "Bảy";
        break;
      case 8:
        $chu = "Tám";
        break;
      case 9:
        $chu = "Chín";
        break;
      default:
        $chu = "Không hợp lệ";
    }
  }
}
?><!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bài 3 — Số thành chữ</title>
  <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Bài 3 — Đọc số (0–9) thành chữ</h1>
      <form method="post">
        <p><label>Nhập số (0–9)</label><input type="text" name="so" value="<?php echo htmlspecialchars($so); ?>"></p>
        <p><input type="submit" name="submit" value="Submit"> <a class="tile" href="/">Về trang chủ</a></p>
        <?php if ($chu !== ""): ?>
          <p>Kết quả: <code class="kq"><?php echo htmlspecialchars($chu); ?></code></p><?php endif; ?>
      </form>
    </div>
  </div>
</body>

</html>
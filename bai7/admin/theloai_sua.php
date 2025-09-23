<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sửa Thể Loại</title>
</head>

<body>
<?php 
include("../connect.php");

if (isset($_GET['idTL'])) {
    $sl = "SELECT * FROM theloai WHERE idTL=" . $_GET['idTL'];
    $results = mysqli_query($connect, $sl);
    $d = mysqli_fetch_array($results);
}
?>

<form action="" method="post" enctype="multipart/form-data" name="form1">
    <table align="left" width="400" cellpadding="5" cellspacing="0">
        <tr>
            <td align="right">Tên Thể Loại</td>
            <td>
                <input type="text" name="TenTL" value="<?php echo $d['TenTL']; ?>" />
            </td>
        </tr>

        <tr>
            <td align="right">Thứ Tự</td>
            <td>
                <input type="text" name="ThuTu" value="<?php echo $d['ThuTu']; ?>" />
            </td>
        </tr>

        <tr>
            <td align="right">Ẩn / Hiện</td>
            <td>
                <select name="AnHien">
                    <option value="0" <?php if ($d['AnHien'] == 0) echo "selected"; ?>>Ẩn</option>
                    <option value="1" <?php if ($d['AnHien'] == 1) echo "selected"; ?>>Hiện</option>
                </select>
            </td>
        </tr>

        <tr>
            <td align="right">Icon hiện tại</td>
            <td>
                <img src="../image/<?php echo $d['icon']; ?>" width="40" height="40" />
            </td>
        </tr>

        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <input type="file" name="image" id="image" />
                <input type="hidden" name="ten_anh" value="<?php echo $d['icon']; ?>" />
            </td>
        </tr>

        <tr>
            <td align="right">
                <input type="hidden" name="idTL" value="<?php echo $_GET['idTL']; ?>" />
                <input type="submit" name="Sua" value="Sửa" />
            </td>
            <td>
                <input type="reset" name="Huy" value="Hủy" />
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST["TenTL"])) $theloai = $_POST['TenTL'];
if (isset($_POST["ThuTu"])) $thutu = $_POST['ThuTu'];
if (isset($_POST["AnHien"])) $an = $_POST['AnHien'];

$ten_file_tai_len = "";
if (isset($_FILES["image"]["name"])) {
    $ten_file_tai_len = $_FILES["image"]["name"];
}

if ($ten_file_tai_len != "") {
    $icon = $ten_file_tai_len;
} else {
    if (isset($_POST['ten_anh'])) $icon = $_POST['ten_anh'];
}

if (isset($_GET["idTL"])) $key = $_GET["idTL"];

if (isset($_POST['Sua'])) {
    $sl = "SELECT COUNT(*) FROM theloai WHERE icon='$icon'";
    $results = mysqli_query($connect, $sl);
    $d = mysqli_fetch_array($results);

    if ($d[0] == 0 || $ten_file_tai_len == "") {
        $sl = "UPDATE theloai 
               SET TenTL='$theloai', ThuTu='$thutu', AnHien='$an', icon='$icon' 
               WHERE idTL ='$key'";

        if ($ten_file_tai_len != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $ten_file_tai_len);

            $duong_dan_anh_cu = "../image/" . filter_input(INPUT_POST, "ten_anh");
            unlink($duong_dan_anh_cu);
        }

        if (mysqli_query($connect, $sl)) {
            echo "<script language='javascript'>
                    alert('Sửa thành công');
                    location.href='theloai.php';
                  </script>";
        }
    } else {
        echo "<script language='javascript'>
                alert('Ảnh bị trùng tên');
                location.href='theloai_sua.php?idTL=$key';
              </script>";
    }
}
?>
</body>
</html>
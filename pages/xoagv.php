<?php
session_start();
if(!isset($_SESSION['vaitro'])) {
  header("location:../index.php");
}
require_once __DIR__. "/../config/db.php";

$magv = $_GET['id'];
$sql = "SELECT * FROM detai WHERE magv='$magv'";
$query = mysqli_query($connect, $sql);
$num_row = mysqli_num_rows($query);
if ($num_row==0) {
    $sql = "DELETE FROM giangvien WHERE id='$magv'";
    mysqli_query($connect, $sql);
    header("location:giangvien.php");
} else {
    echo "<script>
    alert('Không thể xóa giảng viên có id=$magv');
    window.location.href='giangvien.php';
    </script>";
}


?>
<?php
session_start();
if(!isset($_SESSION['vaitro'])) {
  header("location:../index.php");
}
require_once __DIR__. "/../config/db.php";

$masvhp = $_GET['id'];
$sql_nhom = "SELECT * FROM nhom WHERE masvhp='$masvhp'";
$query_nhom = mysqli_query($connect, $sql_nhom);
$num_row_nhom = mysqli_num_rows($query_nhom);

if ($num_row_nhom==0) {
    $sql = "DELETE FROM svhp WHERE masvhp='$masvhp'";
    mysqli_query($connect, $sql);
    header("location:svhp.php");
} else {
    echo "<script>
    alert('Không thể thực hiện xóa');
    window.location.href='svhp.php';
    </script>";
}
?>
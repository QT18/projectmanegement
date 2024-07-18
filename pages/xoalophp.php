<?php
session_start();
if(!isset($_SESSION['vaitro'])) {
  header("location:../index.php");
}
require_once __DIR__. "/../config/db.php";

$malophp = $_GET['id'];
$sql_lophp = "SELECT * FROM svhp WHERE mahp='$malophp'";
$query_lophp = mysqli_query($connect, $sql_lophp);
$num_row_lophp = mysqli_num_rows($query_lophp);
if ($num_row_lophp==0) {
    $sql = "DELETE FROM lophp WHERE malop='$malophp'";
    mysqli_query($connect, $sql);
    header("location:lophocphan.php");
} else {
    echo "<script>
    alert('Không thể xóa lớp học phần mã là $malophp');
    window.location.href='lophocphan.php';
    </script>";
}
?>
<?php
session_start();
if(!isset($_SESSION['vaitro'])) {
  header("location:../index.php");
}
require_once __DIR__. "/../config/db.php";

$malop = $_GET['id'];
$sql = "SELECT * FROM sinhvien WHERE malop='$malop'";
$query = mysqli_query($connect, $sql);
$num_row = mysqli_num_rows($query);
$msg=0;
if ($num_row==0) {
    $sql = "DELETE FROM lopdn WHERE MaLop='$malop'";
    mysqli_query($connect, $sql);
    $msg=1;
} else {
    $msg=0;
}
header("location:lopdanhnghia.php?msg=$msg");

?>
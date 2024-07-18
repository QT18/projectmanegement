<?php
session_start();
if(!isset($_SESSION['vaitro'])) {
  header("location:../index.php");
}
require_once __DIR__. "/../config/db.php";

$maloaida = $_GET['id'];
$sql_dt = "SELECT * FROM detai WHERE maloaida='$maloaida'";
$query_dt = mysqli_query($connect, $sql_dt);
$num_row_dt = mysqli_num_rows($query_dt);

$sql_lophp = "SELECT * FROM lophp WHERE maloaida='$maloaida'";
$query_lophp = mysqli_query($connect, $sql_lophp);
$num_row_lophp = mysqli_num_rows($query_lophp);
if (($num_row_dt==0)&&($num_row_lophp==0)) {
    $sql = "DELETE FROM loaida WHERE maloai='$maloaida'";
    mysqli_query($connect, $sql);
    header("location:loaidoan.php");
} else {
    echo "<script>
    alert('Không thể xóa loại đồ án $maloaida');
    window.location.href='loaidoan.php';
    </script>";
}


?>
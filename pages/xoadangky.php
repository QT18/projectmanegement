<?php
    session_start();
    if(!isset($_SESSION['vaitro'])) {
      header("location:../index.php");
    }
    require_once __DIR__. "/../config/db.php";

    if(isset($_GET['id'])) {
        $madk = $_GET['id'];

        $sql = "SELECT diem, baocao ".
              "FROM dangky a, nhom b, svhp c ".
              "WHERE a.madk=b.madk AND b.masvhp=c.masvhp ".
              "AND a.madk='$madk' AND (diem IS NOT NULL OR baocao IS NOT NULL OR a.trangthai=1) ";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($query);
        if ($row == 0) {
          $sql = "DELETE FROM nhom WHERE madk='$madk'";
          mysqli_query($connect, $sql);

          $sql = "DELETE FROM dangky WHERE madk='$madk'";
          mysqli_query($connect, $sql);
          header('location:dsdangky.php');
        } else {
          echo "<script>
                alert('Không thể xóa đăng ký vì đã có điểm hoặc nộp báo cáo hoặc đã được chấp thuận thực hiện');
                window.location.href='dsdangky.php';
                </script>";
        }
    } else {
      header('location:dsdangky.php');
    }


    
?>
<?php
    session_start();
    if(!isset($_SESSION['vaitro'])) {
      header("location:../index.php");
    }
    require_once __DIR__. "/../config/db.php";

    if(isset($_GET['id'])) {
        $madt = $_GET['id'];

        $sql = "SELECT * FROM dangky WHERE madt='$madt'";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($query);
        if ($row == 0) {
          $sql = "DELETE FROM detai WHERE madt='$madt'";
          mysqli_query($connect, $sql);
          header('location:detai.php');
        } else {
          echo "<script>
                alert('Không thể xóa đề tài vì đã có đăng ký');
                window.location.href='detai.php';
                </script>";
        }
    } else {
      header('location:detai.php');
    }


    
?>
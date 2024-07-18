<?php
    $connect = mysqli_connect('localhost', 'root', '', 'projectmanagement');
    if ($connect) {        
    } else {
        echo 'Kết nối không thành công';
    }
?>
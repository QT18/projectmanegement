<?php 
  session_start();
  require_once __DIR__. "/config/db.php";
  if (isset($_POST['login'])) {
    $username = $_POST['inputUsername'];
    $password = $_POST['inputPassword'];
    $hasspassword = md5($password);

    $sql = "SELECT * FROM sinhvien WHERE mssv='$username' and pwd='$hasspassword' and trangthai='1'";
    $query = mysqli_query($connect, $sql);      
    $num_row = mysqli_num_rows($query);      
    if ($num_row > 0) {
      $row = mysqli_fetch_assoc($query);
      $_SESSION['sv'] = $row['mssv'];
      $_SESSION['hoten'] = $row['ho'].' '.$row['ten'];
    } else {
      $sql = "SELECT * FROM giangvien WHERE username='$username' and pwd='$hasspassword' and trangthai='1'";
      $query = mysqli_query($connect, $sql);      
      $num_row = mysqli_num_rows($query);
      if ($num_row > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['gv'] = $row['id'];
        $_SESSION['hoten'] = $row['ho'].' '.$row['ten'];        
        if($row['vaitro'] == 1) {
          $_SESSION['vaitro'] = 1;
        }
      }
    }
  } else if (isset($_POST['update'])) {
    $sql = "";
    $matkhau = $_POST['inputPassword'];
    if (!empty($matkhau)) {
      $matkhau = md5($matkhau);
      if (isset($_SESSION['sv'])) {
       $mssv = $_SESSION['sv'];
       $sql = "UPDATE sinhvien SET pwd='$matkhau' WHERE mssv='$mssv'";
       mysqli_query($connect, $sql);
      } else if (isset($_SESSION['gv'])) {
        $id = $_SESSION['gv'];
        $sql = "UPDATE giangvien SET pwd='$matkhau' WHERE id='$id'";
        mysqli_query($connect, $sql);
      }
      $message = "Cập nhật thành công";
    }
  } 
  if (isset($_SESSION['sv'])) {
      $username = $_SESSION['sv'];
      $sql = "SELECT * FROM sinhvien WHERE mssv='$username'";
      $query = mysqli_query($connect, $sql);      
      $row = mysqli_fetch_assoc($query);    
  } 
  
  if (isset($_SESSION['gv'])) {
      $magv = $_SESSION['gv'];
      $sql = "SELECT * FROM giangvien WHERE id='$magv'";
      $query = mysqli_query($connect, $sql);      
      $row = mysqli_fetch_assoc($query);    
  } 

  ?>

  <?php
  require_once __DIR__. "/header.php"; 
  require_once __DIR__. "/nav.php";

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Quản lý đăng ký đồ án</h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">        
            <?php 
              if (!isset($_SESSION['sv']) && !isset($_SESSION['gv'])) {                
                require_once __DIR__. '/login.php';
              } elseif (isset($_SESSION['sv'])) {
                require_once __DIR__. '/profile_sv.php';
              } elseif (isset($_SESSION['gv'])) {
                require_once __DIR__. '/profile_gv.php';
              }
            ?>            
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php require_once __DIR__. "/footer.php"; ?>

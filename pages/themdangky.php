<?php
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>

<?php require_once __DIR__. "/../config/db.php"; ?>
<?php   

    if (isset($_POST['sbm'])) {
        
        $sql = "INSERT INTO giangvien(ho, ten, username, pwd, email, trangthai, vaitro) VALUES ('$ho', '$ten', '$username', '$password', '$email', '$tt', '$vt')";

        $query = mysqli_query($connect, $sql);
        header('location:dssdangky.php');
    }

    $sql_detai = 
?>

<?php require_once __DIR__. "/../header.php"; ?>
<?php require_once __DIR__. "/../nav.php"; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm dangky</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm đăng ký</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <form method="POST" enctype="multipart/form-data">
      <div class="row">        
        <div class="col-md-12">
          <div class="card card-primary">            
            <div class="card-body">
              <div class="form-group">
                <label for="inputHo">Họ giảng viên: </label>
                <input type="text" name="inputHo" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputTen">Tên giảng viên: </label>
                <input type="text" name="inputTen" class="form-control">
              </div>      
              <div class="form-group">
                <label for="inputUsername">Tên tài khoản: </label>
                <input type="text" name="inputUsername" class="form-control">
              </div>               
              <div class="form-group">
                <label for="inputEmail">Email: </label>
                <input type="text" name="inputEmail" class="form-control">
              </div>              

              <div class="form-group">
                <label for="inputTT">Trạng thái: </label>
                <select name="inputTT" class="form-control custom-select">
                  <option value="1" selected>Đang làm việc</option>
                  <option value="0">Đã nghỉ</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputVT">Vai trò: </label>
                <select name="inputVT" class="form-control custom-select">
                  <option value="1" >Quản trị</option>
                  <option value="0" selected>Giảng viên</option>
                </select>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>
      <div class="row">
        <div class="col-1">
          <a href="sinhvien.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Thêm </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
<?php
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>

<?php require_once __DIR__. "/../config/db.php"; ?>
<?php
    if (isset($_POST['sbm'])) {
        $id = $_POST['inputID'];
        $ho = $_POST['inputHo'];
        $ten = $_POST['inputTen'];
        $username = $_POST['inputUsername'];
        $email = $_POST['inputEmail'];
        $tt = $_POST['inputTT'];
        $vt = $_POST['inputVT'];

        $sql = "UPDATE giangvien SET ho='$ho', ten='$ten', username='$username', email='$email', trangthai='$tt', vaitro='$vt' WHERE id='$id'";
        $query = mysqli_query($connect, $sql);
        header('location:giangvien.php');
    }
    if (isset($_POST['reset'])) {
      $id = $_POST['inputID'];
      $password = md5("123");
      
      $sql = "UPDATE giangvien SET pwd='$password' WHERE id='$id'";

      $query = mysqli_query($connect, $sql);
  }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql_gv = "SELECT * FROM giangvien WHERE id = '$id'";
        $query_gv = mysqli_query($connect, $sql_gv);        
        $row_gv = mysqli_fetch_assoc($query_gv);    
    }
?>

<?php require_once __DIR__. "/../header.php"; ?>
<?php require_once __DIR__. "/../nav.php"; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa thông tin giảng viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sửa giảng viên</li>
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
                <label for="inputID">Mã số giảng viên: </label>
                <input type="text" name="inputID" class="form-control" value="<?php echo $row_gv['id']; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="inputHo">Họ giảng viên: </label>
                <input type="text" name="inputHo" class="form-control" value="<?php echo $row_gv['ho']; ?>">
              </div>
              <div class="form-group">
                <label for="inputTen">Tên sinh viên: </label>
                <input type="text" name="inputTen" class="form-control" value="<?php echo $row_gv['ten']; ?>">
              </div>     
              <div class="form-group">
                <label for="inputUsername">Tên tài khoản: </label>
                <input type="text" name="inputUsername" class="form-control" value="<?php echo $row_gv['username']; ?>">
              </div>               
              <div class="form-group">
                <label for="inputEmail">Email: </label>
                <input type="text" name="inputEmail" class="form-control" value="<?php echo $row_gv['email']; ?>">
              </div>
              <div class="form-group">
                <label for="inputTT">Trạng thái: </label>
                <select name="inputTT" class="form-control custom-select">
                  <option value="1" <?php if ($row_gv['trangthai']==1) echo "selected" ?>>Đang làm việc</option>
                  <option value="0" <?php if ($row_gv['trangthai']==0) echo "selected" ?>>Đã nghỉ</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputVT">Vai trò: </label>
                <select name="inputVT" class="form-control custom-select">
                  <option value="1" <?php if ($row_gv['vaitro']==1) echo "selected" ?>>Quản trị</option>
                  <option value="0" <?php if ($row_gv['vaitro']==0) echo "selected" ?>>Giảng viên</option>
                </select>
              </div>
              <div class="form-group">
              <button name="reset" class="btn btn-success float-right">Reset mật khẩu </button>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>
      <div class="row">
        <div class="col-1">
          <a href="giangvien.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Lưu </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
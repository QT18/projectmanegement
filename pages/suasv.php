<?php
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>

<?php require_once __DIR__. "/../config/db.php"; ?>
<?php
    if (isset($_POST['sbm'])) {
        $mssv = $_POST['inputMSSV'];
        $ho = $_POST['inputHo'];
        $ten = $_POST['inputTen'];
        $email = $_POST['inputEmail'];
        $malop = $_POST['inputMaLop'];
        $tt = $_POST['inputTT'];
        
        $sql = "UPDATE sinhvien SET ho='$ho', ten='$ten', email='$email', malop='$malop', trangthai='$tt' WHERE mssv='$mssv'";

        $query = mysqli_query($connect, $sql);
        header('location:sinhvien.php');
    }

    if (isset($_POST['reset'])) {
      $mssv = $_POST['inputMSSV'];
      $password = md5("123");
      $sql = "UPDATE sinhvien SET pwd='$password' WHERE mssv='$mssv'";
      $query = mysqli_query($connect, $sql);
    }

    $sql_lop = "SELECT MaLop FROM lopdn ORDER BY MaLop";
    $query_lop = mysqli_query($connect, $sql_lop);

    if (isset($_GET['id'])) {
        $mssv = $_GET['id'];
        $sql_sv = "SELECT * FROM sinhvien WHERE mssv = '$mssv'";
        $query_sv = mysqli_query($connect, $sql_sv);        
        $row_sv = mysqli_fetch_assoc($query_sv);    
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
            <h1>Thêm sinh viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sửa sinhvien</li>
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
                <label for="inputMSSV">Mã số sinh viên: </label>
                <input type="text" name="inputMSSV" class="form-control" value="<?php echo $row_sv['mssv']; ?>" >
              </div>
              <div class="form-group">
                <label for="inputHo">Họ sinh viên: </label>
                <input type="text" name="inputHo" class="form-control" value="<?php echo $row_sv['ho']; ?>">
              </div>
              <div class="form-group">
                <label for="inputTen">Tên sinh viên: </label>
                <input type="text" name="inputTen" class="form-control" value="<?php echo $row_sv['ten']; ?>">
              </div>              
              <div class="form-group">
                <label for="inputEmail">Email: </label>
                <input type="text" name="inputEmail" class="form-control" value="<?php echo $row_sv['email']; ?>">
              </div>
              <div class="form-group">
                <label for="inputMaLop">Lớp: </label>
                <select name="inputMaLop" class="form-control custom-select">
                  <?php
                    while($row_lop = mysqli_fetch_assoc($query_lop)) {
                        ?>
                    <option value="<?php echo $row_lop['MaLop']; ?>" <?php if ($row_lop['MaLop']==$row_sv['malop']) echo "selected"; ?>>
                        <?php echo $row_lop['MaLop']; ?>
                    </option>
                        <?php
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputTT">Trạng thái: </label>
                <select name="inputTT" class="form-control custom-select">
                  <option value="1" <?php if ($row_sv['trangthai']==1) echo "selected" ?>>Đang học</option>
                  <option value="2" <?php if ($row_sv['trangthai']==2) echo "selected" ?>>Tốt nghiệp</option>
                  <option value="0" <?php if ($row_sv['trangthai']==0) echo "selected" ?>>Thôi học</option>
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
          <a href="sinhvien.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Lưu </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
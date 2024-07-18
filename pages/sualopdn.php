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
        $name = $_POST['inputName'];
        $cvht = $_POST['inputTeacher'];
        $khoa = $_POST['inputYear'];
        $tt = $_POST['inputStatus'];
        
        $sql = "UPDATE lopdn SET TenLop='$name', CVHT='$cvht', Khoa='$khoa', TrangThai='$tt' WHERE MaLop='$id'";

        $query = mysqli_query($connect, $sql);
        header('location:lopdanhnghia.php');
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];        
        $sql = "SELECT * FROM lopdn WHERE MaLop = '$id'";
        $query = mysqli_query($connect, $sql);        
        $row = mysqli_fetch_row($query);        
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
            <h1>Thêm lớp danh nghĩa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm lớp danh nghĩa</li>
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
                <label for="inputID">Mã lớp danh nghĩa: </label>
                <input type="text" name="inputID" class="form-control" value="<?php echo $row[0]; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="inputName">Tên lớp danh nghĩa: </label>
                <input type="text" name="inputName" class="form-control" value="<?php echo $row[1]; ?>">
              </div>
              <div class="form-group">
                <label for="inputTeacher">Họ tên cố vấn học tập: </label>
                <input type="text" name="inputTeacher" class="form-control" value="<?php echo $row[2]; ?>">
              </div>              
              <div class="form-group">
                <label for="inputYear">Khóa: </label>
                <input type="text" name="inputYear" class="form-control" value="<?php echo $row[3]; ?>">
              </div>
              <div class="form-group">
                <label for="inputStatus">Trạng thái: </label>
                <select name="inputStatus" class="form-control custom-select">
                  <option value="0" <?php if ($row[4]==0) echo "selected"; ?>>Kết thúc</option>
                  <option value="1" <?php if ($row[4]==1) echo "selected"; ?>>Đang học</option>
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
          <a href="lopdanhnghia.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Lưu </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
<?php 
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>
<?php require_once __DIR__. "/../config/db.php"; ?>
<?php
    if (isset($_POST['sbm'])) {
        $maloai = $_POST['inputMaLoai'];
        $tenloai = $_POST['inputTenLoai'];
        $mota = $_POST['inputMoTa'];
        $tt = $_POST['inputTrangThai'];
        
        $sql = "UPDATE loaida SET tenloai='$tenloai', mota='$mota', trangthai='$tt' WHERE maloai='$maloai'";

        $query = mysqli_query($connect, $sql);
        header('location:loaidoan.php');
    }

    if (isset($_GET['id'])) {
        $maloai = $_GET['id'];
        $sql_loaida = "SELECT * FROM loaida WHERE maloai = '$maloai'";
        $query_loaida = mysqli_query($connect, $sql_loaida);        
        $row_loaida = mysqli_fetch_assoc($query_loaida);    
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
            <h1>Sửa loại đồ án</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sửa loại đồ án</li>
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
                <label for="inputMaLoai">Mã số loại đồ án: </label>
                <input type="text" name="inputMaLoai" class="form-control" value="<?php echo $row_loaida['maloai']; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="inputTenLoai">Họ sinh viên: </label>
                <input type="text" name="inputTenLoai" class="form-control" value="<?php echo $row_loaida['tenloai']; ?>">
              </div>
              <div class="form-group">
                <label for="inputMoTa">Tên sinh viên: </label>
                <input type="text" name="inputMoTa" class="form-control" value="<?php echo $row_loaida['mota']; ?>">
              </div>                                     

              <div class="form-group">
                <label for="inputTrangThai">Trạng thái: </label>
                <select name="inputTrangThai" class="form-control custom-select">
                  <option value="0" <?php if ($row_loaida['trangthai']==0) echo "selected" ?>>Đóng</option>
                  <option value="1" <?php if ($row_loaida['trangthai']==1) echo "selected" ?>>Mở</option>
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
          <a href="loaidoan.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Lưu </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
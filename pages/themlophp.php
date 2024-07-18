<?php 
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>
<?php require_once __DIR__. "/../config/db.php"; ?>
<?php 
    $sql_loaida = "SELECT maloai, tenloai FROM loaida ORDER BY tenloai";
    $query_loaida = mysqli_query($connect, $sql_loaida);

    if (isset($_POST['sbm'])) {
        $loai = $_POST['inputLoaida'];
        $hocky = $_POST['inputHocky'];
        $namhoc = $_POST['inputNamhoc'];        
        $tt = $_POST['inputTrangThai'];
        
        $sql = "INSERT INTO lophp(maloaida, hocky, namhoc, trangthai) VALUES ('$loai', '$hocky', '$namhoc', '$tt')";

        $query = mysqli_query($connect, $sql);
        header('location:lophocphan.php');
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
            <h1>Thêm lớp học phần</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm lớp học phần</li>
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
                <label for="inputLoaida">Loại đồ án: </label>
                <select name="inputLoaida" class="form-control custom-select">
                <?php
                    while($row_loaida = mysqli_fetch_assoc($query_loaida)) {
                        ?>
                        <option value="<?php echo $row_loaida['maloai']; ?>"><?php echo $row_loaida['tenloai']; ?></option>
                        <?php
                    }
                ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputHocky">Học kỳ: </label>
                <input type="text" name="inputHocky" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputNamhoc">Năm học: </label>
                <input type="text" name="inputNamhoc" class="form-control">
              </div> 
              <div class="form-group">
                <label for="inputTrangThai">Trạng thái: </label>
                <select name="inputTrangThai" class="form-control custom-select">
                  <option value="0">Kết thúc</option>
                  <option value="1" selected>Đang học</option>
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
          <a href="lophocphan.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Thêm </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
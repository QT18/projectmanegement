<?php require_once __DIR__. "/../config/db.php";
  session_start();
  if(!isset($_SESSION['gv'])) {
    header("location:../index.php");
  }
?>
<?php     

    $sql_loaida = "SELECT maloai,tenloai FROM loaida";
    $query_loaida = mysqli_query($connect, $sql_loaida);

    $sql_gv = "SELECT id,ho,ten FROM giangvien ORDER BY ho, ten";
    $query_gv = mysqli_query($connect, $sql_gv);

    if (isset($_POST['sbm'])) {
        $tendt = $_POST['inputTendt'];
        $mota = $_POST['inputMT'];
        $loaida = $_POST['inputLoaida'];
        $gv = $_POST['inputGV'];
        $sl = $_POST['inputSL'];
        $gc = $_POST['inputGC'];
        $tt = $_POST['inputTrangThai'];
        
        $sql = "INSERT INTO detai(tendt, mota, maloaida, magv, soluong, ghichu, trangthai) VALUES ('$tendt', '$mota', '$loaida', '$gv', '$sl', '$gc', '$tt')";
        $query = mysqli_query($connect, $sql);
        header('location:detai.php');
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
            <h1>Thêm đề tài</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm đề tài</li>
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
                <label for="inputTendt">Tên đề tài:</label>
                <input type="text" name="inputTendt" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputMT">Mô tả: </label>
                <textarea name="inputMT" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="inputLoaida">Loại đồ án: </label>
                <select name="inputLoaida" class="form-control custom-select">
                <?php
                    while ($row_loaida=mysqli_fetch_assoc($query_loaida)) {
                        ?>
                        <option value="<?php echo $row_loaida['maloai'] ?>"><?php echo $row_loaida['tenloai']; ?></option>
                        <?php
                    }
                ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputGV">Giảng viên: </label>
                <?php 
                  if(isset($_SESSION['vaitro'])) {
                    ?>
                    <select name="inputGV" class="form-control custom-select">
                    <?php
                        while ($row_gv=mysqli_fetch_assoc($query_gv)) {
                            ?>
                            <option value="<?php echo $row_gv['id'] ?>"><?php echo $row_gv['ho'].' '.$row_gv['ten']; ?></option>
                            <?php
                        }
                    ?>
                    </select>
                    <?php
                  } else {
                    ?>
                    <input type="text" name="inputGVHoten" class="form-control" value="<?php echo $_SESSION['hoten']; ?>" readonly>
                    <input type="hidden" name="inputGV" class="form-control" value="<?php echo $_SESSION['gv']; ?>">
                    <?php
                  }
                ?>
                
              </div>  
              <div class="form-group">
                <label for="inputSL">Số lượng: </label>
                <input type="number" name="inputSL" class="form-control" min="1">
              </div>
              
              <div class="form-group">
                <label for="inputGC">Ghi chú:</label>
                <input type="text" name="inputGC" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputS">Trạng thái: </label>
                <select name="inputTrangThai" class="form-control custom-select">
                  <option value="0">Đóng</option>
                  <option value="1" selected>Mở</option>
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
          <a href="detai.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Thêm </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
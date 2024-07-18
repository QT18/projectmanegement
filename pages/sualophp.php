<?php 
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>
<?php require_once __DIR__. "/../config/db.php"; ?>
<?php 

    function get_option_loaida($q, $x) {
        $option = '';
        while($row = mysqli_fetch_assoc($q)) {
            $option .= '<option value="'.$row['maloai'].'" ';
            if($row['maloai']==$x) {
                $option .= 'selected ';
            }
            $option .= ' >'.$row['tenloai'].'</option>';            
        }
        return $option;
    }

    if(isset($_GET['id'])) {
        $sql_loaida = "SELECT maloai, tenloai FROM loaida ORDER BY tenloai";
        $query_loaida = mysqli_query($connect, $sql_loaida);

        $mahp = $_GET['id'];
        $sql = "SELECT * FROM lophp WHERE malop='$mahp'";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($query);
    }
    

    if (isset($_POST['sbm'])) {
        $loai = $_POST['inputLoaida'];
        $hocky = $_POST['inputHocky'];
        $namhoc = $_POST['inputNamhoc'];        
        $tt = $_POST['inputTrangThai'];
        $mahp = $_POST['inputMaLHP'];
        
        $sql = "UPDATE lophp SET maloaida='$loai', hocky='$hocky', namhoc='$namhoc', trangthai='$tt' WHERE malop='$mahp'";

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
            <h1>Sửa lớp học phần</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sửa lớp học phần</li>
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
                <input type="hidden" name="inputMaLHP" value="<?php echo $row['malop']; ?>">
                <label for="inputLoaida">Loại đồ án: </label>
                <select name="inputLoaida" class="form-control custom-select">
                <?php
                    echo get_option_loaida($query_loaida, $row['maloaida']);
                ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputHocky">Học kỳ: </label>
                <input type="text" name="inputHocky" class="form-control" value="<?php echo $row['hocky']; ?>">
              </div>
              <div class="form-group">
                <label for="inputNamhoc">Năm học: </label>
                <input type="text" name="inputNamhoc" class="form-control" value="<?php echo $row['namhoc']; ?>">
              </div> 
              <div class="form-group">
                <label for="inputTrangThai">Trạng thái: </label>
                <select name="inputTrangThai" class="form-control custom-select">
                  <option value="0" <?php if($row['trangthai']==0) echo "selected"; ?>>Kết thúc</option>
                  <option value="1" <?php if($row['trangthai']==1) echo "selected"; ?>>Đang học</option>
                </select>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>
      <div class="row">
        <div class="col-2">
          <a href="lophocphan.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Cập nhật </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
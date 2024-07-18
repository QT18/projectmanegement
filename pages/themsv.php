<?php 
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
  require_once __DIR__. "/../config/db.php"; 
  require __DIR__."/../vendor/autoload.php";

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $sql_lop = "SELECT * FROM lopdn ORDER BY MaLop";
    $query_lop = mysqli_query($connect, $sql_lop);

    if (isset($_POST['submit'])) {     
      $malop = $_POST['inputLDN'];
      $file = $_FILES['inputFile']['tmp_name'];
      $extension = pathinfo($_FILES['inputFile']['name'],PATHINFO_EXTENSION);
      
      if ($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') {
        $obj = PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $data = $obj->getActiveSheet()->toArray();
        $password = md5("123");
        foreach($data as $row) {           
          $mssv = $row['0'];                     
          $ho = $row['1'];
          $ten = $row['2'];
          $email = $row['3'];
          $sql_sv = "INSERT INTO sinhvien(mssv, ho, ten, pwd, email, malop, trangthai) VALUES ('$mssv', '$ho', '$ten', '$password', '$email', '$malop', '1')";
          $query_sv = mysqli_query($connect, $sql_sv);               
        }          
      }         
      header('location:svhp.php');
    } 

    if (isset($_POST['sbm'])) {
        $mssv = $_POST['inputMSSV'];
        $ho = $_POST['inputHo'];
        $ten = $_POST['inputTen'];
        $email = $_POST['inputEmail'];
        $malop = $_POST['inputMaLop'];
        $tt = $_POST['inputTT'];
        
        $password = md5("123");
        $sql = "INSERT INTO sinhvien(mssv, ho, ten, pwd, email, malop, trangthai) VALUES ('$mssv', '$ho', '$ten', '$password', '$email', '$malop', '$tt')";

        $query = mysqli_query($connect, $sql);
        header('location:sinhvien.php');
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
            <li class="breadcrumb-item active">Thêm sinhvien</li>
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
          <div class="card-header"><h3 class="card-title">Thêm từ file</h3></div>          
            <div class="card-body">              
              <div class="form-group">
                <label for="inputLDN">Lớp danh nghĩa: </label>
                <select name="inputLDN" class="form-control custom-select">
                  <?php
                    $query_lopdn = mysqli_query($connect, $sql_lop);
                    while($row_lopdn=mysqli_fetch_assoc($query_lopdn)) {
                      ?>
                      <option value="<?php echo $row_lopdn['MaLop']; ?>"><?php echo $row_lopdn['TenLop']; ?></option> 
                      <?php
                    }
                  ?>                  
                </select>
              </div>
              <div class="form-group">
                <label for="inputFile">File danh sách: </label>
                <input type="file" name="inputFile" class="form-control">
              </div>     
              
              <div class="form-group">
              <button name="submit" class="btn btn-success float-left">Thêm</button> 
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>  
      </div>
      <div class="row">        
        <div class="col-md-12">
          <div class="card card-secondary">   
          <div class="card-header"><h3 class="card-title">Thêm thủ công</h3></div>              
            <div class="card-body">              
              <div class="form-group">
                <label for="inputMSSV">Mã số sinh viên: </label>
                <input type="text" name="inputMSSV" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputHo">Họ sinh viên: </label>
                <input type="text" name="inputHo" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputTen">Tên sinh viên: </label>
                <input type="text" name="inputTen" class="form-control">
              </div>              
              <div class="form-group">
                <label for="inputEmail">Email: </label>
                <input type="text" name="inputEmail" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputMaLop">Lớp: </label>
                <select name="inputMaLop" class="form-control custom-select">
                  <?php
                    while($row_lop = mysqli_fetch_row($query_lop)) {
                        ?>
                    <option value="<?php echo $row_lop[0]; ?>"><?php echo $row_lop[0]; ?></option>
                        <?php
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputTT">Trạng thái: </label>
                <select name="inputTT" class="form-control custom-select">
                  <option value="1" selected>Đang học</option>
                  <option value="2">Tốt nghiệp</option>
                  <option value="0">Thôi học</option>
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
<?php 
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>
<?php
    require_once __DIR__. "/../config/db.php"; 
    require __DIR__."/../vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        
    if (isset($_POST['sbmf'])) {     
        $mahp = $_POST['inputMaLHP'];
        $file = $_FILES['inputFile']['tmp_name'];
        $extension = pathinfo($_FILES['inputFile']['name'],PATHINFO_EXTENSION);
        
        if ($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') {
          $obj = PhpOffice\PhpSpreadsheet\IOFactory::load($file);
          $data = $obj->getActiveSheet()->toArray();
          $result = 0;
          foreach($data as $row) {           
            $mssv = $row['0'];                     
            $sql_svhp = "INSERT INTO svhp(mahp,masv) VALUES ('$mahp','$mssv')";
            try {
              $query_svhp = mysqli_query($connect, $sql_svhp);
            } catch (exception $e) {
              $result += 1;
            }             
          }          
        }
        if (isset($result) && ($result > 0)) {
          header('location:svhp.php?error='.$result);
        } else {
          header('location:svhp.php?mahp='.$mahp);
        }         
        
    }

    $sql_mahp = "SELECT * FROM lophp ";

    if(isset($_GET['mahp'])) {
      $mahp = $_GET['mahp'];
      $sql_mahp .= "WHERE malop='$mahp'";
    }

    $query_mahp = $connect->query($sql_mahp); 
    $data_hp = $query_mahp->fetch_all(MYSQLI_ASSOC);
    $rows_hp = mysqli_num_rows($query_mahp); 

    if (isset($_POST['sbm'])) {
        $mahp = $_POST['inputMaLHP1'];
        $masv = $_POST['inputMSSV'];
        $diem = $_POST['inputDiem'];
        $gc = $_POST['inputGC'];
        
        if(empty($diem)&&empty($gc)) {
          $sql = "INSERT INTO svhp(mahp,masv) VALUES ('$mahp', '$masv')";
        } elseif (empty($diem)) {
          $sql = "INSERT INTO svhp(mahp,masv,ghichu) VALUES ('$mahp', '$masv', '$gc')";
        } else {
          $sql = "INSERT INTO svhp(mahp,masv,diem,ghichu) VALUES ('$mahp', '$masv', '$diem', '$gc')";
        }       

        try {
          $query = mysqli_query($connect, $sql);
          header('location:svhp.php?mahp='.$mahp);
        } catch(exception $e) {
          header('location:svhp.php?error=1');
        }
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
            <h1>Thêm loại đồ án</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm loại đồ án</li>
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
                <label for="inputMaLHP">Mã lớp học phần: </label>
                <select name="inputMaLHP" class="form-control custom-select">
                  <?php
                    for($i = 0; $i < $rows_hp; $i++) {
                      ?>
                      <option value="<?php echo $data_hp[$i]['malop']; ?>"><?php echo $data_hp[$i]['maloaida'].'; Học kỳ '.$data_hp[$i]['hocky'].'; Năm học '.$data_hp[$i]['namhoc']; ?></option> 
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
              <button name="sbmf" class="btn btn-success float-left">Nhập </button> 
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
                <label for="inputMaLHP1">Mã lớp học phần: </label>
                <select name="inputMaLHP1" class="form-control custom-select">
                  <?php
                    for($i = 0; $i < $rows_hp; $i++) {
                      ?>
                      <option value="<?php echo $data_hp[$i]['malop']; ?>"><?php echo $data_hp[$i]['maloaida'].'; Học kỳ '.$data_hp[$i]['hocky'].'; Năm học '.$data_hp[$i]['namhoc']; ?></option> 
                      <?php
                    }
                  ?>                  
                </select>
              </div>
              <div class="form-group">
                <label for="inputMSSV">Mã số sinh viên: </label>
                <input type="text" name="inputMSSV" class="form-control">
              </div>              
              <div class="form-group">
                <label for="inputDiem">Điểm: </label>
                <input type="text" name="inputDiem" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputGC">Ghi chú: </label>
                <input type="text" name="inputGC" class="form-control">
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>
      <div class="row">
        <div class="col-1">
          <a href="loaida.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Thêm </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
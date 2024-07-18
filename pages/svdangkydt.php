<?php 
  session_start();
  if(!isset($_SESSION['sv'])) {
    header("location:../index.php");
  }
  require_once __DIR__. "/../config/db.php";
?>
<?php     
    $madt = $_GET['dt'];
    $masvhp = $_GET['svhp'];
    $mssv = $_SESSION['sv'];

    //lấy số lượng đề tài
    $sql_sl_dt = "SELECT soluong FROM detai WHERE madt='$madt'";
    $query_sl_dt = mysqli_query($connect, $sql_sl_dt);
    $soluong_dt = mysqli_fetch_assoc($query_sl_dt);
    $soluong = $soluong_dt['soluong'];

    //thông tin đề tài
    $sql_dt = "SELECT * FROM detai a, giangvien b WHERE madt='$madt' AND magv=id ";
    $query_dt = mysqli_query($connect, $sql_dt);
    $detai_chitiet = mysqli_fetch_assoc($query_dt);

    //lấy thông tin sinh viên 1
    $sql_sv1 = "SELECT mssv, ho, ten FROM sinhvien WHERE mssv = '$mssv'";
    $query_sv1 = mysqli_query($connect, $sql_sv1);
    $sv1_row = mysqli_fetch_assoc($query_sv1);
    //lấy thông tin các sinh viên có khả năng đăng ký
    $sql_sv = "SELECT mssv, ho, ten FROM sinhvien WHERE mssv IN (SELECT masv FROM svhp WHERE mahp = (SELECT mahp FROM svhp WHERE masvhp = '$masvhp'))";
    $query_sv1 = mysqli_query($connect, $sql_sv);
    $query_sv2 = mysqli_query($connect, $sql_sv);
    //lấy mã học phân
    $sql_mahp = "SELECT mahp FROM svhp WHERE masvhp='$masvhp'";
    $query_mahp = mysqli_query($connect, $sql_mahp);
    $hocphan = mysqli_fetch_assoc($query_mahp); 


    if (isset($_POST['sbm'])) {
        $madetai = $_POST['inputMaDT'];
        $masvhp1 = $_POST['inputMaSVHP'];
        $mahp = $_POST['inputMaHP'];

        $sql_dk = "INSERT INTO dangky(madt,trangthai) VALUES ('$madetai','0')";
        $query_dk = mysqli_query($connect, $sql_dk);

        if($query_dk) {
            $masv1 = $_POST['inputSV1'];
            $last_id = mysqli_insert_id($connect);
            $sql_sv1 = "INSERT INTO nhom(madk, masvhp) VALUES ('$last_id','$masvhp1')";
            mysqli_query($connect, $sql_sv1);

            $masv2 = $_POST['inputSV2'];
            $sql_masvhp2 = "SELECT masvhp FROM svhp WHERE masv='$masv2' AND mahp='$mahp'";
            $query_masvhp2 = mysqli_query($connect, $sql_masvhp2);
            $result = mysqli_fetch_row($query_masvhp2);
            if (($masv2 <> '0') && ($masv2 <> $masv1)) {
                $sql_sv2 = "INSERT INTO nhom(madk, masvhp) VALUES ('$last_id','$result[0]')";
                mysqli_query($connect, $sql_sv2);
            }

            $masv3 = $_POST['inputSV3'];
            if (($masv3 <> '0') && ($masv3 <> $masv1) && ($masv3 <> $masv2)) {
                $sql_masvhp3 = "SELECT masvhp FROM svhp WHERE masv='$masv3' AND mahp='$mahp'";
                $query_masvhp3 = mysqli_query($connect, $sql_masvhp3);
                $result = mysqli_fetch_row($query_masvhp3);
                $sql_sv3 = "INSERT INTO nhom(madk, masvhp) VALUES ('$last_id','$result[0]')";
                mysqli_query($connect, $sql_sv3);
            }
        }
        header('location:svdsdangky.php');
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
            <h1>Đăng ký đề tài</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Đăng ký đề tài</li>
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
             <div class="card-header">
              <h3 class="card-title">Nhóm đăng ký</h3>
            </div>           
            <div class="card-body">              
              <div class="form-group">
                <label for="inputSV1">Sinh viên 1: </label>
                <input type="text" name="inputSV1" class="form-control" value="<?php echo $sv1_row['mssv']; ?>" readonly>
              </div>
              <?php
                if ($soluong > 1) {
                    ?>
                    <div class="form-group">
                    <label for="inputSV2">Sinh viên 2: </label>
                    <select name="inputSV2" class="form-control custom-select">
                    <option value="0">Chọn thành viên</option>
                    <?php 
                        while($row_sv=mysqli_fetch_assoc($query_sv1)) {
                            ?> 
                                <option value="<?php echo $row_sv['mssv']; ?>"><?php echo $row_sv['ho'].' '.$row_sv['ten']; ?></option>
                            <?php
                        }
                    ?>                  
                    </select>
                    </div>
              <?php
                }
              ?>

                <?php
                if ($soluong > 2) {
                    ?>
                    <div class="form-group">
                    <label for="inputSV3">Sinh viên 2: </label>
                    <select name="inputSV3" class="form-control custom-select">
                    <option value="0">Chọn thành viên</option>
                    <?php 
                        while($row_sv=mysqli_fetch_assoc($query_sv2)) {
                            ?> 
                                <option value="<?php echo $row_sv['mssv']; ?>"><?php echo $row_sv['ho'].' '.$row_sv['ten']; ?></option>
                            <?php
                        }
                    ?>                  
                    </select>
                    </div>
              <?php
                }
              ?>                        
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>
                
      <div class="row">
        <div class="col-12">
        <h3 class="text-primary"><i class="fas fa-paint-brush"></i>Đề tài: <?php echo $detai_chitiet['tendt'] ?></h3>
        <p class="text-info">
            Giảng viên hướng dẫn: <?php echo $detai_chitiet['ho'].' '.$detai_chitiet['ten']; ?>
        </p>
        <p class="text-muted">
            Mô tả: <?php echo $detai_chitiet['mota']; ?>
        </p>
        <p class="text-muted">
            Ghi chú: <?php echo $detai_chitiet['ghichu']=="" ? "Không" : $detai_chitiet['ghichu']; ?>
        </p>
        </div>
      </div>
      

      <div class="row">
        <div class="col-2">
          <a href="svdangky.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Đăng ký </button>
          <input type="hidden" name="inputMaHP" value="<?php echo $hocphan['mahp']; ?>"> 
          <input type="hidden" name="inputMaSVHP" value="<?php echo $masvhp; ?>">
          <input type="hidden" name="inputMaDT" value="<?php echo $madt; ?>">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
<?php
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
  require_once __DIR__. "/../config/db.php";
?>
<?php 

    function get_options_detai($x_detai, $loaida, $c) {        
        $option = '';
        $sql = "SELECT * FROM detai WHERE maloaida='$loaida'";
        $query = mysqli_query($c, $sql);
        while($row=mysqli_fetch_assoc($query)) {
            $option .= '<option value="'.$row['madt'].'" ';
            if ($x_detai==$row['madt']) {
                $option .= 'selected ';
            }
            $option .= ' >'.$row['tendt'].'</option>';
        }
        return $option;        
    }
    
    function get_options_sv($x_sv, $x_hp, $c) {
        $option = '';
        $sql = "SELECT a.mssv as mssv, b.masvhp masvhp, ho, ten FROM sinhvien a, svhp b ".
                "WHERE a.mssv = b.masv AND mahp = '$x_hp'";
        $query = mysqli_query($c, $sql);
        while($row=mysqli_fetch_assoc($query)) {
            $option .= '<option value="'.$row['masvhp'].'" ';
            if ($x_sv==$row['mssv']) {
                $option .= 'selected ';
            }
            $option .= ' >'.$row['ho'].' '.$row['ten'].'</option>';
        }
        return $option;   
    }

    function get_field_lophp($x_hp, $c) {
        $sql = "SELECT CONCAT(maloaida, '; HK', hocky, '; Năm học: ', namhoc) as thongtin, maloaida ".
                "FROM lophp WHERE malop='$x_hp'";
        $query = mysqli_query($c, $sql);
        $row = mysqli_fetch_assoc($query);
        return $row;
    }
    
    if (isset($_GET['id'])) {
        $id_dk = $_GET['id'];

        $sql_dk = "SELECT  a.madk as madk, madt, a.trangthai as trangthai, baocao, c.mahp as mahp, c.masv as masv, b.id as manhom ".
              "FROM dangky a, nhom b, svhp c ".
              "WHERE a.madk = b.madk ".
              "AND b.masvhp = c.masvhp ".
              "AND a.madk='$id_dk'";
        $query_dk = mysqli_query($connect, $sql_dk);
        $num_sv = mysqli_num_rows($query_dk);
        $sv_dk = mysqli_fetch_all($query_dk, MYSQLI_ASSOC);

        $sql_dt = "SELECT soluong FROM detai WHERE madt='".$sv_dk[0]['madt']."'";
        $query_dt = mysqli_query($connect, $sql_dt);
        $row_dt = mysqli_fetch_assoc($query_dt);
        $sluong_sv_dt = $row_dt['soluong'];
            
    }

    if (isset($_POST['sbm'])) {
        $madk = $_POST['inputMaDK'];
        $madt = $_POST['inputMaDT'];
        $trangthai = $_POST['inputTT'];
        $slsv_dt = $_POST['inputSLSVDT'];

        $sql = "UPDATE dangky SET madt='$madt', trangthai='$trangthai' WHERE madk='$madk'";
        $query = mysqli_query($connect, $sql);

        $i = 1;
        while($i <= $slsv_dt) { 
            $masvhp = $_POST['inputSV'.$i];           
            if(isset($_POST['inputNhomSV'.$i])) {
                $manhom = $_POST['inputNhomSV'.$i];
                if ($masvhp>-1) {
                    $sql = "UPDATE nhom SET masvhp='$masvhp' WHERE id='$manhom'";
                    $query = mysqli_query($connect, $sql);
                } else {
                    $sql = "DELETE FROM nhom WHERE id='$manhom'";
                    $query = mysqli_query($connect, $sql);
                }                
            } else {
                if ($masvhp>-1) {
                    $sql = "SELECT * FROM nhom WHERE madk='$madk' AND masvhp='$masvhp'";
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        $sql = "INSERT INTO nhom(madk, masvhp) VALUES('$madk','$masvhp')";
                        $query = mysqli_query($connect, $sql);
                    }
                }              
            }
            $i++;
        }        
        header('location:dsdangky.php');
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
            <h1>Cập nhật đăng ký</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Cập nhật đăng ký</li>
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
              <h3 class="card-title">Thông tin đăng ký</h3>
            </div>           
            <div class="card-body">              
              <div class="form-group">
                <input type="hidden" name="inputMaDK" value="<?php echo $sv_dk[0]['madk']; ?>">

                <label for="inputMaHP">Lớp học phần: </label>
                <input type="text" name="inputMaHP" class="form-control" value="<?php echo get_field_lophp($sv_dk[0]['mahp'], $connect)['thongtin']; ?>" readonly>
              </div>
              <div class="form-group">
              <label for="inputMaDT">Đề tài: </label>
              <input type="hidden" name="inputSLSVDT" value="<?php echo $sluong_sv_dt; ?>">
              <select name="inputMaDT" class="form-control custom-select">
                <?php 
                    echo get_options_detai($sv_dk[0]['madt'], get_field_lophp($sv_dk[0]['mahp'], $connect)['maloaida'], $connect);
                ?>
              </select>
                
              </div>              
              <div class="form-group">
                <label for="inputTT">Trạng thái đăng ký: </label>
                <select name="inputTT" class="form-control custom-select">
                  <option value="0" <?php if ($sv_dk[0]['trangthai']==0) echo "selected"; ?>>Đang chờ duyệt</option>
                  <option value="1" <?php if ($sv_dk[0]['trangthai']==1) echo "selected"; ?>>Chấp thuận</option>
                  <option value="2" <?php if ($sv_dk[0]['trangthai']==2) echo "selected"; ?>>Từ chối</option>
                </select>
              </div>
              
              <div class="form-group">
              <label for="inputBC">Báo cáo: </label>
              <?php
                  if($sv_dk[0]['baocao']) {
                    ?>
              <a href="../uploads/<?php echo $sv_dk[0]['baocao']; ?>" download><?php echo $sv_dk[0]['baocao']; ?></a>
              <?php
                  } else {
                    echo "Chưa có báo cáo";
                  }
                ?>
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
            <div class="card-header">
              <h3 class="card-title">Sinh viên đăng ký</h3>
            </div>           
            <div class="card-body">              
            <?php 
                $i = 0;
                
                 while ($i < $sluong_sv_dt) {
                    while($i < $num_sv) {
                    ?>
                        <div class="form-group">
                        <label for="inputSV<?php echo $i+1; ?>">Sinh viên thứ <?php echo $i+1; ?>: </label>
                        <input type="hidden" name="inputNhomSV<?php echo $i+1; ?>" value="<?php echo $sv_dk[$i]['manhom']; ?>">                        
                        <select name="inputSV<?php echo $i+1; ?>" class="form-control custom-select">
                        <option selected="true" value="-1">Chọn sinh viên</option>
                        <?php echo get_options_sv($sv_dk[$i]['masv'], $sv_dk[$i]['mahp'], $connect); ?>
                        </select>
                         </div>
              
                    <?php
                    $i++;
                    }
                    if ($i < $sluong_sv_dt) {
                    ?>
                    <div class="form-group">
                        <label for="inputSV<?php echo $i+1; ?>">Sinh viên thứ <?php echo $i+1; ?>: </label>
                        <select name="inputSV<?php echo $i+1; ?>" class="form-control custom-select">
                        <option selected="true" value="-1">Chọn sinh viên</option>
                        <?php echo get_options_sv(" ", $sv_dk[0]['mahp'], $connect); ?>
                        </select>
                    </div>
                    <?php
                    $i++;
                    }
                 }
            ?>              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>

      <div class="row">
        <div class="col-1">
          <a href="dsdangky.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Lưu </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
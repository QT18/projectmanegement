<?php require_once __DIR__. "/../config/db.php"; ?>
<?php     
    session_start();
    $magv = $_SESSION['gv'];
    $madk = $_GET['madk'];

    $sql = "SELECT c.masvhp as masvhp, tendt, baocao, mssv, ho, ten, diem, d.ghichu as danhgia ".
            "FROM dangky a, detai b, nhom c, svhp d, sinhvien e ".
            "WHERE a.madt = b.madt ".
            "AND a.madk = c.madk ".
            "AND c.masvhp = d.masvhp ".
            "AND d.masv = e.mssv ".
            "AND a.madk = '$madk'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($query);
    if(isset($_POST['sbm'])) {
        if(isset($_POST['inputSV1'])) {
          $masvhp = $_POST['inputMaSVHP1'];
          $diemsv = $_POST['inputSV1'];
          $danhgiasv = $_POST['inputDGSV1'];
          $sql_diem = "UPDATE svhp SET diem='$diemsv', ghichu='$danhgiasv' WHERE masvhp='$masvhp'";
          
          mysqli_query($connect, $sql_diem);
        }
        $i = 2;
        while(true) {
          
          if(isset($_POST['inputSV'.$i])) {
            $masvhp = $_POST['inputMaSVHP'.$i];
            $diemsv = $_POST['inputSV'.$i];
            $danhgiasv = $_POST['inputDGSV'.$i];
            $sql_diem = "UPDATE svhp SET diem='$diemsv', ghichu='$danhgiasv' WHERE masvhp='$masvhp'";
            mysqli_query($connect, $sql_diem);
            $i++;
          } else {
            break;
          }
        }
        header('location:gvdsdangky.php');        
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
            <h1>Thông tin và nhập điểm</h1>
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
            <div class="card-body">              
              <div class="form-group">
                <label for="inputTenDT">Tên đề tài: </label>
                <input type="text" name="inputTenDT" class="form-control" value="<?php echo $row['tendt']; ?>" readonly>
              </div>
              <div class="form-group">
                <label>Báo cáo:</label>
                <?php
                  if($row['baocao']) {
                    ?>
                    <a href="../uploads/<?php echo $row['baocao']; ?>" download><?php echo $row['baocao']; ?></a>
                    <?php
                  } else {
                    echo "Chưa có báo cáo";
                  }
                ?>
              </div>
              <div class="form-group">
                <label for="inputSV1">Điểm của sinh viên: <?php echo $row['mssv'].' - '.$row['ho'].' '.$row['ten']; ?></label>
                <input type="text" name="inputSV1" class="form-control" value="<?php echo $row['diem']; ?>">
                <span class="label label-info">Đánh giá (nếu có):</span>
                <input type="text" name="inputDGSV1" class="form-control" value="<?php echo $row['danhgia']; ?>">
                <input type="hidden" name="inputMaSVHP1" value="<?php echo $row['masvhp']; ?>" >                
              </div>  
              
              <?php 
                $i = 2;
                while($row = mysqli_fetch_assoc($query)) {
                  ?>
                  <div class="form-group">
                  <label for="inputSV<?php echo $i; ?>">Điểm của sinh viên: <?php echo $row['mssv'].' - '.$row['ho'].' '.$row['ten']; ?></label>
                  <input type="text" name="inputSV<?php echo $i; ?>" class="form-control" value="<?php echo $row['diem']; ?>">
                  <span class="label label-info">Đánh giá (nếu có):</span>
                  <input type="text" name="inputDGSV<?php echo $i; ?>" class="form-control" value="<?php echo $row['danhgia']; ?>">
                  <input type="hidden" name="inputMaSVHP<?php echo $i; ?>" value="<?php echo $row['masvhp']; ?>" >
                  </div>
                  <?php
                  $i++;
                }
              ?>           
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
      </div>
      <div class="row">
        <div class="col-2">
          <a href="gvdsdangky.php" class="btn btn-secondary">Hủy</a>
          <button name="sbm" class="btn btn-success float-right">Lưu điểm </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
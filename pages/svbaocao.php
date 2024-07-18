<?php
    require_once __DIR__. "/../config/db.php";    
    
    if (isset($_POST['sbmf'])) {             
        $file = $_FILES['inputFile'];
        if(!empty($file['name'])) {
            $madk = $_POST['inputMaDK'];
            $filename = $file['name'];
            $filename = explode('.', $filename);
            $ext = end($filename);
            $new_file = 'BC_'.$madk.'.'.$ext;

            $upload = move_uploaded_file($file['tmp_name'], '../uploads/'.$new_file);

            $sql = "UPDATE dangky SET baocao='$new_file' WHERE madk='$madk'";
            mysqli_query($connect, $sql);
        }
        
        header('location:svdsdangky.php');
    }

    $madk = $_GET['dk'];
    $sql = "SELECT tendt, mota, baocao FROM dangky a, detai b WHERE a.madt=b.madt AND madk='$madk'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($query);
?>
<?php require_once __DIR__. "/../header.php"; ?>
<?php require_once __DIR__. "/../nav.php"; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nộp báp cáo đồ án</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Nộp báo cáo</li>
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
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i>Đề tài: <?php echo $row['tendt'] ?></h3>        
                <p class="text-muted">
                    Mô tả: <?php echo $row['mota']; ?>
                </p>
                <p class="text-muted">
                    File báo cáo: <?php echo $row['baocao']; ?>
                </p>
                <div class="form-group">
                <label for="inputFile">File báo cáo mới: </label>
                <input type="file" name="inputFile" class="form-control" >
              </div>     
              <input type="hidden" name="inputMaDK" value="<?php echo $madk; ?>">
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>        
    </div>      
      <div class="row">
        <div class="col-2">
          <a href="svdsdangky.php" class="btn btn-secondary">Hủy</a>     
          <button name="sbmf" class="btn btn-success float-right">Nộp báo cáo</button>      
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

<?php require_once __DIR__. "/../footer.php"; ?>
<?php 
  session_start();
  if(!isset($_SESSION['sv'])) {
    header("location:../index.php");
  }
?>

<?php require_once __DIR__. "/../header.php"; ?>
<?php require_once __DIR__. "/../nav.php"; ?>
<?php require_once __DIR__. "/../config/db.php"; ?>
<?php
    $masvhp = $_GET['masvhp']; 
    $mahp = $_GET['hp'];
    $sql_dt = "SELECT madt, tendt, ho, ten, mota, soluong FROM detai a, lophp c, giangvien d WHERE c.maloaida=a.maloaida and a.magv=d.id AND malop='$mahp'";    
    $query = mysqli_query($connect, $sql_dt);
 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách đề tài</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh sách đề tài</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">        
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 15%">
                        Tên đề tài
                      </th>
                      <th style="width: 10%">
                        Giảng viên
                      </th>
                      <th style="width: 20%">
                        Mô tả
                      </th>
                      <th style="width: 5%">
                        Số lượng sinh viên
                      </th>                      
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_assoc($query)) {
                            ?>
                    <tr>                    
                      <td><?php echo $i++; ?></td>
                      <td><a><?php echo $row['tendt']; ?></a></td>
                      <td><a><?php echo $row['ho'].' '.$row['ten']; ?></a></td>
                      <td><a><?php echo $row['mota']; ?></a></td>
                      <td><a><?php echo $row['soluong']; ?></a></td>      
                      <td class="project-actions text-right">   
                      <?php
                        $temp_dt = $row['madt'];
                        $sql_check = "SELECT * FROM dangky a, nhom b WHERE a.madk=b.madk AND masvhp='$masvhp' AND madt='$temp_dt'";
                        $query_check = mysqli_query($connect, $sql_check);
                        if(mysqli_num_rows($query_check) == 0) {
                          ?>
                          <a class="btn btn-info btn-sm" href="svdangkydt.php?dt=<?php echo $row['madt']; ?>&svhp=<?php echo $masvhp; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Đăng ký
                          </a> 
                          <?php
                        }
                      ?>                           
                      </td>
                  </tr>
                            <?php
                        }
                        $connect->close();
                    ?>
                                    
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once __DIR__. "/../footer.php"; ?>

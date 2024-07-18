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
    $mssv = $_SESSION['sv'];

    if(isset($_GET['hdk'])) {
      $mdk = $_GET['hdk'];
      $sql_hdk = "DELETE FROM nhom WHERE madk='$mdk'";
      mysqli_query($connect, $sql_hdk);
      $sql_hdk = "DELETE FROM dangky WHERE madk='$mdk'";
      mysqli_query($connect, $sql_hdk);
    }

    $sql = "SELECT madk, madt, tendt, maloaida, trangthaidk, diem FROM view_sv_dk_dt WHERE masv='$mssv'";
    $query = mysqli_query($connect, $sql);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách đăng ký</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh sách đăng ký</li>
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
                        Mã đăng ký
                      </th>
                      <th style="width: 20%">
                        Tên đề tài
                      </th>
                      <th style="width: 10%">
                        Loại đồ án
                      </th>
                      <th style="width: 5%">
                        Trạng thái
                      </th>    
                      <th style="width: 5%">
                        Điểm
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
                      <td><a><?php echo $row['madk']; ?></a></td>
                      <td><a><?php echo $row['tendt']; ?></a></td>
                      <td><a><?php echo $row['maloaida']; ?></a></td>
                      <td class="project-state">
                            <?php
                                if ($row['trangthaidk'] == 1) {
                                    $class_tt = "badge badge-success";
                                } else if ($row['trangthaidk'] == 0) {
                                    $class_tt = "badge badge-secondary";
                                } else {
                                    $class_tt = "badge badge-danger";
                                }
                            ?>

                          <span class="<?php echo $class_tt; ?>">
                            <?php if ($row['trangthaidk'] == 1) {
                                    echo "Chấp thuận";
                                } elseif ($row['trangthaidk'] == 0) {
                                    echo "Đang chờ duyệt";
                                } else {
                                    echo "Từ chối";
                                }; ?>
                            </span>
                      </td>
                      <td><a><?php echo $row['diem']; ?></a></td>                      
                      <?php 
                        if ($row['trangthaidk'] == 1) {                         
                        ?>
                        <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="svbaocao.php?dk=<?php echo $row['madk']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Nộp báo cáo
                          </a>                          
                      </td>
                        <?php
                        } elseif ($row['trangthaidk'] == 0) {
                            ?>
                            <td>
                            <a class="btn btn-info btn-sm" href="svdsdangky.php?hdk=<?php echo $row['madk']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Rút đăng ký
                            </a> 
                            </td>    
                            <?php
                        } else {
                          ?>
                          <td></td>
                          <?php
                        }
                      ?>                      
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

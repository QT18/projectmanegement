<?php require_once __DIR__. "/../config/db.php";
  session_start();
  if(!isset($_SESSION['gv'])) {
    header("location:../index.php");
  }
?>
<?php require_once __DIR__. "/../config/db.php"; 
    $magv = $_SESSION['gv'];
    $mahp = $_GET['hp'];
    $sql_dk = "SELECT a.madk as madk, tendt, maloaida, GROUP_CONCAT(CONCAT(c.ho,' ',c.ten) SEPARATOR ', ') as svth, a.trangthai as trangthai, e.mahp as mahp ".
              "FROM dangky a, nhom b, sinhvien c, detai d, svhp e ".
              "WHERE a.madk=b.madk ".
              "AND b.masvhp=e.masvhp ".
              "AND e.masv = c.mssv ".
              "AND a.madt=d.madt ".
              "AND d.magv='$magv' ".
              "AND a.trangthai='1' ".
              "AND e.mahp='$mahp'".
              "GROUP BY madk, tendt";
    $query_dk = mysqli_query($connect, $sql_dk);
?>

<?php require_once __DIR__. "/../header.php"; ?>
<?php require_once __DIR__. "/../nav.php"; ?>

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
                        Tên đề tài
                      </th>
                      <th style="width: 20%">
                        Loại đồ án
                      </th>             
                      <th style="width: 20%">
                        Sinh viên đăng ký:
                      </th>                                                        
                      <th style="width: 5%">
                        Tình trạng
                      </th>                      
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_assoc($query_dk)) {
                            ?>
                    <tr>                    
                      <td><?php echo $i++; ?></td>
                      <td><a><?php echo $row['tendt']; ?></a></td>
                      <td><a><?php echo $row['maloaida']; ?></a></td>    
                      <td><a><?php echo $row['svth']; ?></a></td>                
                      <td class="project-state">
                            <?php
                                if ($row['trangthai'] == 1) {
                                    $class_tt = "badge badge-success";
                                } else if ($row['trangthai'] == 0) {
                                    $class_tt = "badge badge-secondary";
                                } else {
                                    $class_tt = "badge badge-danger";
                                }
                            ?>

                          <span class="<?php echo $class_tt; ?>">
                            <?php if ($row['trangthai'] == 1) {
                                    echo "Chấp thuận";
                                } elseif ($row['trangthai'] == 0) {
                                    echo "Đang chờ duyệt";
                                } else {
                                    echo "Từ chối";
                                }; ?>
                            </span>
                      </td>
                      <?php
                        if ($row['trangthai']==0) {
                            ?>
                            <td class="project-actions text-right">                          
                            <a class="btn btn-info btn-sm" href="gvduyetdk.php?madk=<?php echo $row['madk']; ?>&stat=1&hp=<?php echo $row['mahp']; ?>">
                              <i class="fas fa-check">
                              </i>
                              Đồng ý
                          </a>
                          <a class="btn btn-danger btn-sm" href="gvduyetdk.php?madk=<?php echo $row['madk']; ?>&stat=2&<?php echo $row['madk']; ?>">
                              <i class="fas fa-remove">
                              </i>
                              Từ chối
                          </a>                                                      
                            </td>
                            <?php
                        } else {
                            ?>
                            <td class="project-actions text-right">                          
                            <a class="btn btn-info btn-sm" href="gvnhapdiem.php?madk=<?php echo $row['madk']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Xem báo cáo
                            </a>                                                                
                            </td>
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

<?php require_once __DIR__. "/../footer.php"; ?>
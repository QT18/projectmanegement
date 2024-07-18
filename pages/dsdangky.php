<?php 
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>
<?php require_once __DIR__. "/../config/db.php"; ?>
<?php             
    if (isset($_POST['sbm'])) {    


    }
    $sql_dk = "SELECT a.madk madk, GROUP_CONCAT(CONCAT(ho, ' ', ten) SEPARATOR ', ') as svth, tendt, d.maloaida as maloaida, hocky, namhoc, a.trangthai as trangthaidk ".
              "FROM dangky a, nhom b, svhp c, lophp d, detai e, sinhvien f ".
              "WHERE a.madk = b.madk ". 
              "AND b.masvhp = c.masvhp ".
              "AND c.mahp = d.malop ".
              "AND a.madt = e.madt ".
              "AND c.masv = f.mssv ".
              "GROUP BY madk ".
              "ORDER BY namhoc DESC, hocky, tendt";
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
                      <th style="width: 8%">
                        Loại đồ án
                      </th>
                      <th style="width: 5%">
                        Học kỳ
                      </th>                       
                      <th style="width: 5%">
                        Năm học
                      </th>     
                      <th style="width: 15%">
                        Sinh viên đăng ký
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
                      <td><a><?php echo $row['hocky']; ?></a></td>
                      <td><a><?php echo $row['namhoc']; ?></a></td>
                      <td><a><?php echo $row['svth']; ?></a></td>                      
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
                      <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="suadangky.php?id=<?php echo $row['madk']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Sửa
                          </a>
                          <a class="btn btn-danger btn-sm" href="xoadangky.php?id=<?php echo $row['madk']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Xóa
                          </a>
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

<?php require_once __DIR__. "/../footer.php"; ?>
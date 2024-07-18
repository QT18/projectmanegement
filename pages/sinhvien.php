<?php
  session_start();
  if(!isset($_SESSION['vaitro'])) {
    header("location:../index.php");
  }
?>

<?php require_once __DIR__. "/../header.php"; ?>
<?php require_once __DIR__. "/../nav.php"; ?>
<?php require_once __DIR__. "/../config/db.php"; ?>
<?php
    $limit = 25;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT * FROM sinhvien ORDER BY malop, ho, ten LIMIT $limit OFFSET $start";
    $query = mysqli_query($connect, $sql);    

    $query2 = $connect->query("SELECT count(mssv) AS total FROM sinhvien");
    $svCount = $query2->fetch_all(MYSQLI_ASSOC);
    $total = $svCount[0]['total'];
    $pages = ceil($total/$limit);

    $previous = $page - 1;
    $next = $page + 1;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý sinh viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý sinh viên</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Quản lý sinh viên</h3>

          <div class="card-tools">
          <a class="btn btn-primary btn-sm" href="themsv.php">
            <i class="fas fa-plus">
            </i>
            Thêm
            </a>            
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 10%">
                        MSSV
                      </th>
                      <th style="width: 20%">
                        Họ
                      </th>
                      <th style="width: 15%">
                        Tên
                      </th>
                      <th style="width: 10%" class="text-center">
                        Email
                      </th>
                      <th style="width: 8%" class="text-center">
                        Mã lớp
                      </th>
                      <th style="width: 8%" class="text-center">
                        Trạng thái
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                    <?php 
                        $i = $start + 1;
                        while($row = mysqli_fetch_assoc($query)) {
                            ?>
                    <tr>                    
                      <td><?php echo $i++; ?></td>
                      <td><a><?php echo $row['mssv']; ?></a></td>
                      <td><a><?php echo $row['ho']; ?></a></td>
                      <td><a><?php echo $row['ten']; ?></a></td>
                      <td><a><?php echo $row['email']; ?></a></td>
                      <td><a><?php echo $row['malop']; ?></a></td>
                      <td class="project-state">
                            <?php
                                if ($row['trangthai'] == 1) {
                                    $class_tt = "badge badge-success";
                                } else {
                                    $class_tt = "badge badge-danger";
                                }
                            ?>

                          <span class="<?php echo $class_tt; ?>">
                            <?php if ($row['trangthai'] == 1) {
                                    echo "Đang học";
                                } elseif ($row['trangthai'] == 2) {
                                    echo "Tốt nghiệp";
                                } else {
                                    echo "Thôi học";
                                }; ?>
                            </span>
                      </td>
                      <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="suasv.php?id=<?php echo $row['mssv']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Sửa
                          </a>
                          <a class="btn btn-danger btn-sm" href="xoasv.php?id=<?php echo $row['mssv']; ?>">
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
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="sinhvien.php?page=<?php echo $previous==1?1:$previous; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($j = 1; $j <= $pages; $j++) { ?>
          <li class="page-item"><a class="page-link" href="sinhvien.php?page=<?php echo $j; ?>"><?php echo $j; ?></a></li>
        <?php  } ?>
        <li class="page-item">
          <a class="page-link" href="sinhvien.php?page=<?php echo $next==$pages?$pages:$next; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once __DIR__. "/../footer.php"; ?>

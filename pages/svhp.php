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
    $sql = "SELECT masvhp, mahp, masv, ho, ten, diem, a.ghichu AS ghichu, hocky, namhoc ".
          "FROM svhp a LEFT JOIN sinhvien b ON masv=mssv LEFT JOIN lophp d ON mahp=d.malop ";
    if (isset($_GET['mahp'])) {
      $mahp = $_GET['mahp'];
      $sql .= "WHERE mahp='$mahp' ";      
    }
    $sql .= "ORDER BY namhoc DESC, hocky, ho, ten ".
            "LIMIT $limit OFFSET $start";
    $query = mysqli_query($connect, $sql);

    $sql2 = "SELECT COUNT(masvhp) AS total FROM svhp ";
    if (isset($_GET['mahp'])) {
      $mahp = $_GET['mahp'];
      $sql2 .= "WHERE mahp='$mahp' ";      
    }
    $query2 = $connect->query($sql2);
    $svhpCount = $query2->fetch_all(MYSQLI_ASSOC);
    $total = $svhpCount[0]['total'];

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
            <h1>Lớp học phần</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý sinh viên của lớp học phần</li>
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
          <h3 class="card-title">Danh sách sinh viên</h3>

          <div class="card-tools">
            <a class="btn btn-primary btn-sm" href="themsvhp.php?<?php if (isset($_GET['mahp'])) echo "mahp=".$_GET['mahp']; ?>">            
            <i class="fas fa-plus">
            </i>
            Thêm
            </a> 
          </div>
        </div>
        <div class="card-body p-0">
          <?php 
            if (isset($_GET['error'])) {
              ?>
              <p class="text-info"><?php echo "Không thể thêm ".$_GET['error']." sinh viên"; ?></p>
              <?php
            }
          ?>
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 10%">
                        Mã lớp học phần
                      </th>
                      <th style="width: 10%">
                        Mã sinh viên
                      </th>
                      <th style="width: 15%">
                        Họ tên
                      </th>                      
                      <th style="width: 15%">
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
                      <td><a><?php echo $row['mahp']; ?></a></td>
                      <td><a><?php echo $row['masv']; ?></a></td>
                      <td><a><?php echo $row['ho'].' '.$row['ten']; ?></a></td>                      
                      <td><a><?php echo $row['diem']; ?></a></td>
                      <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="suasvhp.php?id=<?php echo $row['masvhp']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Sửa
                          </a>
                          <a class="btn btn-danger btn-sm" href="xoasvhp.php?id=<?php echo $row['masvhp']; ?>">
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
    <nav aria-label="Navigation">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="svhp.php?<?php if(isset($_GET['mahp'])) echo "mahp=$mahp&"; ?>page=<?php echo $previous==1?1:$previous; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($j = 1; $j <= $pages; $j++) { ?>
          <li class="page-item"><a class="page-link" href="svhp.php?<?php if(isset($_GET['mahp'])) echo "mahp=$mahp&"; ?>page=<?php echo $j; ?>"><?php echo $j; ?></a></li>
        <?php  } ?>
        <li class="page-item">
          <a class="page-link" href="svhp.php?<?php if(isset($_GET['mahp'])) echo "mahp=$mahp&"; ?>page=<?php echo $next==$pages?$pages:$next; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>

  </div>
  <!-- /.content-wrapper -->

  <?php require_once __DIR__. "/../footer.php"; ?>

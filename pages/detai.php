<?php
  session_start();
  if(!isset($_SESSION['gv'])) {
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
    
    $iduser = $_SESSION['gv'];
    $sql = "SELECT madt, tendt, tenloai, ho, ten, soluong, a.trangthai as trangthai, magv ".
            "FROM detai a, loaida b, giangvien c WHERE maloaida=maloai AND magv=id ORDER BY a.maloaida, magv ".
            "LIMIT $limit OFFSET $start";   
    $query = mysqli_query($connect, $sql);

    $query2 = $connect->query("SELECT count(madt) AS total FROM detai a, loaida b, giangvien c WHERE maloaida=maloai AND magv=id");
    $dtCount = $query2->fetch_all(MYSQLI_ASSOC);
    $total = $dtCount[0]['total'];
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
            <h1>Quản lý đề tài</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý đề tài</li>
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
          <h3 class="card-title">Danh sách đề tài</h3>                    
          <div class="card-tools">  
          <a class="btn btn-primary btn-sm" href="themdt.php">
                  <i class="fas fa-plus"></i>Thêm
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
                      <th style="width: 5%">
                         Mã 
                      </th>
                      <th style="width: 15%">
                        Tên đề tài
                      </th>
                      <th style="width: 10%">
                        Loại đồ án
                      </th>
                      <th style="width: 15%">
                        Giảng viên
                      </th>                     
                      <th style="width: 10%">
                        Số lượng sinh viên
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
                        $i = 1;
                        while($row = mysqli_fetch_assoc($query)) {
                            ?>
                    <tr>                    
                      <td><?php echo $i++; ?></td>
                      <td><a><?php echo $row['madt']; ?></a></td>
                      <td><a><?php echo $row['tendt']; ?></a></td>
                      <td><a><?php echo $row['tenloai']; ?></a></td>
                      <td><a><?php echo $row['ho'].' '.$row['ten']; ?></a></td>
                      <td><a><?php echo $row['soluong']; ?></a></td>
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
                                    echo "Mở";
                                } else {
                                    echo "Đóng";
                                }; ?>
                            </span>
                      </td>
                      <td class="project-actions text-right">      
                      <?php  if(isset($_SESSION['vaitro'])||($iduser==$row['magv'])) { ?>
                                                
                          <a class="btn btn-info btn-sm" href="suadt.php?id=<?php echo $row['madt']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Sửa
                          </a>
                          <?php if(isset($_SESSION['vaitro'])) { ?>
                            <a class="btn btn-danger btn-sm" href="xoadt.php?id=<?php echo $row['madt']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Xóa
                          </a>
                          <?php } } ?>
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
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="detai.php?page=<?php echo $previous==1?1:$previous; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($j = 1; $j <= $pages; $j++) { ?>
          <li class="page-item"><a class="page-link" href="detai.php?page=<?php echo $j; ?>"><?php echo $j; ?></a></li>
        <?php  } ?>
        <li class="page-item">
          <a class="page-link" href="detai.php?page=<?php echo $next==$pages?$pages:$next; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- /.content-wrapper -->

  <?php require_once __DIR__. "/../footer.php"; ?>

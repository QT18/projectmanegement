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
    $magv = $_SESSION['gv'];
    $sql = "SELECT DISTINCT mahp, maloaida, hocky, namhoc, trangthaihp FROM view_gvhpdk ORDER BY trangthaihp DESC, namhoc DESC, hocky, maloaida";
    $query = mysqli_query($connect, $sql);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh mục học phần</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh mục học phần</li>
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
                      <th style="width: 20%">
                        Loại đồ án
                      </th>
                      <th style="width: 10%">
                        Học kỳ
                      </th>
                      <th style="width: 15%">
                        Năm học
                      </th>                                            
                      <th style="width: 10%">
                        Trạng thái
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
                      <td><a><?php echo $row['maloaida']; ?></a></td>
                      <td><a><?php echo $row['hocky']; ?></a></td>
                      <td><a><?php echo $row['namhoc']; ?></a></td>     
                      <td class="project-state">
                            <?php
                                if ($row['trangthaihp'] == 1) {
                                    $class_tt = "badge badge-success";
                                } else {
                                    $class_tt = "badge badge-danger";
                                }
                            ?>

                          <span class="<?php echo $class_tt; ?>">
                            <?php if ($row['trangthaihp'] == 1) {
                                    echo "Đang học";
                                } else {
                                    echo "Kết thúc";
                                }; ?>
                            </span>
                      </td>                  
                      <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="gvdsdangkyhp.php?hp=<?php echo $row['mahp']; ?>; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Xem chi tiết
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
  <!-- /.content-wrapper -->

  <?php require_once __DIR__. "/../footer.php"; ?>

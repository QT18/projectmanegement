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
    $sql = "SELECT * FROM lopdn ORDER BY khoa";
    $query = mysqli_query($connect, $sql);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách lớp danh nghĩa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý lớp danh nghĩa</li>
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
          <h3 class="card-title">Quản lý lớp danh nghĩa</h3>

          <div class="card-tools">
          <a class="btn btn-primary btn-sm" href="themlopdn.php">
            <i class="fas fa-plus">
            </i>
            Thêm
            </a>            
          </div>
        </div>
        <div class="card-body p-0">
          <?php 
              if(isset($_GET['msg'])) {
                $message = $_GET['msg'] == 1 ? "Xóa thành công" : "Không thể xóa lớp học phần";
                  ?>
              <p class="text-info">
                  <?php echo $message; ?>
              </p>
          <?php
              }
          ?>
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                        Mã lớp
                      </th>
                      <th style="width: 30%">
                        Tên lớp
                      </th>
                      <th style="width: 15%">
                        Cố vấn học tập
                      </th>
                      <th style="width: 8%" class="text-center">
                          Khóa
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
                      <td><a><?php echo $row['MaLop']; ?></a></td>
                      <td><a><?php echo $row['TenLop']; ?></a></td>
                      <td><a><?php echo $row['CVHT']; ?></a></td>
                      <td><a><?php echo $row['Khoa']; ?></a></td>
                      <td class="project-state">
                            <?php
                                if ($row['TrangThai'] == 0) {
                                    $class_tt = "badge badge-danger";
                                } else {
                                    $class_tt = "badge badge-success";
                                }
                            ?>

                          <span class="<?php echo $class_tt; ?>">
                            <?php if ($row['TrangThai'] == 0) {
                                    echo "Kết thúc";
                                } else {
                                    echo "Đang học";
                                }; ?>
                            </span>
                      </td>
                      <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="sualopdn.php?id=<?php echo $row['MaLop']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Sửa
                          </a>
                          <a class="btn btn-danger btn-sm" href="xoalopdn.php?id=<?php echo $row['MaLop']; ?>">
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
  <!-- /.content-wrapper -->

  <?php require_once __DIR__. "/../footer.php"; ?>

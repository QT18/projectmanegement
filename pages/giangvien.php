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
    $sql = "SELECT * FROM giangvien ORDER BY ho, ten";
    $query = mysqli_query($connect, $sql);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý giảng viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $MYPATH;?>index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý giảng viên</li>
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
          <h3 class="card-title">Danh sách giảng viên</h3>

          <div class="card-tools">
          <a class="btn btn-primary btn-sm" href="themgv.php">
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
                         Mã số
                      </th>
                      <th style="width: 20%">
                        Họ
                      </th>
                      <th style="width: 15%">
                        Tên
                      </th>
                      <th style="width: 15%" class="text-center">
                        Email
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
                      <td><a><?php echo $row['id']; ?></a></td>
                      <td><a><?php echo $row['ho']; ?></a></td>
                      <td><a><?php echo $row['ten']; ?></a></td>
                      <td><a><?php echo $row['email']; ?></a></td>
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
                                    echo "Đang làm việc";
                                } else {
                                    echo "Đã nghỉ";
                                }; ?>
                            </span>
                      </td>
                      <td class="project-actions text-right">                          
                          <a class="btn btn-info btn-sm" href="suagv.php?id=<?php echo $row['id']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Sửa
                          </a>
                          <a class="btn btn-danger btn-sm" href="xoagv.php?id=<?php echo $row['id']; ?>">
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

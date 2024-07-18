<?php require_once __DIR__. "/../config/db.php"; ?>
<?php     
    session_start();
    $mssv = $_SESSION['sv'];
    $sql_dk = "SELECT a.madk as madk, tendt, ho, ten, mota, maloaida, a.trangthai as trangthai FROM dangky a, nhom b, detai c, giangvien d WHERE a.madk=b.madk AND a.madt=c.madt AND c.magv=d.id AND masv='$mssv'";
    $query_dk = mysqli_query($connect, $sql_dk);

    if (isset($_POST['sbm'])) {    

    }
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
                      <th style="width: 10%">
                        Giảng viên
                      </th>
                      <th style="width: 20%">
                        Mô tả
                      </th>                       
                      <th style="width: 5%">
                        Loại đồ án
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
                      <td><a><?php echo $row['ho'].' '.$row['ten']; ?></a></td>
                      <td><a><?php echo $row['mota']; ?></a></td>
                      <td><a><?php echo $row['maloaida']; ?></a></td>                      
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
                          <a class="btn btn-info btn-sm" href="dangkydt.php?dt=<?php echo $row['madk']; ?>&dk=<?php echo $id_dk; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Rút đăng ký
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
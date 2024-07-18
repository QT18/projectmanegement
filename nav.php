<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $MYPATH;?>index.php" class="nav-link">Home</a>
      </li>
      <?php
        if((isset($_SESSION['sv']) || isset($_SESSION['gv']))) {
      ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $MYPATH;?>thoat.php" class="nav-link">Thoát</a>
      </li>
      <?php
        }
      ?>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="<?php echo $MYPATH;?>index.php" class="brand-link">
      <img src="<?php echo $MYPATH;?>dist/img/ctuetlogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IS Project Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!--User -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">        
        <div class="info">
        <?php
          if((isset($_SESSION['sv']) || isset($_SESSION['gv']))) {
        ?>
        <a href="<?php echo $MYPATH;?>index.php" class="d-block"><?php echo $_SESSION['hoten']; ?></a>
        <?php
        }
        ?>
        </div>
      </div>      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->          
          <?php if(isset($_SESSION['vaitro'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/lopdanhnghia.php" class="nav-link">  
            <i class="nav-icon fas fa-school"></i>            
            <p>Quản lý lớp danh nghĩa</p>
            </a>
          </li>
          <?php } ?>

          <?php if(isset($_SESSION['vaitro'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/sinhvien.php" class="nav-link">           
            <i class="nav-icon fas fa-user"></i>     
              <p>Quản lý sinh viên                </p>
            </a>
          </li>
          <?php } ?>
          <?php if(isset($_SESSION['vaitro'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/giangvien.php" class="nav-link">
            <i class="nav-icon fas fa-user-tie"></i>           
              <p>Quản lý giảng viên</p>
            </a>
          </li>
          <?php } ?>
          <?php if(isset($_SESSION['vaitro'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/loaidoan.php" class="nav-link">    
            <i class="nav-icon fas fa-folder"></i>          
              <p>Quản lý loại đồ án</p>
            </a>
          </li>
          <?php } ?>
          <?php if(isset($_SESSION['vaitro'])) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link">            
            <i class="nav-icon fas fa-file-contract"></i>    
              <p>Quản lý lớp học phần</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $MYPATH;?>pages/lophocphan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách lớp học phần</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $MYPATH;?>pages/svhp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách sinh viên</p>
                </a>
              </li>                        
            </ul>            
          </li>
          <?php } ?>
          <?php if(isset($_SESSION['gv'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/detai.php" class="nav-link">            
            <i class="nav-icon fas fa-file-contract"></i>    
              <p>Quản lý đề tài</p>
            </a>            
          </li>
          <?php } ?>
          <?php if(isset($_SESSION['vaitro'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/dsdangky.php" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>Quản lý đăng ký</p>
            </a>            
          </li>
          <?php } ?>
          <?php if (isset($_SESSION['sv'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/svdangky.php" class="nav-link">
            <i class="nav-icon fas fa-pen"></i>
              <p>Đăng ký đề tài</p>
            </a>
          </li>  
          <?php } ?>   
          <?php if(isset($_SESSION['gv'])) { ?>
          <li class="nav-item">
          <a href="<?php echo $MYPATH;?>pages/gvdsdangky.php" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>Danh sách đăng ký</p>
          </a>
          </li>
          <li class="nav-item">
          <a href="<?php echo $MYPATH;?>pages/gvduyetdk.php" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>Duyệt đăng ký</p>
          </a>
          </li>   
          <?php } elseif (isset($_SESSION['sv'])) { ?>
          <li class="nav-item">
            <a href="<?php echo $MYPATH;?>pages/svdsdangky.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Danh sách đăng ký</p>
            </a>
          </li>  
          <?php } ?>                             
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
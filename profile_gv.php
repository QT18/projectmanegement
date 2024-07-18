<div class="row">      
    <div class="col-md-2"> 
    </div>
    <div class="col-md-8">    
    <form method="POST" enctype="multipart/form-data">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"><?php echo $row['ho'].' '.$row['ten']; ?></h3>                            
            </div>
            <div class="card-body">                
                <div class="form-group">
                <?php 
                    if(isset($message)) {
                        ?>
                    <p class="text-info">
                        <?php echo $message; ?>
                    </p>
                <?php
                    }
                ?>                
                <input type="hidden" name="" class="form-control" value="<?php echo $row['id']; ?>">                
                </div>
                <div class="form-group">
                <label for="inputHo">Họ: </label>
                <input type="text" name="inputHo" class="form-control" value="<?php echo $row['ho']; ?>" readonly>
                <label for="inputTen">Tên: </label>
                <input type="text" name="inputTen" class="form-control" value="<?php echo $row['ten']; ?>" readonly>
                </div>
                    
                <div class="form-group">
                <label for="inputUsername">Tài khoản: </label>
                <input type="username" name="inputUsername" class="form-control" value="<?php echo $row['username']; ?>" readonly>                
                </div>

                <div class="form-group">
                <label for="inputMatkhau">Mật khẩu: </label>
                <input type="password" name="inputPassword" class="form-control">                
                </div>

                <div class="form-group">
                <label for="inputEmail">Email: </label>
                <input type="email" name="inputEmail" class="form-control" value="<?php echo $row['email']; ?>" readonly>
                </div>
                
                <div class="form-group">
                <button type="sumit" name="update" class="btn btn-success float-left">Cập nhật mật khẩu</button>
                </div>
            </div>
            <!-- /.card-body -->              
        </div>
        <!-- /.card -->
        </form>
    </div>
</div>
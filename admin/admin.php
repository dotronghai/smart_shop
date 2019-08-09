<?php include 'header.php'; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lí admin
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <?php
            $erros=[]; 
        if (isset($_POST['name'])) {

          $name = $_POST['name'];
          $sdt = $_POST['sdt'];
          $email = $_POST['email'];
          $pass = $_POST['pass'];
          $level = $_POST['level'];
          $sql_admin = "INSERT INTO tbl_khach_hang(ten_kh, sdt, mail, mat_khau, level) VALUES(?, ?, ?, ?, ?)";
          if ($name=='') {
            $erros['Name']='Bạn chưa nhập tên';
          } if ($sdt=='') {
          $erros['Phone']='Bạn chưa nhập số điện thoại';
          } if ($email=='') {
          $erros['Email']='Bạn chưa mail';
          } if ($pass=='') {
          $erros['Password']='Bạn chưa nhập password';
          } 
        if (!$erros) {
          $check_admin=$conn->prepare($sql_admin);
          $data=[$name,$sdt,$email,$pass,$level];
          if ($check_admin->execute($data)) {
            header('location: admin.php'); // chuyển hướng
          }else{
            echo 'Loi roi';
            $eror = $conn->errorInfo();
            if (isset($eror[2])) {
              echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Admin đã tồn tại
              </div>';
            }
          }
        }
          
        }
       

        ?>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="POST" role="form">
                    <?php if(count($erros) > 0) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php foreach ($erros as $key => $err) {
                                    echo $err.'<br />';
                                    } ?>
                    </div>
                    <?php endif;?>
                        <legend>Form thêm mới</legend>

                        <div class="form-group">
                            <label for="">Tên quản trị</label>
                            <input type="text" class="form-control" name="name" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <input type="number" class="form-control" name="sdt" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="pass" placeholder="Input field">
                        </div>
                        <div class="form-group" style="display :none;">
                            <label for=""></label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="level" value="1"
                                        checked="checked">
                                    Admin
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


                <!-- danh sách danh mục -->
                <div class="col-md-8">
                    <?php 
              $sql = "SELECT * FROM tbl_khach_hang WHERE level = 1";
                $admin = $conn->query($sql)->fetchAll();
               ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>password</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admin as $key =>$ad) : ?>
                            <tr>
                                <td><?php echo $key+1?></td>
                                <td><?php echo $ad->ten_kh ?></td>
                                <td><?php echo $ad->sdt ?></td>
                                <td><?php echo $ad->mail ?></td>
                                <td><?php echo $ad->mat_khau?></td>
                                <td>
                                    <a href="admin-edit.php?admin_id=<?=$ad->id_kh?>" class="btn btn-primary  fa fa-pencil-square-o"></a>
                                    <a href="admin-del.php?admin_id=<?=$ad->id_kh?>" class="btn btn-danger fa fa-trash-o"
                                        onclick="return confirm('Bạn có chắc xóa không?')"></a>
                                </td>
                            </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
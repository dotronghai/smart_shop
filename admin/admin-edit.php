<?php include 'header.php';
$id=$_GET['admin_id'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Sửa tài khoản admin
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <?php 
        $sql="SELECT * FROM tbl_khach_hang WHERE id_kh=$id";
        $admin=$conn->query($sql)->fetch(); 
        if (!empty($_POST['name'])) {

          $name = $_POST['name'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $password=$_POST['password'];
          $sql_them = "UPDATE tbl_khach_hang SET ten_kh=?,sdt=?,mail=?,mat_khau=? WHERE id_kh=? ";
          
            $check_them=$conn->prepare($sql_them);
            $data=[$name,$phone,$email,$password,$id]; 
            if ($check_them->execute($data)) {
              header('location: admin.php'); // chuyển hướng
            }else{
              print_r($conn->errorInfo());
             }
          
          
        }
       

        ?>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="POST" role="form">
                        <legend>Sửa tài khoản admin</legend>

                        <div class="form-group">
                            <label for="">Họ và tên</label>
                            <input type="text" class="form-control" name="name" value="<?=$admin->ten_kh?>"
                                placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="<?=$admin->sdt?>"
                                placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Điạ chỉ email</label>
                            <input type="text" class="form-control" name="email" value="<?=$admin->mail?>"
                                placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="text" class="form-control" name="password" value="<?=$admin->mat_khau?>"
                                placeholder="Input field">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>





                <!-- danh sách danh mục -->
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
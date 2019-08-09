<?php include 'header.php'?>
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Đăng nhập - Đăng ký</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Login Content Area -->

<script>
$(".alert").alert();
</script>
<?php
                $error=[];
                if (isset($_POST['ok'])&& isset($_POST['username'])) {
                   $u=$p="";
                   if($_POST['username'] == NULL){
                       $error['Username']='vui lòng nhập tài khoản';
                   } else{
                       $u=$_POST['username'];
                   }
                   if ($_POST['password'] == NULL) {
                       $error['Password']='vui lòng nhập mật khẩu';
                   } else {
                       $p=$_POST['password'];
                   }
                   if ($u && $p) {
                    //    $sql="SELECT * FROM tbl_khachhang Where level=0 and mail='$u' and mat_khau='$p'";
                       $login=$conn->query('SELECT * FROM tbl_khach_hang Where level=0 and mail=\''.$u.'\' and mat_khau=\''.$p.'\'')->fetch();
                   }
                   if (empty($login)) {
                     $error['check']='Tài khoản or mật khẩu chưa đúng vui lòng xem lại';
                   }
                   else{
                       $_SESSION['user_name']=$login;
                       header('Refresh:0');
                       header('location: index.php');
                   }
                }
            ?>
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <!-- Login Form s-->
                <form action="" method="POST">
                    <?php if(count($error) > 0) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php foreach ($error as $key => $err) {
                     echo $err.'<br />';
                    } ?>
                    </div>
                    <?php endif; ?>
                    <div class="login-form">
                        <h4 class="login-title">Login</h4>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Địa chỉ email*</label>
                                <input class="mb-0" type="email" name="username" placeholder="Email Address">
                            </div>
                            <div class="col-12 mb-20">
                                <label>Mật khẩu</label>
                                <input class="mb-0" type="password" name="password" placeholder="Password">
                            </div>
                            <!-- <div class="col-md-8">
                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                    <input type="checkbox" id="remember_me">
                                    <label for="remember_me">Nhớ tôi</label>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                <a href="#"> Quên mật khẩu?</a>
                            </div> -->
                            <div class="col-md-12">
                                <button class="register-button mt-0" type="submit" name="ok">Đăng nhập</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php 
                  $errors = [];
                  if (isset($_POST['name'])) {
                      $name=$_POST['name'];
                      $phone=$_POST['phone'];
                      $email=$_POST['email'];
                      $address=$_POST['address'];
                      $password=$_POST['password'];
                      $pass_check=$_POST['pass_check'];
                      $data = [];
                      if ($name == '') {
                        $errors['Name'] = 'Vui lòng nhập họ tên';
                      }
                      if ($phone == '') {
                        $errors['Phone'] = 'Vui lòng nhập số điện thoại';
                      } else{
                        if (!is_numeric($phone)) {
                          $errors['Phone'] = 'Số điện thoại phải là số';
                        }
                       }
                    
                      if ($email == '') {
                        $errors['Name'] = 'Vui lòng nhập email';
                      }
                      if ($password == '') {
                        $errors['Password'] = 'Vui lòng nhập mật khẩu';
                      }
                      if ($pass_check == '') {
                        $errors['Pass_check'] = 'Vui lòng nhập xác nhận mật khẩu';
                      }
                      if ($pass_check != $password) {
                        $errors['Pass_check'] = 'Mật khẩu không trung khớp';
                      }
                      if (!$errors) {
                        $sql_them= "INSERT INTO tbl_khach_hang(ten_kh,sdt,mail,dia_chi,mat_khau) VALUES(?,?,?,?,?)";
                        $them=$conn->prepare($sql_them);
                        $data=[$name,$phone,$email,$address,$password];
                        if ($them->execute($data)) {
                            echo '<script>';
                            echo 'window.location.href="login-register.php";';
                            echo 'alert("Đăng kí thành công mời bạn đăng nhâp ");';  
							echo '</script>';
                        } else {
                            $errors['Insert'] = 'Đã tồn tại tài khoản email or số điện thoại ';
                        }
                        
                      }
                      
                  }
            ?>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <?php if(count($errors) > 0) : ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php foreach ($errors as $key => $er) {
                     echo $er.'<br />';
                    } ?>
                </div>
                <?php endif; ?>                
                <form action="" method="POST">
                    <div class="login-form">
                        <h4 class="login-title">Đăng kí</h4>
                        <div class="row">
                            <div class="col-md-12 mb-20">
                                <label>Họ và tên*</label>
                                <input class="mb-0" type="text" name="name" placeholder="họ và tên">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Số điện thoại*</label>
                                <input class="mb-0" type="text" name="phone" placeholder="Số điện thoại">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Địa chỉ email*</label>
                                <input class="mb-0" type="email" name="email" placeholder="địa chỉ email">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Địa chỉ</label>
                                <input class="mb-0" type="text" name="address" placeholder="địa chỉ">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Mật khẩu</label>
                                <input class="mb-0" type="password" name="password" placeholder="mật khẩu">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Xác nhận mật khẩu</label>
                                <input class="mb-0" type="password" name="pass_check" placeholder="xác nhận mật khẩu">
                            </div>
                            <div class="col-12">
                                <button class="register-button mt-0" type="submit">Đăng kí</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->
<?php include 'footer.php'?>
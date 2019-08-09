<?php 
include 'header.php';


 ?>
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Tài khoản người dùng </li>
            </ul>
        </div>
    </div>
</div>
<!--End of Breadcrumb-->
<!--Product Details Area Start-->
<?php
   if( isset($_SESSION['user_name'])){
	  $user=$_SESSION['user_name'];
	  $id=$user->id_kh;
	  $errors=[];
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
                        $sql_them= "UPDATE tbl_khach_hang SET ten_kh=?,sdt=?,mail=?,dia_chi=?,mat_khau=? Where id_kh=$id ";
                        $them=$conn->prepare($sql_them);
						$data=[$name,$phone,$email,$address,$password];
                        if ($them->execute($data)) {
							echo '<script>';
							echo 'alert("sửa thành công mời bạn đăng nhập lại");';  //not showing an alert box.
							echo 'window.location.href="edit_logout.php";';
							echo '</script>';
                        } else {
                            $errors['Insert'] = 'Đã tồn tại tài khoản email or số điện thoại ';
                        }
                        
                      }
	  }
   }
?>
<?php
// echo '<script>';
// echo 'alert("sửa thành công mời bạn đăng nhập lại");';  //not showing an alert box.
// echo 'window.location.href="logout.php";';
// echo '</script>';
?>
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <!-- Login Form s-->
                <form action="" method="POST">
                    <div class="login-form">
                        <h4 class="login-title">Thông tin tài khoản</h4>
                        <div class="row">
                            <div class="col-md-12 mb-20">
                                <label>Họ và tên*</label>
                                <input class="mb-0" type="text" name="name" value="<?=$user->ten_kh?>"
                                    placeholder="họ và tên">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Số điện thoại*</label>
                                <input class="mb-0" type="text" name="phone" value="<?=$user->sdt?>"
                                    placeholder="Số điện thoại">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Địa chỉ email*</label>
                                <input class="mb-0" type="email" name="email" value="<?=$user->mail?>"
                                    placeholder="địa chỉ email">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Địa chỉ</label>
                                <input class="mb-0" type="text" name="address" value="<?=$user->dia_chi?>"
                                    placeholder="địa chỉ">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Mật khẩu</label>
                                <input class="mb-0" type="password" name="password" value="<?=$user->mat_khau?>"
                                    placeholder="mật khẩu">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Xác nhận mật khẩu</label>
                                <input class="mb-0" type="password" name="pass_check" placeholder="xác nhận mật khẩu">
                            </div>
                            <div class="col-12">
                                <button class="register-button mt-0" type="submit">Sửa</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <?php if(isset($_SESSION['user_name'])) : 
    		$cus_login = $_SESSION['user_name'];
    		$cus_id = $cus_login->id_kh;

    		$sql="SELECT o.id_hd,o.ngay_lap,o.tinh_trang,SUM(dt.don_gia*dt.so_luong_mua) total FROM tbl_don_hang o JOIN tbl_ct_dh dt ON o.id_hd = dt.id_hd WHERE o.id_kh = $cus_id GROUP BY o.id_hd";

    		$orders = $conn->query($sql)->fetchAll();
   
    	?>
                <div class="login-form">
                    <h4 class="login-title">Lịch sử đặt hàng</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Thời gian đặt hàng</th>
                                <th>giá trị hàng</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $k => $od) { ?>
                            <tr>
                                <td><?php echo $k+1; ?></td>
                                <td><?php echo $od->ngay_lap ?></td>
                                <td><?php echo number_format($od->total) ?>đ</td>
                                <td>
                                    <?php if($od->tinh_trang == 0) :?>
                                    chờ duyệt
                                    <?php elseif($od->tinh_trang==1): ?>
                                    Đang giao
                                    <?php else: ?>
                                    Hoàn thành
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="my_order.php?id=<?=$od->id_hd;?>" class="btn btn-xs btn-primary">Detail</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Loi roi</strong> Vui long dang nhap
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>
<?php include 'footer.php'; ?>
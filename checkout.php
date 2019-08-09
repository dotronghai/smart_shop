<?php include 'header.php';
?>

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Thanh toán đơn hàng</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Checkout Area Strat-->

<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <form action="" method="POST">
            <?php if(totalQtt() > 0) : ?>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <?php if( isset($_SESSION['user_name'])) : 
                         $user_name=$_SESSION['user_name'];
                         $user_id = $user_name->id_kh;

                         if (isset($_POST['name'])) {
                            $name = $_POST['name'];
                            $email = $_POST['email'];
        
                            // thong tin nguoi nhan
                            $re_name = $_POST['re_name'];
                            $re_email = $_POST['re_email'];
                            $re_phone = $_POST['re_phone'];
                            $re_address = $_POST['re_address'];
                            $re_note = $_POST['re_note'];
        
                            // luu don hang de lay order_id
                            $sql_order = "INSERT INTO tbl_don_hang(id_kh,ten_kh,email_nhan,sdt_nhan,noi_nhan,ghi_chu) VALUES(?,?,?,?,?,?)";
                            $stmod = $conn->prepare($sql_order);
                            
                            $dataOd = [$user_id,$re_name,$re_email,$re_phone,$re_address,$re_note];
                            if ($stmod->execute($dataOd)) {
                                $order_id = $conn->lastInsertId(); // lay ra ID moi nhat
                       
                                foreach($carts as $cart) {
                                    $product_id = $cart['id'];
                                    $quantity = $cart['quantity'];
                                    $price = $cart['price'];
        
                                    $sql_dt = "INSERT INTO tbl_ct_dh(id_hd,id_sp,so_luong_mua,don_gia) VALUES($order_id,$product_id,$quantity,$price)";
        
                                    $conn->query($sql_dt);
                                }
        
                                // $body  ='<table border="1" cellspacing="0" cellpadding="10">
                                //     <tr>
                                //         <td>STT</td>
                                //         <td>Name</td>
                                //         <td>Quantity</td>
                                //         <td>Price</td>
                                //     </tr>';
                                // foreach(cart_items() as $c){
                                //     $body  .='<tr>
                                //         <td>1</td>
                                //         <td>'.$c['name'].'</td>
                                //         <td>'.$c['quantity'].'</td>
                                //         <td>'.$c['price'].'</td>
                                //     </tr>';
                                // }
        
                            //     // $body  .='</table>';
                            //     // // xoas session gio hang
                            //     if ( send_mail($email,$body) ) {
                                    unset($_SESSION['shopping']);
                                    echo '<script>';
                                    echo 'window.location.href="user_cat.php";';
                                    echo 'alert("Đặt hàng thành công mời bạn xem lại đơn hàng");';  //not showing an alert box.
                                    echo '</script>';
                            //     }else{
                            //         echo 'Có lỗi khi gửi mail, vui lòng xem lại lịch sử';
                            //     }
                                
                            }
                            // lu chi tiet down
                        }    
                ?>
                    <form action="" method="">
                        <div class="checkbox-form">
                            <h3>Chi tiết thanh toán</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ và tên của bạn<span class="required">*</span></label>
                                        <input placeholder="Họ & tên" name="name" value="<?=$user_name->ten_kh;?>"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại liên hệ <span class="required">*</span></label>
                                        <input type="text" name="phone" value="<?=$user_name->sdt?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email của bạn<span class="required">*</span></label>
                                        <input type="email" name="email" value="<?=$user_name->mail?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ nhận hàng <span class="required">*</span></label>
                                        <input placeholder="Địa chỉ" type="text" name="address"
                                            value="<?=$user_name->dia_chi?>">
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Ship to a different address?</label>
                                        <input id="ship-box" type="checkbox">
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Họ và tên của bạn<span class="required">*</span></label>
                                            <input placeholder="Họ & tên" name="re_name"
                                                 type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Số điện thoại liên hệ <span class="required">*</span></label>
                                            <input type="text" name="re_phone" ">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Email của bạn<span class="required">*</span></label>
                                            <input type="email" name="re_email"">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Địa chỉ nhận hàng <span class="required">*</span></label>
                                            <input placeholder="Địa chỉ" type="text" name="re_address"
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" name="re_note" cols="30" rows="10"
                                            placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php else : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Quý khách vui lòng đăng nhập để đặt hàng
                    </div>
                    <?php
                $error=[];
                if (isset($_POST['ok']) || isset($_POST['username'])) {
                   $u=$p="";
                   if($_POST['username'] == ''){
                       $error['Username']='vui lòng nhập tài khoản';
                   } else{
                       $u=$_POST['username'];
                   }
                   if ($_POST['password'] == '') {
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
                   }
                }
            ?>
                    <div class=" col-12">
                        <div class="coupon-accordion">
                            <!--Accordion Start-->
                            <h3> <span id="showlogin">Nhấn vào đây để đăng nhập</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text"></p>
                                    <form action="" method="POST">
                                        <?php if(count($error) > 0) : ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <?php foreach ($error as $key => $err) {
                                            echo $err.'<br />';
                                            } ?>
                                        </div>
                                        <?php endif; ?>
                                        <p class="form-row-first">
                                            <label>Nhập tài khoản email<span class="required">*</span></label>
                                            <input class="mb-0" type="email" name="username"
                                                placeholder="Email Address">
                                        </p>
                                        <p class="form-row-last">
                                            <label>Mật khẩu <span class="required">*</span></label>
                                            <input class="mb-0" type="password" name="password" placeholder="Password">
                                        </p>
                                        <p class="form-row">
                                            <input value="Đăng nhập" type="submit" name="ok">
                                            <label>
                                                <input type="checkbox">
                                                Nhớ tôi
                                            </label>
                                        </p>
                                        <p class="lost-password"><a href="#">Quên mật khẩu?</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Đơn hàng của bạn</h3>
                        <form action="">
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="cart-product-total">Giá sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($carts as $cart) :
                                $sub_total = $cart['price'] * $cart['quantity'];
                                ?>
                                        <tr class="cart_item">
                                            <td class="cart-product-name"><?=$cart['name']?><strong
                                                    class="product-quantity">
                                                    ×<?=$cart['quantity']?></strong></td>
                                            <td class="cart-product-total"><span
                                                    class="amount"><?=number_format($cart['price'])?>.đ</span></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>Tổng đơn hàng</th>
                                            <td><strong><span
                                                        class="amount"><?php echo number_format(totalPrice()) ?>.đ</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                        <div class="order-button-payment">
                            <input value="Đặt hàng" type="submit">
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Chưa có hàng</strong>/ vui lòng thêm sản phẩm vào giỏ hàng
        </div>
        <?php endif; ?>
        </form>
        
    </div>
</div>
<!--Checkout Area End-->
<?php include 'footer.php'?>
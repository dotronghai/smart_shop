<?php 
ob_start();
session_start();
include 'config/connect.php';
include 'function/function.php';
$carts=cart_items();
// $wish=wish_list();
$acc=isset($_SESSION['user_name']) ? $_SESSION['user_name'] :0;
?>

<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home Version One || limupa - Digital Products Store eCommerce Bootstrap 4 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="css/fontawesome-stars.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="css/meanmenu.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="css/venobox.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="css/helper.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Modernizr js -->
    <link href="https://fonts.googleapis.com/css?family=Baloo&display=swap" rel="stylesheet">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left">
                                <ul class="phone-wrap">
                                    <li><span>Liên hệ:</span><a href="#">(+84) 098496080</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-9 col-md-8">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <!-- <li>
                                        <div class=""><span><a href="compare.php">So sánh sản phẩm</a></span></div>
                                    </li> -->
                                    <!-- <li>
                                        <div class=""><span><a href="about-us.php">Giới thiệu</a></span></div>
                                    </li> -->
                                    <!-- <li>
                                        <div class=""><span><a href="contact.php">Liên hệ </a></span></div>
                                    </li> -->
                                    <li>
                                        <?php if($acc) : ?>
                                        <div class="ht-setting-trigger"><span>HI:<?=$acc->ten_kh?></span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="user_cat.php">Tài khoản</a></li>
                                                <li><a href="shopping-cart.php">giỏ hàng</a></li>
                                                <li><a href="checkout.php">Đơn hàng</a></li>
                                                <li><a href="logout.php">Đăng xuất</a></li>
                                            </ul>
                                        </div>
                                        <?php else: ?>
                                        <div class="ht-setting-trigger"><span>Tài khoản</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="shopping-cart.php">giỏ hàng</a></li>
                                                <li><a href="checkout.php">Đơn hàng</a></li>
                                                <li><a href="login-register.php">Đăng kí</a></li>
                                                <li><a href="login-register.php">Đăng nhập</a></li>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Top Area End Here -->
            <!-- Begin Header Middle Area -->
            <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Logo Area -->
                        <div class="col-lg-3">
                            <div class="logo pb-sm-30 pb-xs-30">
                                <a href="index.php">
                                    <img src="images/menu/logo/1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Header Logo Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <?php
                                $cats = $conn->query("SELECT * FROM tbl_dm_sp")->fetchAll();
                            ?>
                        <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                            <!-- Begin Header Middle Searchbox Area -->
                            <form action="shop-4-column.php" method="GET" class="hm-searchbox">
                                <select class="nice-select ">
                                    <option value="">All</option>
                                </select>
                                <input type="text" name="search" placeholder="Enter your search key ...">
                                <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <!-- Header Middle Searchbox Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="header-middle-right">
                                <ul class="hm-menu">
                                    <!-- Begin Header Middle Wishlist Area -->
                                    <!-- <li class="hm-wishlist">
                                        <a href="wishlist.php">
                                            <span class="cart-item-count wishlist-item-count">0</span>
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    </li> -->
                                    <!-- Header Middle Wishlist Area End Here -->
                                    <!-- Begin Header Mini Cart Area -->
                                    <li class="hm-minicart">
                                        <div class="hm-minicart-trigger">
                                            <span class="item-icon"></span>
                                            <span class="item-text">
                                                <?php
                                                 if (COUNT($carts)==0) {
                                                     echo 'Trống';
                                                 } else {
                                                    echo '<span>'. number_format(totalPrice()).'đ</span>';
                                                 }
                                                 
                                                ?>
                                                <span class="cart-item-count"><?=COUNT($carts)?></span>
                                            </span>
                                        </div>
                                        <span></span>
                                        <div class="minicart">
                                            <ul class="minicart-product-list">
                                                <?php foreach($carts as $car) { 
                                                   $sub_total = $car['price'] * $car['quantity']; ?>
                                                <li>
                                                    <a href="single-product.php?id=<?=$car['id']?>"
                                                        class="minicart-product-image">
                                                        <img src="images/<?=$car['image']?>" alt="cart products">
                                                    </a>
                                                    <div class="minicart-product-details">
                                                        <h6>
                                                            <a
                                                                href="single-product.php?id=<?=$car['id']?>"><?=$car['name']?></a>
                                                        </h6>
                                                        <span><?=number_format($car['price'])?>đ</span>
                                                    </div>
                                                    <button class="close" title="Remove">
                                                        <a href="cart-process.php?id=<?=$car['id'];?>&action=del">
                                                            <i class="fa fa-close"></i>
                                                        </a>

                                                    </button>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <p class="minicart-total">Tổng tiền:
                                                <span><?php echo number_format(totalPrice()) ?>.VNĐ</span></p>
                                            <div class="minicart-button">
                                                <a href="shopping-cart.php"
                                                    class="li-button li-button-fullwidth li-button-dark">
                                                    <span>Xem giỏ hàng</span>
                                                </a>
                                            </div>
                                            <div class="minicart-button">
                                                <a href="checkout.php" class="li-button li-button-fullwidth">
                                                    <span>Thanh toán</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Header Mini Cart Area End Here -->
                                </ul>
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Middle Area End Here -->
            <!-- Begin Header Bottom Area -->
            <?php
                  $cats_sql= "SELECT id_dm,ten_danhmuc,parent FROM tbl_dm_sp WHERE parent=0 Order by id_dm ASC ";
                  $cats = $conn->query($cats_sql)->fetchAll();
                  
                ?>
            <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Header Bottom Menu Area -->
                            <div class="hb-menu">
                                <nav>
                                    <ul>
                                        <li class=""><a href="index.php">Trang chủ</a>
                                        </li>
                                        <?php foreach($cats as $cat) {
                                                 $cat_id = $cat->id_dm;
                                                 $cat_con = $conn->query("SELECT id_dm,ten_danhmuc,parent FROM tbl_dm_sp WHERE parent=$cat_id Order by id_dm ASC")->fetchAll();
                                            ?>
                                        <li class="megamenu-holder"><a
                                                href="shop-4-column.php?cat_id=<?=$cat->id_dm;?>"><?=$cat->ten_danhmuc?></a>
                                            <?php if(count($cat_con)) : ?>
                                            <ul class="megamenu hb-megamenu">
                                                <li><a href="shop-4-column.php?cat_id=<?=$cat->id_dm;?>">Hãng sản
                                                        xuất</a>
                                                    <ul>
                                                        <?php foreach($cat_con as $catc) {?>
                                                        <li>
                                                            <a href="shop-4-column.php?cat_id=<?=$catc->id_dm;?>"><?=$catc->ten_danhmuc;?>
                                                            </a>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <?php endif;?>
                                        </li>
                                        <?php }?>
                                        <!-- <li class="dropdown-holder"><a href="blog-3-column.php">tin tức</a></li> -->
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header Bottom Menu Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Bottom Area End Here -->
            <!-- Begin Mobile Menu Area -->
            <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                <div class="container">
                    <div class="row">
                        <div class="mobile-menu">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End Here -->
        </header>
        <!-- Header Area End Here -->
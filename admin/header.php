<?php 
ob_start();
session_start();
include '../config/connect.php';

if (isset($_SESSION['admin_login'])) {
  $admin = $_SESSION['admin_login'];
} else {
  header('location: login.php');
}

?>
<?php include '../function/function.php'?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Blank Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/font-awesome.min.css">
  <link rel="stylesheet" href="public/css/AdminLTE.css">
  <link rel="stylesheet" href="public/css/_all-skins.min.css">
  <link rel="stylesheet" href="public/css/style.css" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="../admin/img/favicon.png" alt="" class="img-responsive"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="../admin/img/2.jpg" alt="" class="img-responsive"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <ul class="nav navbar-nav navbar-right" style="margin-right: 10px">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi <?php echo $admin->ten_kh ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Thông tin</a></li>
            <li><a href="logout.php" onclick="return confirm('Bạn có muốn thoát không?')">Thoát tài khoản</a></li>
          </ul>
        </li>
      </ul>

    </nav>
  </header>
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Trang chính</span>
          </a>
        </li>
        <li>
          <a href="admin.php">
            <i class="glyphicon glyphicon-user"></i> <span>Ql. Quản trị</span>
          </a>
        </li>
        <li>
          <a href="order.php">
            <i class="fa fa-shopping-cart"></i> <span>Ql. Đơn hàng</span>
          </a>
        </li>
        <li>
          <a href="customer.php">
            <i class="fa fa-users"></i> <span>Ql. Khách hàng</span>
          </a>
        </li>
        <li>
          <a href="category.php">
            <i class="fa fa-sitemap"></i> <span>Ql. Danh mục</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Ql. Sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="product.php"><i class="fa fa-circle-o"></i> Danh sách</a></li>
            <li><a href="product-add.php"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li> 
        <li>
          <a href="banner.php">
            <i class="fa fa-picture-o"></i> <span>Ql. Banner</span>
          </a>
        </li>
        <!-- <li class="treeview">
           <a href="#">
            <i class="fa fa-list-alt"></i> <span>Ql. Tin tức</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="blog.php"><i class="fa fa-circle-o"></i> Danh sách</a></li>
            <li><a href="blog-add.php"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<?php
  session_start();
  include '../config/connect.php';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Quản trị Admin</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
</head>
<body>
<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		<h1>ADMIN</h1>
	</div>
	<!--//header-->
	<?php 
				if (isset($_POST['email'])) {
					$email = $_POST['email'];
					$password = $_POST['password'];
					$sql_check = "SELECT * FROM tbl_khach_hang WHERE level = 1 AND mail = :mail AND mat_khau= :pass";
					$stm = $conn->prepare($sql_check);
					$stm->bindParam('mail',$email);
					$stm->bindParam('pass',$password);
					$stm->execute();
					$ac = $stm->fetch();
					if ($ac) {
						$_SESSION['admin_login'] = $ac;
						header('location: index.php');
					}else{
						echo 'Tài khỏa hoặc mật khẩu không có';
					}
					
					// header('location: index.php');
				}

			 ?>
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>Login Quick</h2>
			</div>
			<form action="#" method="post">
				<div class="pom-agile">
					<input placeholder="E-mail" name="email" class="user" type="email">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<div class="pom-agile">
					<input  placeholder="Password" name="password" class="pass" type="password">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<div class="sub-w3l">
					<h6><a href="#">Forgot Password?</a></h6>
					<div class="right-w3l">
						<input type="submit" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
	<!--footer-->
	<div class="footer">
	</div>
	<!--//footer-->
</div>
</body>
</html>
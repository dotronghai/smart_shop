<?php 
session_start();
include 'config/connect.php';
$id = !empty($_GET['id']) ? $_GET['id'] : 0;
$action = !empty($_GET['action']) ? $_GET['action'] : 'add';
$sql = "SELECT * FROM tbl_san_pham WHERE id_sp = :id";
$stm = $conn->prepare($sql);
$stm->bindParam(':id',$id);
$stm->execute();
$pro=$stm->fetch();

if ($action == 'add' && $pro) {

	$wishlist = [
			'id' => $id,
			'name' => $pro->ten_sp,
			'image' => $pro->anh_sp,
			'price' => ($pro->gia_km > 0) ? $pro->gia_km : $pro->gia_sp,
		
    ];
    
		$_SESSION['wishlist'][$id] = $wishlist;

	

}

//hành động xóa sản phảm khỏi giỏ hàng
if ($action == 'del') {
			if (isset($_SESSION['wishlist'][$id])) {
				unset($_SESSION['wishlist'][$id]);
			}
		
	
}


header('location:wishlist.php');
?>


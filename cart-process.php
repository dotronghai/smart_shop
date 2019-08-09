<?php 
session_start();
include 'config/connect.php';
$cart_id= isset($_GET['cart_id']) ? $_GET['cart_id']:[];
$id = !empty($_GET['id']) ? $_GET['id'] : 0;
$quantity = !empty($_POST['quantity']) ? $_POST['quantity'] : 1;
$action = !empty($_GET['action']) ? $_GET['action'] : 'add';

$sql = "SELECT * FROM tbl_san_pham WHERE id_sp = :id";
$stm = $conn->prepare($sql);
$stm->bindParam(':id',$id);
$stm->execute();
$pro=$stm->fetch();

if ($action == 'add' && $pro) {
	$cart_item = [
			'id' => $id,
			'name' => $pro->ten_sp,
			'image' => $pro->anh_sp,
			'price' => ($pro->gia_km > 0) ? $pro->gia_km : $pro->gia_sp,
			'quantity' => $quantity
	];

	if (isset($_SESSION['shopping'][$id])) {
		$_SESSION['shopping'][$id]['quantity'] += $quantity;
	}else{
		$_SESSION['shopping'][$id] = $cart_item;
	}

}

// hành động xóa sản phảm khỏi giỏ hàng
if ($action == 'del') {
	if ($cart_id) {
		foreach ($cart_id as $id_1) {
			if (isset($_SESSION['shopping'][$id_1])) {
				unset($_SESSION['shopping'][$id_1]);
			}
		}
	}else{
		if (isset($_SESSION['shopping'][$id])) {
			unset($_SESSION['shopping'][$id]);
		}
	}
}


// cập nhật số lương của sản phảm trong giỏ hàng
if ($action == 'update') {
	// echo '<pre>';
	$id_up = $_GET['id_update'];
	$qtt_up = $_GET['quantity_up'];
	for ($i=0; $i < count($id_up); $i++) { 
		if(isset($_SESSION['shopping'][$id_up[$i]])) {
			$_SESSION['shopping'][$id_up[$i]]['quantity'] = $qtt_up[$i];
		}
	}
}

// xóa trăng giỏ hàng
if ($action == 'clear') {
	if (isset($_SESSION['shopping'])) {
		unset($_SESSION['shopping']); // xóa sản phẩm
	}
}

echo '<pre>';
print_r($_SESSION['shopping']);
header('location: shopping-cart.php');

?>


<?php 
header("Content-Type:application/json");
include '../config/connect.php';
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM tbl_san_pham WHERE id_sp = :id";
$stm = $conn->prepare($sql);
$stm->bindParam(':id',$id);
$stm->execute();
$pro=$stm->fetch();

echo json_encode($pro);
 ?>
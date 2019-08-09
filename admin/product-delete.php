<?php 
include 'header.php'; 
$id = $_GET['id'];
$sql ="DELETE FROM tbl_san_pham WHERE id_sp = $id";

if ($conn->query($sql)) {
  header('location: product.php');
}else{
  print_r( $conn->errorInfo() );
}
?>
  
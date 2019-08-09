<?php 
include 'header.php'; 
$id = $_GET['admin_id'];
$sql ="DELETE FROM tbl_khach_hang WHERE id_kh = $id";

if ($conn->query($sql)) {
  header('location: admin.php');
}else{
  print_r( $conn->errorInfo() );
}
?>
  
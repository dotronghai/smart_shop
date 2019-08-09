<?php 
include 'header.php'; 
$id = $_GET['id'];
$sql ="DELETE FROM tbl_san_pham WHERE id = $id";

if ($conn->query($sql)) {
  header('location: blog.php');
}else{
  print_r( $conn->errorInfo() );
}
?>
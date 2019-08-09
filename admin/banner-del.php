<?php 
include 'header.php'; 
$id = $_GET['id'];
$sql ="DELETE FROM banner WHERE id_banner = $id";

if ($conn->query($sql)) {
  header('location: banner.php');
}else{
  print_r( $conn->errorInfo() );
}
?>
  
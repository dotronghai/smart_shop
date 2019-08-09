<?php 
include 'header.php'; 
$id = $_GET['id'];
$sql ="SELECT * FROM tbl_san_pham WHERE id_sp = $id";

$pro = $conn->query($sql)->fetch();

$img_list = json_decode($pro->anh_list);

?>
<div class="col-md-2">
  <h3>Ảnh sản phẩm</h3>
  <img src="../images/<?php echo $pro->anh_sp;?>" alt="" class="img-respnsove" width="200px">
  <h3>Danh sách ảnh</h3>
  <div class="row">
	<?php foreach($img_list as $img) : ?>
		<div class="col-md-6">
			<div class="thumbnail">
				<img src="../images/<?php echo $img;?>" alt="">
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
<div class="col-md-10">
  <h2>Tên sản phẩm :<?php echo $pro->ten_sp;?></h2>
  <h3>Mô tả sản phẩm</h3>
  <div style="height:550px; overflow:scroll;border:3px solid black;">
      <p>
        <?php echo $pro->mo_ta;?>
      </p>
  </div>
</div> 
<?php include 'footer.php';  ?>
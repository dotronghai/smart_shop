<?php include 'header.php'; ?>

<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if(isset($_POST['status'])){
  $st = $_POST['status'];
  $sql_up = "UPDATE tbl_don_hang SET tinh_trang = $st WHERE id_hd = $id";
  $order_up = $conn->query($sql_up);
  if($order_up){
    header('location: order.php');
  }
}
 ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Chi tiết đơn hàng
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">

        </div>
        <div class="box-body">
            <?php 
              // xứ lý phân trang
              // lấy thông tin sản phẩm trong bảng đơn hàng
              
              $sql1  ="SELECT dt.*,sum(dt.so_luong_mua*dt.don_gia) as tong,sp.* FROM tbl_ct_dh dt JOIN tbl_san_pham sp ON dt.id_sp = sp.id_sp AND dt.id_hd = $id group by dt.so_luong_mua ,dt.don_gia,sp.ten_sp,sp.anh_sp ";

              // lấy ra thông tin khách hàng
              $sql  ="SELECT orders.id_kh,orders.ten_kh,orders.email_nhan, orders.sdt_nhan,orders.noi_nhan,orders.ghi_chu,customer.sdt,customer.mail,customer.dia_chi,customer.ten_kh as cus_name FROM tbl_don_hang orders JOIN tbl_khach_hang customer ON orders.id_kh = customer.id_kh AND orders.id_hd = $id";
                // $sql = "SELECT * FROM orders";
                $order = $conn->query($sql)->fetch();
          
                $order_pr = $conn->query($sql1)->fetchAll();
                
               ?>

            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin khách hàng</h3>
                    </div>
                    <div class="panel-body">
                        <label for="">Tên khách hàng</label>
                        <p><?=$order->cus_name?></p>
                        <label for="">Số điện thoại</label>
                        <p><?=$order->sdt?></p>
                        <label for="">email liên hệ</label>
                        <p><?=$order->mail?></p>
                        <label for="">Địa chỉ</label>
                        <p><?=$order->dia_chi?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin người nhận</h3>
                    </div>
                    <div class="panel-body">
                        <label for="">Tên người nhận</label>
                        <p><?=$order->ten_kh?></p>
                        <label for="">Số điện thoại</label>
                        <p><?=$order->sdt_nhan?></p>
                        <label for="">Địa chỉ email</label>
                        <p><?=$order->email_nhan?></p>
                        <label for="">Địa chỉ người nhận</label>
                        <p><?=$order->noi_nhan?></p>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Giá đơn hàng</h3>
                    </div>
                    <?php foreach($order_pr as $or) : ?>
                    <div class="panel-body" style="overflow=auto">
                       <?=number_format($or->tong)?>.đ
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin dơn hàng</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">

                            <select name="status">
                                <option value="0">Đang chờ</option>
                                <option value="1">Đang giao</option>
                                <option value="2">Hoàn thanh</option>
                            </select>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lưu ý của khách hàng</h3>
                    </div>
                    <div class="panel-body" style="overflow=auto">
                       <?=$order->ghi_chu?>
                    </div>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 0 ?>
                    <?php foreach($order_pr as $stt=>$pro) : ?>
                    <tr>
                        <td><?php echo$stt+1 ?></td>
                        <td><?php echo $pro->ten_sp ?></td>
                        <td><img src="../images/<?php echo $pro->anh_sp?>" width="60px"></td>
                        <td><?php echo $pro->so_luong_mua ?></td>
                        <td><?php echo number_format($pro->don_gia)?>đ</td>
                        <td><?php echo number_format($pro->don_gia * $pro->so_luong_mua) ?>đ</td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
                
            </table>
        </div>
    </div>
    <!-- /.box-body -->

    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
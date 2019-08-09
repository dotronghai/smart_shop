<?php 
include 'header.php';

$id = !empty($_GET['id']) ? $_GET['id'] : 0;

 ?>
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Chi tiết đơn hàng </li>
            </ul>
        </div>
    </div>
</div>
<!--End of Breadcrumb-->
<!--Product Details Area Start-->
<div class="product-deails-area" style="margin-top:10px;">
    <div class="container">
        <?php if(isset($_SESSION['user_name'])) : 
    		$cus_login = $_SESSION['user_name'];
    		$cus_id = $cus_login->id_kh;

            $sql1  ="SELECT orders.id_kh,orders.ten_kh,orders.email_nhan, orders.sdt_nhan,orders.noi_nhan,orders.ghi_chu,customer.sdt,customer.mail,customer.dia_chi,customer.ten_kh as cus_name FROM tbl_don_hang orders JOIN tbl_khach_hang customer ON orders.id_kh = customer.id_kh AND orders.id_hd = $id";
            $order = $conn->query($sql1)->fetch();

    		$sql="SELECT o.*,SUM(dt.don_gia*dt.so_luong_mua) total FROM tbl_don_hang o JOIN tbl_ct_dh dt ON o.id_hd = dt.id_hd WHERE o.id_kh = $cus_id AND o.id_hd = $id";

    		$od = $conn->query($sql)->fetch();
    	?>
        <div class="row">
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
                        <h3 class="panel-title">Thông tin người nhận khác(nếu có)</h3>
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
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin dơn hàng</h3>
                    </div>
                    <div class="panel-body">
                    <label for="">Mã đơn hàng</label>
                        <p><?=$od->id_hd?></p>
                        <label for="">Ngày lập</label>
                        <p><?=$od->ngay_lap?></p>
                        <label for="">giá đơn hàng</label>
                        <p><?=number_format($od->total)?>đ</p>
                        <label for="">Trạng thái</label>
                        <p> <?php if($od->tinh_trang == 0) :?>
                                chờ duyệt
                                <?php elseif($od->tinh_trang==1): ?>
                                Đang giao
                                <?php else: ?>
                                Hoàn thành
                                <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h3>Product in order</h3>
        <?php 
      $sql_dt = "SELECT p.ten_sp,p.anh_sp,dt.don_gia,dt.so_luong_mua, SUM(dt.don_gia*dt.so_luong_mua) subtaotal FROM tbl_ct_dh dt JOIN tbl_san_pham p ON p.id_sp = dt.id_sp WHERE dt.id_hd = $id GROUP BY dt.id_sp";

      $products  = $conn->query($sql_dt)->fetchAll();

       ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá </th>
                    <th>Số lượng</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $k => $pro) { ?>
                <tr>
                    <td><?php echo $k+1; ?></td>
                    <td>
                        <img src="images/<?php echo $pro->anh_sp; ?>" alt="" width="60">
                    </td>
                    <td><?php echo $pro->ten_sp; ?></td>
                    <td><?php echo number_format($pro->don_gia); ?>đ</td>
                    <td><?php echo $pro->so_luong_mua; ?></td>
                    <td><?php echo number_format($pro->subtaotal); ?>đ</td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Loi roi</strong> Vui long dang nhap
        </div>
        <?php endif; ?>
    </div>
</div>

<hr>
<?php include 'footer.php'; ?>
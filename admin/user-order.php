<?php include 'header.php'; 
$id=isset($_GET['id']) ? $_GET['id'] : 0;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý Quản lý đơn hàng
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
              // tính tổng số dòng đang có trong bảng product
              $id=$_GET['id'];
              $sql  ="SELECT o.*,kh.ten_kh cus_name FROM tbl_don_hang o JOIN tbl_khach_hang kh ON o.id_kh=kh.id_kh WHERE o.id_kh='$id'";

                // $sql = "SELECT * FROM orders";
                $order = $conn->query($sql)->fetchAll();
                // echo "<pre>";
                // print_r($order); die();
               ?>
            <table class="table table-hover">
                <thead>
                    <tr> 
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>Người nhận</th>
                        <th>Số điện thoại</th>
                        <th>Đia chỉ email</th>
                        <th>Địa chỉ nhận</th>
                        <th>Ngày lập</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order as $key=>$pro) : ?>
                    <tr>
                        <td><?php echo $key+1?></td>
                        <td><?php echo $pro->cus_name ?></td>
                        <td><?php echo $pro->ten_kh ?></td>
                        <td><?php echo $pro->sdt_nhan?></td>
                        <td><?php echo $pro->email_nhan?></td>
                        <td><?php echo $pro->noi_nhan?></td>
                        <td><?php echo $pro->ngay_lap?></td>
                        <?php if($pro->tinh_trang == 0) :?>
                        <td><span class="bg-success">Chờ duyệt</span></td>
                        <?php elseif($pro->tinh_trang == 1) :?>
                        <td><span class="bg-success">Đang giao</span></td>
                        <?php else: ?>
                        <td><span class="bg-success">Hoàn thành</span></td>
                        <?php endif ?>
                        <td>
                            <a href="order-detial.php?id=<?php echo $pro->id_hd?>" class="btn btn-info fa fa-eye"></a>
                        </td>
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

<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
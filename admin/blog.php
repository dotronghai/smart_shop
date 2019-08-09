<?php include 'header.php'; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý sản phẩm
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <form action="" method="GET" class="form-inline" role="form">
          
            <div class="form-group">
              <input class="form-control" name="search" placeholder="Tìm kiến sản phẩm">
            </div>
            <button type="submit" class="btn btn-primary"> <i class="fa fa-search"> </i> </button>
          </form>
        </div>
        <div class="box-body">
              <?php 
              // xư lí phân trang
              //tính tổng số dòng trong product
              $sql_c = "SELECT COUNT(id_sp) as total FROM tbl_san_pham";
              if(!empty($_GET['search'] )){
                $search = $_GET['search'];
                $sql_c .= " WHERE ten_sp LIKE '%$search%'";
              }
              $tr = $conn->query($sql_c)->fetch();  
              $total = $tr->total;
              // số dòng mỗi trang
              $limit = 7;
              // tính số trang 
              $page = ceil($total/$limit);
              // lấy trang hiện tại theo tham số >p= tren url
              $cr_p = !empty($_GET['p']) ? $_GET['p'] : 1;
              // tìm biến start 
              $start = ($cr_p-1)*$limit;
              

              $sql  ="SELECT id_sp,anh_sp,ten_sp,ten_danhmuc,gia_sp,gia_km,tbl_san_pham.status FROM tbl_san_pham JOIN tbl_dm_sp ON tbl_san_pham.id_dm = tbl_dm_sp.id_dm";
  
                if(!empty($_GET['search'])){
                  $search = $_GET['search'];
                  $sql .= " WHERE ten_sp LIKE '%$search%'";
                }

                $sql .=" Order By id_sp DESC LIMIT $start,$limit";
                $products = $conn->query($sql)->fetchAll();
               ?>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục SP </th>
                    <th>Giá gốc</th>
                    <th>Giá km</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($products as $pro) : ?>
                  <tr>
                     <td><?php echo $pro->id_sp ?></td>
                    <td>
                      <img src="../images/<?php echo $pro->anh_sp ?>" width="60">
                    </td>
                    <td><?php echo $pro->ten_sp ?></td>
                    <td><?php echo $pro->ten_danhmuc ?></td>
                    <td><?php echo number_format($pro->gia_sp) ?>đ</td>
                    <td><?php echo number_format($pro->gia_km) ?>đ</td>
                    <td><?php
                      if ($pro->status==0) {
                        echo 'Ẩn'; 
                      } elseif($pro->status==1) {
                        echo 'Hiển thị';
                      } elseif($pro->status==2) {
                        echo 'Mới nhất';
                      } elseif($pro->status==3) {
                        echo 'Bán chạy';
                      } elseif($pro->status==4) {
                        echo 'Mới nhất & bán chạy';
                      } 
                    ?></td>
                    <td>
                      <a href="product-view.php?id=<?php echo $pro->id_sp ?>" class="btn btn-info fa fa-eye" ></a>
                      <a href="product-edit.php?id=<?php echo $pro->id_sp ?>" class="btn btn-primary fa fa-pencil-square-o" ></a>
                      <a href="product-delete.php?id=<?php echo $pro->id_sp ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Bạn có chắc xóa không?')"></a>
                    </td>
                  </tr>
                  
                  <?php endforeach; ?>

                </tbody>
              </table>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <?php for($i=1;$i<=$page;$i++) : 
              $act = ($i==$cr_p) ? ' class="active"' : '';
            ?>
           <?php if(!empty($_GET['search']) ) {?>
            <li <?php echo $act; ?>><a href="product.php?p=<?=$i;?>&search=<?=$search;?>"><?= $i;?></a></li>
           <?php } else{ ?>
              <li <?php echo $act; ?>><a href="product.php?p=<?=$i;?>"><?= $i;?></a></li>
           <?php } ?>
            <?php endfor; ?>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>

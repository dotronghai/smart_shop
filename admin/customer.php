<?php include 'header.php'; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý khách hàng
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
    
          
        </div>
        <div class="box-body">
          <div class="row">
    


            <!-- danh sách danh mục -->
            <div class="col-md-12">
              <?php 
              $sql = "SELECT * FROM tbl_khach_hang WHERE level = 0";
                $cats = $conn->query($sql)->fetchAll();
               ?>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>đơn hàng</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($cats as $k=>$cat) :?>
                  <tr>
                    <td><?php echo $k+1 ?></td>
                    <td><?php echo $cat->ten_kh ?></td>
                    <td><?php echo $cat->sdt ?></td>
                    <td><?php echo $cat->mail ?></td>
                    <td><?php echo $cat->dia_chi ?></td>
                    <td>
                      <a href="user-order.php?id=<?php echo $cat->id_kh?>" class="btn btn-info fa fa-eye" ></a>
                    </td>
                  </tr>
                  
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
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
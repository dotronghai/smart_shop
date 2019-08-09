 <?php include 'header.php'; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý danh mục sản phẩm
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        <?php 
        if (!empty($_POST['name'])) {

          $name = $_POST['name'];
          $status = $_POST['status'];
          $parent = $_POST['parent'];
          $sql_them = "INSERT INTO tbl_dm_sp(ten_danhmuc, status,parent) VALUES('$name',$status,$parent)";

          $check_them = $conn->query($sql_them);// thực hiện truy vấn
          if ($check_them) {
            header('location: category.php'); // chuyển hướng
          }else{
            echo 'Loi roi';
            $eror = $conn->errorInfo();
            if (isset($eror[2])) {
              echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Danh mục bạn vừa nhập đã tồn tại
              </div>';
            }
          }
        }
       

        ?>
          
        </div>
        <?php 
              $sql = "SELECT * FROM tbl_dm_sp  ";
              $sql_check = "SELECT * FROM tbl_dm_sp WHERE parent=0 ";
                $cats = $conn->query($sql)->fetchAll();
                $cats_check = $conn->query($sql_check)->fetchAll();
               ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              
              <form action="" method="POST" role="form">
                <legend>Form thêm mới</legend>
              
                <div class="form-group">
                  <label for="">Category name</label>
                  <input type="text" class="form-control" name="name" placeholder="Input field">
                </div>
              
                <div class="form-group">
                  <label for="">Trạng thái</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="0" >
                      Ẩn
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="1" checked>
                      Hiển thị
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Chọn danh mục</label>
                    <select class="form-control" name="parent" id="input">
                      <option value="0">Danh mục gốc</option>
                      <?php foreach($cats_check as $c_c) : ?>
                      <option value="<?= $c_c->id_dm?>"><?php echo $c_c->ten_danhmuc?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>





            <!-- danh sách danh mục -->
            <div class="col-md-8">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Danh mục</th>
                    <th>Status</th>
                    <th>Quan hệ</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($cats as $cat) : ?>
                  <tr>
                    <td><?php echo $cat->id_dm ?></td>
                    <td><?php echo $cat->ten_danhmuc ?></td>
                    <td><?php
                       if ($cat->status == 0) {
                         echo 'Ẩn';
                       } else {
                         echo 'Hiển thị';
                       }?>
                    </td>
                    <td><?php
                          if ($cat->parent == 0) {
                            echo 'danh mục gốc' ;
                          } else {
                              $pr = $cat->parent;
                              $pr_name = $conn->query("SELECT * FROM tbl_dm_sp WHERE id_dm ='$pr'")->fetch();
                              echo $pr_name->ten_danhmuc; 
                          }
                          
                        ?>
                    </td>
                    <td>
                      <a href="category-edit.php?id=<?php echo $cat->id_dm ?>" class="btn btn-primary fa fa-pencil-square-o" ></a>
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
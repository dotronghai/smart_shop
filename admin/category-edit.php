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
        $id = $_GET['id'];
        $sql ="SELECT * FROM tbl_dm_sp WHERE id_dm = $id";
        $sqll = "SELECT * FROM tbl_dm_sp WHERE parent=0";
        $cat = $conn->query($sql)->fetch();
        $cats = $conn->query($sqll)->fetchAll();
        if (isset($_POST['name'])) {
          $name = $_POST['name'];
          $status = $_POST['status'];
          $parent = $_POST['parent'];
          $sql ="UPDATE tbl_dm_sp SET ten_danhmuc=?, status=?, parent=? WHERE id_dm = ?";
          $catt = $conn->prepare($sql);
          $data = [$name,$status,$parent,$id];
          if ($catt->execute($data)) {
            header('location: category.php');
          }else{
           print_r($conn->errorInfo());
          }
       }
       

        ?>
          
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              
              <form action="" method="POST" role="form">
                <legend>Form sửa danh mục</legend>
              
                <div class="form-group">
                  <label for="">Category name</label>
                  <input type="text" class="form-control" name="name" placeholder="Input field" value="<?=$cat->ten_danhmuc;?>">
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
                      <?php 
                      foreach($cats as $c) :  ?>
                      <option value="<?= $c->id_dm?>" ><?php echo $c->ten_danhmuc?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>





            <!-- danh sách danh mục -->
            <!-- <div class="col-md-8">
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
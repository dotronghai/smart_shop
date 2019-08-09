<?php include 'header.php'; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý Banner
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
</section>

<!-- Main content -->
<?php
            $image = '';
            $errors = [];
            if (!empty($_FILES['image']['name'])) {
              $_f = $_FILES['image'];
              $f_name = time().$_f['name'];
              move_uploaded_file($_f['tmp_name'], '../images/banner/'.$f_name);
              $image = $f_name;
            }
            if (isset($_POST['name'])) {
              $name=$_POST['name'];
              $link=$_POST['link'];
              $ordering=$_POST['ordering'];
              $status=$_POST['status'];
              if ($name=='') {
                  $errors['Name']='bạn chưa nhập tên banner';
              }
              if ($image=='') {
                $errors['Name']='bạn chưa nhập thêm ảnh';
              }
              if (!$errors) {
                $sql="INSERT INTO banner(name,image,link,ordering,status) VALUES (?,?,?,?,?)";
                $stm=$conn->prepare($sql);
                $data=[$name,$image,$link,$ordering,$status];
                if ($stm->execute($data)) {
                  echo '$image';
                  header('location: banner.php');
                }else{
                  $errors['errors']='có lỗi vui lòng xem lại';
                }
              }
              
            }
    ?>
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <?php if(count($errors) > 0) : ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php foreach ($errors as $key => $er) {
              echo $er.'<br />';
            } ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="POST" role="form" enctype="multipart/form-data">
                        <legend>Form thêm mới</legend>

                        <div class="form-group">
                            <label for="">Tiêu đề banner</label>
                            <input type="text" class="form-control" name="name" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Link dẫn tới sản phẩm</label>
                            <input type="text" class="form-control" name="link" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Vị trí banner</label>
                            <select class="form-control" name="ordering" id="">
                                <option value="0">Banner top left</option>
                                <option value="1">Banner top right</option>
                                <option value="2">Banner between </option>
                                <option value="3">Banner bottom</option>
                                <option value="4">Banner product list</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select class="form-control" name="status" id="">
                                <option value="0">Ẩn</option>
                                <option value="1">hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh banner</label>
                            <input type="file" class="form-control" name="image" id="select_img">
                            <img src="https://rimage.gnst.jp/livejapan.com/public/img/common/noimage.jpg" id="show_img"
                                class="img-responsive" width="300px">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


                <?php 
                      $banner_sql="SELECT * FROM banner order by id_banner DESC";
                      $ban=$conn->query($banner_sql)->fetchAll();
                ?>
                <div class="col-md-8">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên banner</th>
                                <th>Ảnh banner</th>
                                <th>Link dẫn</th>
                                <th>Vị trí banner</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ban as $ba) : ?>
                            <tr>
                                <td><?=$ba->id_banner?></td>
                                <td><?=$ba->name?></td>
                                <td>
                                    <img src="../images/banner/<?php echo $ba->image ?>" width="60">
                                </td>
                                <td><?=$ba->link?></td>
                                <td>
                                    <?php if($ba->ordering==0) : ?>
                                    Banner top left
                                    <?php elseif($ba->ordering==1) : ?>
                                    Banner top right
                                    <?php elseif($ba->ordering==2) : ?>
                                    Banner between
                                    <?php elseif($ba->ordering==3) : ?>
                                    Banner bottom
                                    <?php elseif($ba->ordering==4) : ?>
                                    Banner product list
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if($ba->status==0) : ?>
                                    Ẩn
                                    <?php elseif($ba->status==1) : ?>
                                    Hiển thị
                                    <?php endif;?>
                                <td>
                                    <a href="banner-edit.php?id=<?php echo $ba->id_banner ?>"
                                        class="btn btn-primary fa fa-pencil-square-o"></a>
                                    <a href="banner-del.php?id=<?php echo $ba->id_banner ?>"
                                        class="btn btn-danger fa fa-trash-o"
                                        onclick="return confirm('Bạn có chắc xóa không?')"></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
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
<?php include 'header.php';
$id=$_GET['id'];
$banner=$conn->query("SELECT * FROM banner WHERE id_banner=$id ")->fetch();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý Banner
    </h1>

</section>
<?php
      
       $image = $banner->image;
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
        
        $sql="UPDATE banner SET name=?,image=?,link=?,ordering=?,status=? WHERE id_banner=?";
        $stm=$conn->prepare($sql);
        $data=[$name,$image,$link,$ordering,$status,$id];
        if ($stm->execute($data)) {
          echo '$image';
          header('location: banner.php');
        }else{
          $errors['errors']='có lỗi vui lòng xem lại';
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
                        <legend>Form Sửa banner</legend>

                        <div class="form-group">
                            <label for="">Tiêu đề banner</label>
                            <input type="text" class="form-control" name="name" value="<?=$banner->name?>">
                        </div>
                        <div class="form-group">
                            <label for="">Link dẫn tới sản phẩm</label>
                            <input type="text" class="form-control" name="link" value="<?=$banner->link?>">
                        </div>
                        <div class="form-group">
                            <label for="">Vị trí banner</label>
                            <select class="form-control" name="ordering" id="">
                                <?php if($banner->ordering==0) : ?>
                                <option value="0">Banner top left</option>
                                <?php elseif($banner->ordering==1) : ?>
                                <option value="1">Banner top right</option>
                                <?php elseif($banner->ordering==2) : ?>
                                <option value="2">Banner between</option>
                                <?php elseif($banner->ordering==3) : ?>
                                <option value="3">Banner bottom</option>
                                <?php elseif($banner->ordering==4) : ?>
                                <option value="4">Banner product list</option>
                                <?php endif; ?>
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
                                <?php if($banner->status==0) : ?>
                                <option value="0">Ẩn </option>
                                <?php elseif($banner->status==1) : ?>
                                <option value="1">Hiển thị</option>
                                <?php endif;?>
                                <option value="0">Ẩn</option>
                                <option value="1">hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh banner</label>
                            <input type="file" class="form-control" name="image" id="select_img">
                            <img src="../images/banner/<?=$banner->image;?>" id="show_img"
                                class="img-responsive" width="300px">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
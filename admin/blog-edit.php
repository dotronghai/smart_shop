<?php 
include 'header.php';
$id=isset($_GET['id']) ? $_GET['id'] : 0; 
?>
 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Thêm mới sản phẩm
     </h1>
 </section>

 <!-- Main content -->
 <section class="content">

     <!-- Default box -->
     <div class="box">
         <?php 
         $blog=$conn->query("SELECT * FROM blog WHERE id=$id");
       $image = '';
       $errors = [];
       if (!empty($_FILES['image']['name'])) {
         $_f = $_FILES['image'];
         $f_name = time().$_f['name'];
         move_uploaded_file($_f['tmp_name'], '../images/'.$f_name);
         $image = $f_name;
       }

        
        $img_list = json_encode($mang_img);
        if (isset($_POST['name'])) {
           $name = $_POST['name'];
           $status = $_POST['status'];
           $content = $_POST['content'];
          
           if ($name == '') {
             $errors['Name'] = 'Vui lòng nhập tiêu đề';
           }if ($content='') {
            $errors['Content'] = 'Vui lòng nhập nội dung bài viết';
           }
        
             
           if (!$errors) {
             $sql ="UPDATE blog SET name=?,image=?,content=?,status=? WHERE id=?";
             $stm=$conn->prepare($sql);
             $data = [$name,$image,$content,$status,$id];
             if ($stm->execute($data)) {
               header('location: product.php');
             }else{
               $errors['Insert'] = 'Có lỗi thêm mới vui lòng xem lại';
             }
           }
           
        }
        ?>
         <div class="box-body">
             <?php if(count($errors) > 0) : ?>
             <div class="alert alert-danger">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <?php foreach ($errors as $key => $er) {
              echo $er.'<br />';
            } ?>
             </div>
             <?php endif; ?>
             <form action="" method="POST" enctype="multipart/form-data" >

                 <div class="row">
                     <div class="col-md-9">
                         <div class="form-group <?php echo isset($errors['Name']) ?'has-error' : '' ?>">
                             <label for="">Tiêu đề bài viết</label>
                             <input type="text" class="form-control" name="name" value=<?=$blog->name?>>
                             <?php if( isset($errors['ten_sp']) ) : ?>
                             <small class="help-block">
                                 <?php echo $errors['ten_sp']; ?>
                             </small>
                             <?php endif; ?>
                         </div>
                         <div class="form-group">
                             <label for="">Nội dung sản phẩm</label>
                             <textarea name="content" id="content" class="form-control" value="<?=$blog->content?>" rows="3"></textarea>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label for="">Trạng thái</label>
                             <select class="form-control" name="status">
                                <?php ?>
                                 <option value="0">Ẩn</option>
                                 <option value="1">Hiển thị</option>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="">Ảnh sản phẩm</label>
                             <input type="file" class="form-control" name="image" id="select_img">
                             <img src="https://rimage.gnst.jp/livejapan.com/public/img/common/noimage.jpg" id="show_img"
                                 class="img-responsive">
                         </div>
                     </div>
                 </div>

                 <button type="submit" class="btn btn-primary">Submit</button>
             </form>
         </div>
         <!-- /.box-body -->
     </div>
     <!-- /.box -->

 </section>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 
 <?php include 'footer.php'; ?>
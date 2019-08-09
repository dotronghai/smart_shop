 <?php 
include 'header.php'; 
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
       $image = '';
       $errors = [];
       if (!empty($_FILES['image']['name'])) {
         $_f = $_FILES['image'];
         $f_name = time().$_f['name'];
         move_uploaded_file($_f['tmp_name'], '../images/'.$f_name);
         $image = $f_name;
       }

        //upload nhiều ảnh
        $img_list = '';
        $mang_img = [];
        if (!empty($_FILES['image_khac']['name'][0])) {
          $fss = $_FILES['image_khac'];
          for ($i=0; $i < count($fss['name']) ; $i++) { 
            $fs_name =  time().'-'.$fss['name'][$i];
            move_uploaded_file($fss['tmp_name'][$i], '../images/'.$fs_name);
            $mang_img[] = $fs_name;
          }
        }
        $img_list = json_encode($mang_img);
        if (isset($_POST['name'])) {
           $name = $_POST['name'];
           $price = $_POST['price'];
           $sale_price = !empty($_POST['sale_price']) ? $_POST['sale_price'] : 0;
           $status = $_POST['status'];
           $content = $_POST['content'];
           $chinh_sach = $_POST['chinh_sach'];
           $category_id = $_POST['category_id'];

           if ($name == '') {
             $errors['Name'] = 'Vui lòng nhập tên sản phảm';
           }
           if ($price == '') {
             $errors['Price'] = 'Vui lòng nhập giá sản phảm';
           }else{
            if (!is_numeric($price)) {
              $errors['Price'] = 'Giá sản phẩm phải là số';
            }
           }
           if ($sale_price && !is_numeric($sale_price)) {
             $errors['Sale_price'] = 'Giá khuyến mãi phải là số';
           }
           if ($category_id == '') {
             $errors['Category'] = 'Vui lòng chọn danh mục sản phẩm';
           }
           if (!$errors) {
             $sql ="INSERT INTO tbl_san_pham(ten_sp,gia_sp,gia_km,anh_sp,mo_ta,anh_list,id_dm,status,chinh_sach) VALUES(?,?,?,?,?,?,?,?,?)";
             $stm=$conn->prepare($sql);
             $data = [$name,$price,$sale_price,$image,$content,$img_list,$category_id,$status,$chinh_sach];
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
             <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                 <div class="row">
                     <div class="col-md-9">
                         <div class="form-group <?php echo isset($errors['Name']) ?'has-error' : '' ?>">
                             <label for="">Tên sản phẩm</label>
                             <input type="text" class="form-control" name="name" placeholder="Input field">
                             <?php if( isset($errors['ten_sp']) ) : ?>
                             <small class="help-block">
                                 <?php echo $errors['ten_sp']; ?>
                             </small>
                             <?php endif; ?>
                         </div>
                         <div class="form-group">
                             <label for="">Nội dung sản phẩm</label>
                             <textarea name="content" id="content" class="form-control" rows="3"></textarea>
                         </div>
                         <div class="form-group">
                             <label for="">Mô tả khác</label>
                             <textarea name="chinh_sach" id="content" class="form-control" rows="3"></textarea>
                         </div>
                         <div class="form-group">
                             <label for="">Danh sách ảnh</label>
                             <input type="file" class="form-control" name="image_khac[]" multiple>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <?php 
                      $cats = $conn->query("SELECT * FROM tbl_dm_sp")->fetchAll();
                    ?>
                             <label for="">Danh mục</label>
                             <select name="category_id" id="input" class="form-control">
                                 <option value="">Chọn một</option>
                                 <?php
                      de_quy_cate_select_box($cats,0,"");
                    ?>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="">Giá sản phẩm</label>
                             <input type="number" class="form-control" name="price" id="price" placeholder="Input field">
                         </div>
                         <div class="form-group">
                             <label for="">Giá khuyến mãi</label>
                             <input type="number" class="form-control" name="sale_price" id="sale_price" placeholder="Input field">
                         </div>
                         <div class="form-group">
                             <label for="">Trạng thái</label>
                             <select class="form-control" name="status">
                                 <option value="0">Ẩn</option>
                                 <option value="1">Hiển thị</option>
                                 <option value="2">Mới nhất</option>
                                 <option value="3">Bán chạy</option>
                                 <option value="4">Mới nhất & bán chạy</option>
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
 <script>
function validateForm() {
    // Bước 1: Lấy giá trị của username và password
    var price = document.getElementById('price').value;
    var sale_price = document.getElementById('sale_price').value;

    // Bước 2: Kiểm tra dữ liệu hợp lệ hay không
    if (price <= 0) {
        alert('Giá sản phẩm phải lớn hơn không');
        return false;
    }
    else if (sale_price < 0) {
        alert('Giá khuyến mại phải lớn hơn không');
        return false;
    }
    else if (price <= sale_price) {
        alert('Giá sản phẩm không được nhỏ hơn or bằng giá khuyến mại ');
        return false;
    }else{
    return true;}
}
 </script>
 <?php include 'footer.php'; ?>
<?php include 'header.php'?>
<?php
             $carts=cart_items();
             $id = isset($_GET['id']) ? $_GET['id'] : 0;
             $sql = "SELECT *,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_sp = :id ";
             $stm = $conn->prepare($sql);
             $stm->bindParam(':id',$id);
             $stm->execute();
             $pro=$stm->fetch();
             $image_list = $pro->anh_list ? json_decode($pro->anh_list) : [];

             $qtt  = isset($_SESSION['shopping'][$id]) ? $_SESSION['shopping'][$id]['quantity'] : 0;

?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3">
</script>
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active"><?=$pro->ten_sp?></li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left sp-tab-style-left-page ">
                    <div class="product-details-images slider-navigation-1">
                        <?php foreach($image_list as $img) : ?>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/<?=$img;?>" data-gall="myGallery">
                                <img src="images/<?=$img;?>" alt="product image" class="img-responsive">
                            </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="tab-style-left">
                        <?php foreach($image_list as $img) : ?>
                        <div class="sm-image"><img src="images/<?=$img;?>" style="width:110px;height:98px;"
                                alt="product image thumb" class="img-responsive"></div>
                        <?php endforeach;?>
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2><?=$pro->ten_sp?></h2>
                        <!-- <span class="product-details-ref">Reference: demo_15</span> -->
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                <!-- <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li> -->
                                <!-- <li class="review-item"><a href="#">Read Review</a></li>
                                <li class="review-item"><a href="#">Write Review</a></li> -->
                            </ul>
                        </div>
                        <div class="price-box pt-20">
                            <?php if ($pro->gia_km ==0) {
                                                        echo '<span class="new-price">'.number_format($pro->gia_sp).'đ</span>' ;
                                                    } else {
                                                        echo '<span class="new-price new-price-2">'.number_format($pro->gia_km).'đ</span>' ;
                                                        echo '<br>';
                                                        echo '<span class="old-price"><strike>'.number_format($pro->gia_sp).'đ</strike></span>';
                                                        echo'<br>';
                                                        echo ' <span class="discount-percentage">Giảm '.ceil($pro->sale).'% sản phẩm</span>';
                                                    }
                                                    ?>
                        </div>
                        <div class="product-desc">
                            <p>
                                <span><?=$pro->chinh_sach?>
                                </span>
                            </p>
                        </div>
                        <div class="product-variants">
                            <!-- <div class="produt-variants-size">
                                <label>Bộ nhớ</label>
                                <select class="nice-select">
                                    <option value="1" title="S" selected="selected">40x60cm</option>
                                    <option value="2" title="M">60x90cm</option>
                                    <option value="3" title="L">80x120cm</option>
                                </select>
                            </div> -->
                        </div>
                        <div class="single-add-to-cart">
                            <form action="cart-process.php?id=<?=$pro->id_sp?>" method="POST" onsubmit="return validateForm()" class="cart-quantity">
                                <div class="quantity">
                                    <label>Số lượng</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" id="quantity" name="quantity" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <button class="add-to-cart" type="submit">Add to cart</button>
                            </form>
                        </div>
                        <div class="product-additional-info pt-25">
                            <div class="product-social-sharing pt-25">
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a>
                                    </li>
                                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-reassurance">
                            <ul>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <p>Chính sách bảo mật (chỉnh sửa với mô-đun đảm bảo khách hàng)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <p>Chính sách giao hàng (chỉnh sửa với mô-đun đảm bảo khách hàng)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <p>Chính sách hoàn trả (chỉnh sửa với mô đun đảm bảo khách hàng)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Mô tả</span></a></li>
                        <!-- <li><a data-toggle="tab" href="#product-details"><span>Chi tiết sản phẩm</span></a></li> -->
                        <li><a data-toggle="tab" href="#reviews"><span>Nhận xét</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description entry-content single-post-content">
                    <span style="font-family: 'family"><?=$pro->mo_ta;?></span>
                </div>
            </div>
            <!-- <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <a href="#">
                        <img src="images/product-details/1.jpg" alt="Product Manufacturer Image">
                    </a>
                    <p><span>Reference</span> demo_7</p>
                    <p><span>Reference</span> demo_7</p>
                </div>
            </div> -->
            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">
                        <div class="comment-review">
                            <ul class="rating">
                            </ul>
                        </div>
                        <div class="fb-comments"
                            data-href="localhost/Doan/store_smart/single-product.php?id=<?=$pro->id_sp?>"
                            data-width="1000" data-numposts="100"></div>
                        <!-- Begin Quick View | Modal Area -->
                        <div class="modal fade modal-wrapper" id="mymodal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Write Your Review</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                    <img src="images/product/large-size/3.jpg" alt="Li's Product">
                                                    <div class="li-review-product-desc">
                                                        <p class="li-product-name">Today is a good day Framed poster</p>
                                                        <p>
                                                            <span>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                                Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                                Room With Exquisite Sound via Ring Radiator Technology.
                                                                Stream And Control R3 Speakers Wirelessly With Your
                                                                Smartphone. Sophisticated, Modern Design </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">
                                                            <h3 class="feedback-title">Phản hồi của chúng tôi</h3>
                                                            <form action="#">
                                                                <p class="your-opinion">
                                                                    <label>Đánh giá của bạn</label>
                                                                    <span>
                                                                        <select class="star-rating">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="feedback">Đánh giá của bạn</label>
                                                                    <textarea id="feedback" name="comment" cols="45"
                                                                        rows="8" aria-required="true"></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    <p class="feedback-form-author">
                                                                        <label for="author">Tên<span
                                                                                class="required">*</span>
                                                                        </label>
                                                                        <input id="author" name="author" value=""
                                                                            size="30" aria-required="true" type="text">
                                                                    </p>
                                                                    <p class="feedback-form-author feedback-form-email">
                                                                        <label for="email">Email<span
                                                                                class="required">*</span>
                                                                        </label>
                                                                        <input id="email" name="email" value=""
                                                                            size="30" aria-required="true" type="text">
                                                                        <span class="required"><sub>*</sub> Các trường
                                                                            bắt buộc</span>
                                                                    </p>
                                                                    <div class="feedback-btn pb-15">
                                                                        <a href="#" class="close" data-dismiss="modal"
                                                                            aria-label="Close">Đóng</a>
                                                                        <a href="#">Gửi</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick View | Modal Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<?php
               $id_dm=$pro->id_dm;
               $pro_bottom=$conn->query("SELECT *,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham Where id_dm='$id_dm' Order by id_sp DESC limit 10")->fetchAll();
           ?>
<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Sản phẩm cùng loại</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        <?php foreach($pro_bottom as $p):if ($p->id_sp !=$id) {
                                    ?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image" style="height:210px;overflow:hidden;">
                                    <a href="single-product.php?id=<?=$p->id_sp?>">
                                        <img src="images/<?=$p->anh_sp?>" class="img-responsive"
                                            alt="Li's Product Image">
                                    </a>
                                    <?php if ($p->status == 2) {
                                                    echo '<span class="sticker">New</span>';
                                                }elseif($p->status == 3 ) {
                                                    echo '<span class="sticker" style="background:red;">Hot</span>';
                                                } elseif($p->status == 4 ) {
                                                    echo '<span class="sticker">New</span>';
                                                    echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                                }
                                                ?>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <!-- <a href="product-details.php">Graphic Corner</a> -->
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <!-- <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name"
                                                href="single-product.php?id=<?=$p->id_sp?>"><?=$p->ten_sp?></a></h4>
                                        <div class="price-box">
                                            <?php if ($p->gia_km ==0) {
                                                            echo '<span class="new-price">'.number_format($p->gia_sp).'<small>đ</small></span>' ;
                                                        } else {
                                                            echo '<span class="new-price new-price-2">'.number_format($p->gia_km).'<small>đ</small></span>' ;
                                                            echo '<span class="old-price">'.number_format($p->gia_sp).'<small>đ</small></span>';
                                                            echo ' <span class="discount-percentage">'.ceil($p->sale).'%</span>';
                                                        }
                                                        ?>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a
                                                    href="single-product.php?id=<?=$p->id_sp?>">Add to cart</a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn"
                                                    data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li><a class="links-details" href="wishlist.php"><i
                                                        class="fa fa-heart-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <?php } ?>

                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<script>
function validateForm() {
    // Bước 1: Lấy giá trị của username và password
    var quantity = document.getElementById('quantity').value;

    // Bước 2: Kiểm tra dữ liệu hợp lệ hay không
    if (quantity=='') {
        alert('Số lượng sản phẩm rỗng');
        return false;
    }
    if (quantity <= 0) {
        alert('Số lượng sản phẩm phải lớn hơn không');
        return false;
    }
    return true;
}
</script>

<?php include 'footer.php'?>
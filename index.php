<?php include 'header.php'?>
<?php          
              
               $top_sql = "SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = 1 Or parent = 1) and status !=0 and status !=1 Order by id_sp DESC limit 10";
               $top_product = $conn->query($top_sql)->fetchAll();

               $topleft= $conn->query("SELECT * FROM banner WHERE ordering=0 and status =1 order by id_banner DESC limit 4")->fetchAll();

               $topright= $conn->query("SELECT * FROM banner WHERE ordering=1 and status =1 order by id_banner DESC limit 2")->fetchAll();

               $topbetween= $conn->query("SELECT * FROM banner WHERE ordering=2 and status =1 order by id_banner DESC limit 3")->fetchAll();

               $topbottom= $conn->query("SELECT * FROM banner WHERE ordering=3 and status =1 order by id_banner DESC limit 1 ")->fetchAll();

            ?>
<!-- Begin Slider With Banner Area -->
<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Slider Area -->
            <div class="col-lg-8 col-md-8">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">
                        <!-- Begin Single Slide Area -->
                        <?php foreach($topleft as $tl) :?>
                        <div class="single-slide align-center-left  animation-style-01 bg-1 " style="background-image: url(images/banner/<?=$tl->image;?>);">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <!-- <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                <h2>Diện thoại iphone </h2>
                                <h3>Starting at <span>$1209.00</span></h3> -->
                                <div class="default-btn slide-btn">
                                    <a class="links linkss" href="<?=$tl->link?>">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                       <?php endforeach;?>
                        <!-- Single Slide Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <!-- <div class="li-banner">
                    <a href="#">
                        <img src="images/banner/1_1.jpg" alt="">
                    </a>
                </div> -->
                <?php foreach($topright as $tr) : ?>
                <div class="li-banner">
                    <a href="<?=$tr->link?>">
                        <img src="images/banner/<?=$tr->image?>" width="370px" height="230px" alt="">
                    </a>
                </div>
                <?php endforeach;?>
            </div>
            <!-- Li Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Slider With Banner Area End Here -->
<!-- Begin Product Area -->

<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Điện thoại</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        <?php foreach($top_product as $tp) : ?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image" style="height:250px;overflow:hidden">
                                    <a href="single-product.php?id=<?=$tp->id_sp?>">
                                        <img src="images/<?php echo $tp->anh_sp; ?>"  alt="Li's Product Image"
                                            class="img-responsive">
                                    </a>
                                    <?php if ($tp->status == 2) {
                                                echo '<span class="sticker">New</span>';
                                            } elseif($tp->status == 3 ) {
                                                echo '<span class="sticker" style="background:red">Hot</span>';
                                            } elseif($tp->status == 4 ){
                                                echo '<span class="sticker">New</span>';
                                                echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                            }
                                            ?>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <!-- <a href="shop-left-sidebar.php">Graphic Corner</a> -->
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
                                        <h4><a class="product_name comment"
                                                href="single-product.php?id=<?=$tp->id_sp;?>"><?= $tp->ten_sp;?></a>
                                        </h4>
                                        <div class="price-box">
                                            <?php if ($tp->gia_km ==0) {
                                                        echo '<span class="new-price">'.number_format($tp->gia_sp).'đ</span>' ;
                                                    } else {
                                                        echo '<span class="new-price new-price-2">'.number_format($tp->gia_km).'đ</span>' ;
                                                        echo '<span class="old-price">'.number_format($tp->gia_sp).'đ</span>';
                                                        echo ' <span class="discount-percentage">'.ceil($tp->sale).'%</span>';
                                                    }
                                                    ?>

                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a
                                                    href="cart-process.php?id=<?=$tp->id_sp?>">Add to cart</a></li>
                                            <!-- <li><a class="links-details" href="wishlist.php"><i
                                                        class="fa fa-heart-o"></i></a></li> -->
                                            <!-- <li><a href="#" title="quick view" class="quick-view-btn"
                                                    data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            <?php foreach($topbetween as $tb) : ?>
            <div class="col-lg-4 col-md-4 text-center bannerbetween ">
                <div class="single-banner">
                    <a href="<?=$tb->link?>">
                        <img src="images/banner/<?=$tb->image?>" width="370px" height="227px" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <?php endforeach;?>
            <!-- Single Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<?php
               $lap_sql="SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = 2 Or parent = 2) and status !=0 and status !=1 Order by id_sp DESC limit 10";
               $lap_pro=$conn->query($lap_sql)->fetchAll();
            ?>
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Laptop</span>
                    </h2>
                    <ul class="li-sub-category-list">
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        <?php foreach ($lap_pro as $lap) : ?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image" style="height:250px;overflow:hidden">
                                    <a href="single-product.php?id=<?=$lap->id_sp;?>">
                                        <img src="images/<?=$lap->anh_sp;?>" alt="Li's Product Image" class="img-responsive">
                                    </a>
                                    <?php if ($lap->status == 2) {
                                                echo '<span class="sticker">New</span>';
                                            } elseif($lap->status == 3 ) {
                                                echo '<span class="sticker" style="background:red">Hot</span>';
                                            } elseif($lap->status == 4 ){
                                                echo '<span class="sticker">New</span>';
                                                echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                            }
                                            ?>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <!-- <a href="shop-left-sidebar.php">Graphic Corner</a> -->
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                            </div>
                                        </div>
                                        <h4 ><a class="product_name comment"
                                                href="single-product.php?id=<?=$lap->id_sp;?>"><?=$lap->ten_sp?></a>
                                        </h4>
                                        <div class="price-box">
                                            <?php if ($lap->gia_km ==0) {
                                                        echo '<span class="new-price">'.number_format($lap->gia_sp).'đ</span>' ;
                                                    } else {
                                                        echo '<span class="new-price new-price-2">'.number_format($lap->gia_km).'đ</span>' ;
                                                        echo '<span class="old-price">'.number_format($lap->gia_sp).'đ</span>';
                                                        echo ' <span class="discount-percentage">'.ceil($lap->sale).'%</span>';
                                                    }
                                                    ?>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a
                                                    href="cart-process.php?id=<?=$lap->id_sp;?>">Add to cart</a></li>
                                            <!-- <li><a class="links-details" href="wishlist.php"><i
                                                        class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn"
                                                    data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's TV & Audio Product Area -->
<?php
               $tablet_sql="SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = 3 Or parent = 3) and status !=0 and status !=1 Order by id_sp DESC limit 10";
               $tablet_pro=$conn->query($tablet_sql)->fetchAll();
            ?>
<section class="product-area li-laptop-product li-tv-audio-product pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Tablet</span>
                    </h2>
                    <ul class="li-sub-category-list">
                        <!-- <li class="active"><a href="shop-left-sidebar.php">Chamcham</a></li>
                                    <li><a href="shop-left-sidebar.php">Sanai</a></li>
                                    <li><a href="shop-left-sidebar.php">Meito</a></li> -->
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        <?php foreach($tablet_pro as $tab) : ?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image "style="height:250px;overflow:hidden">
                                    <a href="single-product.php?id=<?=$tab->id_sp;?>">
                                        <img src="images/<?=$tab->anh_sp;?>" alt="Li's Product Image" class="img-responsive">
                                    </a>
                                    <?php if ($tab->status == 2) {
                                                echo '<span class="sticker">New</span>';
                                            } elseif($tab->status == 3 ) {
                                                echo '<span class="sticker" style="background:red">Hot</span>';
                                            } elseif($tab->status == 4 ){
                                                echo '<span class="sticker">New</span>';
                                                echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                            }
                                            ?>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <!-- <a href="shop-left-sidebar.php">Graphic Corner</a> -->
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
                                        <h4><a class="product_name comment"
                                                href="single-product.php?id=<?=$tab->id_sp;?>"><?=$tab->ten_sp;?></a></h4>
                                        <div class="price-box">
                                            <?php if ($tab->gia_km ==0) {
                                                        echo '<span class="new-price">'.number_format($tab->gia_sp).'đ</span>' ;
                                                    } else {
                                                        echo '<span class="new-price new-price-2">'.number_format($tab->gia_km).'đ</span>' ;
                                                        echo '<span class="old-price">'.number_format($tab->gia_sp).'đ</span>';
                                                        echo ' <span class="discount-percentage">'.ceil($tab->sale).'%</span>';
                                                    }
                                                    ?>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a
                                                    href="cart-process.php?id=<?=$tab->id_sp?>">Add to cart</a></li>
                                            <!-- <li><a class="links-details" href="wishlist.php"><i
                                                        class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn"
                                                    data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's TV & Audio Product Area End Here -->
<!-- Begin Li's Static Home Area -->
<div class="li-static-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Static Home Image Area -->
                <?php foreach($topbottom as $bottom) : ?>
                <div class="li-static-home-image" style="background-image: url(images/banner/<?=$bottom->image?>)" width="1170px"; height="400px"></div>
                <!-- Li's Static Home Image Area End Here -->
                <!-- Begin Li's Static Home Content Area -->
                <div class="li-static-home-content">
                    <div class="default-btn">
                        <a href="<?=$topbottom->link?>" class="links linkss">Shopping Now</a>
                    </div>
                </div>
                <?php endforeach;?>
                <!-- Li's Static Home Content Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Li's Static Home Area End Here -->
<!-- Begin Li's Trending Product Area -->
<?php
               $smart_sql="SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = 4 Or parent = 4) and status !=0 and status !=1 Order by id_sp DESC limit 10";
               $smart_pro=$conn->query($smart_sql)->fetchAll();
            ?>
<section class="product-area li-trending-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Tab Menu Area -->
            <div class="col-lg-12">
                <div class="li-product-tab li-trending-product-tab">
                    <h2>
                        <span>Đồng hồ</span>
                    </h2>
                    <ul class="nav li-product-menu li-trending-product-menu">
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
                <div class="tab-content li-tab-content li-trending-product-content">
                    <div id="home1" class="tab-pane show fade in active">
                        <div class="row">
                            <div class="product-active owl-carousel">
                                <?php foreach($smart_pro as $smart) :?>
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image "style="height:250px;overflow:hidden">
                                            <a  href="single-product.php?id=<?=$smart->id_sp;?>">
                                                <img src="images/<?=$smart->anh_sp;?>" alt="Li's Product Image" class="img-responsive ">
                                            </a>
                                            <?php if ($smart->status == 2) {
                                                echo '<span class="sticker">New</span>';
                                            } elseif($smart->status == 3 ) {
                                                echo '<span class="sticker" style="background:red">Hot</span>';
                                            } elseif($smart->status == 4 ){
                                                echo '<span class="sticker">New</span>';
                                                echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                    </div>
                                                </div>
                                                <h4><a class="product_name comment" href="single-product.php?id=<?=$smart->id_sp?>"><?=$smart->ten_sp?></a></h4>
                                                <div class="price-box">
                                                <?php if ($smart->gia_km ==0) {
                                                        echo '<span class="new-price">'.number_format($smart->gia_sp).'đ</span>' ;
                                                    } else {
                                                        echo '<span class="new-price new-price-2">'.number_format($smart->gia_km).'đ</span>' ;
                                                        echo '<span class="old-price">'.number_format($smart->gia_sp).'đ</span>';
                                                        echo ' <span class="discount-percentage">'.ceil($smart->sale).'%</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="cart-process.php?id=<?=$smart->id_sp?>">Add to cart</a></li>
                                                    <!-- <li><a class="links-details" href="wishlist.php"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn"
                                                            data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                class="fa fa-eye"></i></a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            <?php endforeach ;?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab Menu Content Area End Here -->
            </div>
            <!-- Tab Menu Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Trending Product Area End Here -->
<!-- Begin Li's Trendding Products Area -->
<?php
               $accessory_sql="SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = 5 Or parent = 5) and status !=0 and status !=1 Order by id_sp DESC limit 10";
               $accessory_pro=$conn->query($accessory_sql)->fetchAll();
            ?>
<section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Phụ kiện</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        <?php foreach($accessory_pro as $ac) :?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image " style="height:250px;overflow:hidden">
                                    <a href="single-product.php?id=<?=$ac->id_sp;?>">
                                        <img src="images/<?=$ac->anh_sp?>" alt="Li's Product Image" class="img-responsive">
                                    </a>
                                    <?php if ($ac->status == 2) {
                                                echo '<span class="sticker">New</span>';
                                            } elseif($ac->status == 3 ) {
                                                echo '<span class="sticker" style="background:red">Hot</span>';
                                            } elseif($ac->status == 4 ){
                                                echo '<span class="sticker">New</span>';
                                                echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                            }
                                            ?>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <!-- <a href="shop-left-sidebar.php">Graphic Corner</a> -->
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name comment" href="single-product.php?id=<?=$ac->id_sp;?>"><?=$ac->ten_sp;?></a>
                                        </h4>
                                        <div class="price-box">
                                        <?php if ($ac->gia_km ==0) {
                                                        echo '<span class="new-price">'.number_format($ac->gia_sp).'đ</span>' ;
                                                    } else {
                                                        echo '<span class="new-price new-price-2">'.number_format($ac->gia_km).'đ</span>' ;
                                                        echo '<span class="old-price">'.number_format($ac->gia_sp).'đ</span>';
                                                        echo ' <span class="discount-percentage">'.ceil($ac->sale).'%</span>';
                                                    }
                                                    ?>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="cart-process.php?id=<?=$ac->id_sp;?>">Add to cart</a></li>
                                            <!-- <li><a class="links-details" href="wishlist.php"><i
                                                        class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn"
                                                    data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Trendding Products Area End Here -->
<?php include 'footer.php'?>
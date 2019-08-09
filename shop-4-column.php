<?php include 'header.php';?>
<!-- Header Area End Here -->
<!-- Begin Li's Breadcrumb Area -->
<?php 
     $cat_id= isset($_GET['cat_id']) ? $_GET['cat_id'] : 0;
     $_search= isset($_GET['search']) ? $_GET['search'] : 0;
     $cats=$conn->query("SELECT ten_danhmuc FROM tbl_dm_sp WHERE id_dm=$cat_id")->fetch();  

     $banner_pro= $conn->query("SELECT * FROM banner WHERE ordering=4 and status =1 order by id_banner DESC limit 1 ")->fetchAll();

?>
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>

                <?php
                    if (isset($_GET['cat_id'])) {
                       echo '<li class="active">'.$cats->ten_danhmuc.'</li>';
                    } else {
                        echo '<li class="active">search:'.$_search.'</li>';
                    }
                    
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Banner Area -->
                <?php foreach($banner_pro as $ba_pro) : ?>
                <div class="single-banner shop-page-banner">
                    <a href="<?=$ba_pro->link ?>">
                        <img src="images/banner/<?=$ba_pro->image;?>" width="1170px" height="270px" alt="Li's Static Banner">
                    </a>
                </div>
                <?php endforeach;?>
                <!-- Li's Banner Area End Here -->
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show"
                                        data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i
                                            class="fa fa-th"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            <!-- <span>Showing 1 to 9 of 15</span> -->
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <!-- <div class="product-select-box">
                        <div class="product-short">
                            <p>Sort By:</p>
                            <select class="nice-select">
                                <option value="trending">Relevance</option>
                                <option value="sales">Name (A - Z)</option>
                                <option value="sales">Name (Z - A)</option>
                                <option value="rating">Price (Low &gt; High)</option>
                                <option value="date">Rating (Lowest)</option>
                                <option value="price-asc">Model (A - Z)</option>
                                <option value="price-asc">Model (Z - A)</option>
                            </select>
                        </div>
                    </div> -->
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <?php         
                    // xử lí phấn trang
                            //tính tổng số dong đang có trong product
                            if (isset($_GET['cat_id'])) {
                                $cat_id= $_GET['cat_id'] ;
                                $sq1 = "SELECT COUNT(id_sp) as tt FROM tbl_san_pham WHERE status !=0 and id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = $cat_id Or parent = $cat_id)";

                            }elseif (isset($_GET['search'])) {
                                $search= $_GET['search'] ;
                                $sq1 = "SELECT  COUNT(id_sp) as tt FROM tbl_san_pham WHERE status !=0 and ten_sp LIKE '%$search%'";

                            } else{
                                $sq1="SELECT COUNT(id_sp) as tt FROM tbl_san_pham WHERE status !=0 ";
                            };
                            $tr= $conn->query($sq1)->fetch();
                            $total = $tr->tt;
                            // số dòng mỗi trang
                            $limit = 12;
                            // tính số trang 
                            $page = ceil($total/$limit);
                            // lấy trang hiện tại theo tham số >p= tren url
                            $cr_p = !empty($_GET['p']) ? $_GET['p'] : 1;
                            // tìm biến start 
                            $start = ($cr_p-1)*$limit; 

                                if (isset($_GET['cat_id'])) {
                                    $cat_id= $_GET['cat_id'] ;
                                    $list_product = "SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE status !=0 and id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = $cat_id Or parent = $cat_id)";

                                } elseif (isset($_GET['search'])) {
                                    $search= $_GET['search'] ;
                                    $list_product = "SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE status !=0 and ten_sp LIKE '%$search%'";

                                } else{
                                    $list_product="SELECT *,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham status !=0";
                                };
                                
                                $list_product .=" Order By id_sp DESC LIMIT $start,$limit";
                                $stm=$conn->query($list_product);
                                $products = $stm->fetchAll();
                                
                            
                            ?>
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    <?php foreach($products as $pro_l) : ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image" style="height:270px;overflow:hidden">
                                                <a href="single-product.php?id=<?=$pro_l->id_sp?>">
                                                    <img src="images/<?php echo $pro_l->anh_sp; ?>"
                                                        alt="Li's Product Image" class="img-responsive">
                                                </a>
                                                <?php if ($pro_l->status == 2) {
                                                    echo '<span class="sticker">New</span>';
                                                }elseif($pro_l->status == 3 ) {
                                                    echo '<span class="sticker" style="background:red;">Hot</span>';
                                                } elseif($pro_l->status == 4 ) {
                                                    echo '<span class="sticker">New</span>';
                                                    echo '<span class="sticker" style="background:red;margin-top:32px">Hot</span>';
                                                }
                                                ?>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <!-- <a href="shop-left-sidebar.php"></a> -->
                                                        </h5>
                                                        <div class="rating-box">
                                                            <!-- <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li> -->
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name comment"
                                                            href="single-product.php?id=<?=$pro_l->id_sp?>"><?= $pro_l->ten_sp;?></a></h4>
                                                    <div class="price-box">
                                                        <?php if ($pro_l->gia_km ==0) {
                                                            echo '<span class="new-price">'.number_format($pro_l->gia_sp).'đ</span>' ;
                                                        } else {
                                                            echo '<span class="new-price new-price-2">'.number_format($pro_l->gia_km).'đ</span>' ;
                                                            echo '<span class="old-price">'.number_format($pro_l->gia_sp).'đ</span>';
                                                            echo ' <span class="discount-percentage">'.ceil($pro_l->sale).'%</span>';
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="cart-process.php?id=<?=$pro_l->id_sp?>">Add to cart</a></li>
                                                        <li><a class="links-details" href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
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
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <p>Showing 1-12 of 13 item(s)</p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul class="pagination-box">
                                    <?php if(isset($_GET['cat_id'])) : ?>
                                        <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                        </li>
                                        <?php for($i=1;$i<=$page;$i++):
                                             $act = ($i==$cr_p) ? ' class="active"' : ''?>
                                        <li <?=$act?>><a href="shop-4-column.php?cat_id=<?=$cat_id?>&p=<?=$i;?>"><?=$i;?></a></li>
                                        <?php endfor;?>
                                        <li>
                                            <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                        </li>
                                    <?php elseif(isset($_GET['search'])) : ?>
                                    <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                        </li>
                                        <?php for($i=1;$i<=$page;$i++):
                                             $act = ($i==$cr_p) ? ' class="active"' : ''?>
                                        <li <?=$act?>><a href="shop-4-column.php?search=<?=$search?>&p=<?=$i;?>"><?=$i;?></a></li>
                                        <?php endfor;?>
                                        <li>
                                            <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                    </li>
                                    <?php else : ?>
                                    <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                        </li>
                                        <?php for($i=1;$i<=$page;$i++):
                                             $act = ($i==$cr_p) ? ' class="active"' : ''?>
                                        <li <?=$act?>><a href="shop-4-column.php?search=&p=<?=$i;?>"><?=$i;?></a></li>
                                        <?php endfor;?>
                                        <li>
                                            <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                    </li>
                                    <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->
<!-- Begin Footer Area -->
<?php include 'footer.php'?>
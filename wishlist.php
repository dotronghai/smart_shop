<?php include 'header.php'?>
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li class="active">Yêu thích</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Wishlist Area Strat-->
            <div class="wishlist-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="wish.php>" method="POST">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">xóa</th>
                                                <th class="li-product-thumbnail">Ảnh sản phẩm</th>
                                                <th class="cart-product-name">tên sản phẩm</th>
                                                <th class="li-product-price">Giá</th>
                                                <th class="li-product-add-cart">Thêm vào giỏ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($wish as $w) : ?>
                                            <tr>
                                                <td class="li-product-remove"><a href="wish.php?id=<?=$w['id'];?>$action=del"><i class="fa fa-times"></i></a></td>
                                                <td class="li-product-thumbnail"><a href="single-product.php?id=<?=$w['id']?>"><img src="images/<?=$w['image']?>" class="img-responsive" width="100px" alt=""></a></td>
                                                <td class="li-product-name"><a href="single-product.php?id=<?=$w['id']?>"><?=$w['name']?></a></td>
                                                <td class="li-product-price"><span class="amount"><?=number_format($w['price'])?></span></td>
                                                <td class="li-product-add-cart"><a href="cart-process.php?<?=$w['id']?>">add to cart</a></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Wishlist Area End-->
<?php include 'footer.php'?>            

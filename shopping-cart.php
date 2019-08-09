<?php include 'header.php';
?>
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="cart-process.php" onsubmit="return validateForm()">
                    <input type="hidden" name="action" value="update">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">Xóa sản phẩm</th>
                                    <th class="li-product-thumbnail">Ảnh sản phẩm</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="li-product-price">Giá sản phẩm</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($carts as $cart) { 
                                                $sub_total = $cart['price'] * $cart['quantity'];
                                             ?>
                                <tr>
                                    <td class="li-product-remove">
                                        <a href="cart-process.php?id=<?php echo $cart['id'];?>&action=del"><i
                                                class="fa fa-times"></i>
                                        </a>
                                    </td>
                                    <td class="li-product-thumbnail"><a href="single-product.php?id=<?php echo $cart['id'];?>">

                                            <input type="hidden" name="id_update[]" value="<?php echo $cart['id'];?>">
                                            <img src="images/<?php echo $cart['image'];?>" style="width:100px"
                                                alt="Li's Product Image"></a>
                                    </td>
                                    <td class="li-product-name"><a
                                            href="single-product.php?id=<?php echo $cart['id'];?>"><?php echo $cart['name'];?></a>
                                    </td>
                                    <td class="li-product-price"><span
                                            class="amount"><?php echo number_format($cart['price']) ?>.đ</span></td>
                                    <td class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" id="quantity" value="<?php echo $cart['quantity']?>"
                                                type="text" name="quantity_up[]">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span
                                            class="amount"><?php echo number_format($sub_total) ?>.đ</span></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <button class="button clear-cart" type="button"><span>
                                            <a href="cart-process.php?action=clear" title="">Xóa giỏ hàng</a>
                                        </span>
                                    </button>
                                    <button class="button clear-cart" type="button" style="margin-left:10px;"><span>
                                            <a href="index.php" title="">Tiếp tục mua sắm</a>
                                        </span>
                                    </button>
                                </div>

                                <div class="coupon2">
                                    <button class="button"><span>Cập nhật giỏ hàng</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Tổng tiền giỏ hàng</h2>
                                <ul>
                                    <li>Tổng cộng <span><?php echo number_format(totalPrice()) ?>.đ</span></li>
                                </ul>
                                <a href="checkout.php">Thực hiện đặt hàng</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
<!--Shopping Cart Area End-->
<?php include 'footer.php'?>
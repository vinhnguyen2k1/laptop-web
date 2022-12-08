<?php
include "./conect_db.php";
$prodView = mysqli_query($con, "SELECT * FROM `products`");
function searchProd($prodView){
for ($i = 0; $i < $prodView->num_rows; $i++) {
    $inProduct = mysqli_fetch_array($prodView);
    if ($inProduct['idProduct'] == $_GET['id']){
        return $inProduct;
    }
}
}
$inProduct = searchProd($prodView);
// kiểm tra hàng
if($inProduct['quantity'] > 0)
    $Quantity = 'Còn hàng.';
else
    $Quantity = '<span style="color: red; font-size: 18px; font-weight: 600; margin-left: 8px;">Hết Hàng.<span/>';
// kiểm tra giá
$per = (($inProduct['price'] / 100) * $inProduct['discount']);
if($inProduct['discount'] !== '0')
$newprice = $inProduct['price'] - $per;
else
$newprice = $inProduct['price'];
// ss giá
$price = "";
if($newprice !== $inProduct['price'])
$price = number_format($inProduct['price'],0,' ','.');

?>
<div class="link-in__div">
    <a href="./" class="link-in__link">Home</a>
    <a href="" class="link-in__link">/</a>
    <a href="./?viewi4=<?=$inProduct['idProduct']?>&id=<?=$inProduct['idProduct']?>" class="link-in__link">This View</a>
</div>
<style>
.link-in__div {
    margin-top: 10px;
    margin-left: 10px;
}

.link-in__link {
    text-decoration: none;
    font-size: 18px;
    line-height: 18px;
    margin-left: 20px;
    color: #777;
    display: inline-block;
}
</style>
<div class="viewi4-product">
    <div class="viewi4-product__header">
        <h1><?=$inProduct['title']?></h1>
    </div>
    <div class="viewi4-product__left">
        <div class="viewi4-left__img">
            <img src="<?=$inProduct['img']?>" alt="" class="left__img-viewi4">
        </div>
    </div>
    <div class="viewi4-product__middle">
        <div class="viewi4-middle__review">
            <div class="viewi4-middle__price-div">

                <p class="viewi4-middle__price">DEAL: <?=number_format($newprice,0,' ','.')?></p>
                <p class="viewi4-middle__oldprice"><?=$price?></p>
            </div>
            <div class="viewi4-middle__price-div">
                <p class="viewi4-middle__how-text">Hãng máy tính: <span
                        class="middle__how-text-sub"><?=$inProduct['manufacturer']?>.</span></p>
            </div>
            <div class="viewi4-middle__price-div">
                <p class="viewi4-middle__how-text">Bảo hành: <span class="middle__how-text-sub">12 tháng.</span></p>
            </div>
            <div class="viewi4-middle__price-div">
                <p class="viewi4-middle__how-text">Tình trạng: <span class="middle__how-text-sub"><?=$Quantity?></span>
                </p>
            </div>
            <div class="viewi4-middle__price-div">
                <p class="viewi4-middle__how-text">Giới thiệu:
                <div class="middle__how-text-sub"><?=$inProduct['review']?></div>
                </p>
            </div>
        </div>
        <div class="viewi4-middle__price-div">
            <fieldset class="fieldset-viewi4">
                <legend class="legend-viewi4"><i class="fa-solid fa-gift"></i> Quà tặng khuyến mãi</legend>
                <div class="fieldser-flex">
                    <i class="viewi4__icon fa-solid fa-check"></i>
                    <p class="fieldset-viewi4__text"> Tặng Windows bản quyền mới</p>
                </div>
                <div class="fieldser-flex">
                    <i class="viewi4__icon fa-solid fa-check"></i>
                    <p class="fieldset-viewi4__text"> Miễn phí cân màu màn hình công nghệ cao</p>
                </div>
                <div class="fieldser-flex">
                    <i class="viewi4__icon fa-solid fa-check"></i>
                    <p class="fieldset-viewi4__text"> Balo thời trang</p>
                </div>
                <div class="fieldser-flex">
                    <i class="viewi4__icon fa-solid fa-check"></i>
                    <p class="fieldset-viewi4__text"> Chuột không dây + Bàn di cao cấp</p>
                </div>
                <div class="fieldser-flex">
                    <i class="viewi4__icon fa-solid fa-check"></i>
                    <p class="fieldset-viewi4__text"> Tặng gói cài đặt, bảo dưỡng, vệ sinh máy trọn đời</p>
                </div>
                <div class="fieldser-flex">
                    <i class="viewi4__icon fa-solid fa-check"></i>
                    <p class="fieldset-viewi4__text"> Tặng Voucher giảm giá cho lần mua tiếp theo</p>
                </div>
            </fieldset>
        </div>
        <?php if($inProduct['quantity'] > 0){ ?>
        <div class="viewi4-middle__price-div">
            <div class="middle__btn-space">
                <form
                    action="<?php if(isset($_SESSION['current_user'])){ ?>./cart/cart.php?addcart<?php }else{?>./user/login.php<?php }?>"
                    method="POST">
                    <div style="font-size:18px; width: 100%; margin-bottom:10px;">
                        Số lượng: <input type="number" name="product[<?=$inProduct['idProduct']?>]" value="1"
                            class="quantity-input">
                    </div>
                    <!-- push id product -->
                    <input type="submit" name="addCart" class="viewi4-middle__btn viewi4-middle__btn-cart"
                        value="Giỏ hàng"></input>
                    <!-- push id product -->
                    <input type="submit" name="rightNow" class="viewi4-middle__btn" value="Mua Ngay"></input>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="viewi4-product__right">
        <div class="viewi4-product__promise">
            <div class="viewi4__promise-header">
                <p class="viewi4__promise-header-text">SHOP XIN CAM KẾT</p>
            </div>
            <div class="viewi4__promise-text">
                <p class="viewi4__promise-txt-item"><i class="promise-icon fa-solid fa-bolt"></i>Chất lượng sản phẩm là
                    hàng đầu</p>
                <p class="viewi4__promise-txt-item"><i class="promise-icon fa-solid fa-bolt"></i>30 ngày đầu lỗi 1 đổi 1
                </p>
                <p class="viewi4__promise-txt-item"><i class="promise-icon fa-solid fa-bolt"></i>Hỗ trợ sau bán hàng tốt
                    nhất</p>
                <p class="viewi4__promise-txt-item"><i class="promise-icon fa-solid fa-bolt"></i>Giao hàng toàn quốc
                    nhanh nhất</p>
                <p class="viewi4__promise-txt-item"><i class="promise-icon fa-solid fa-bolt"></i>Trả góp lãi suất 0%</p>
                <p class="viewi4__promise-txt-item"><i class="promise-icon fa-solid fa-bolt"></i>Không bán máy lỗi</p>
            </div>
        </div>
        <div class="viewi4-product__address">
            <div class="viewi4__address">
                <div class="viewi4__address-item">
                    <i class="viewi4__address-icon fa-solid fa-location-dot"></i>
                </div>
                <div class="viewi4__address-item">
                    <p class="viewi4__address-txt">152 Cao Lỗ, P. 4, Quận 8, TP. HCM</p>
                </div>
            </div>
            <div class="viewi4__address">
                <div class="viewi4__address-item">
                    <i class="viewi4__address-icon fa-solid fa-phone-volume"></i>
                </div>
                <div class="viewi4__address-item">
                    <p class="viewi4__address-txt">SDT : 038.xxx.xxx</p>
                </div>
            </div>
            <div class="viewi4__address">
                <div class="viewi4__address-item">
                    <i class="viewi4__address-icon fa-solid fa-envelope"></i>
                </div>
                <div class="viewi4__address-item">
                    <p class="viewi4__address-txt">Tantaid19@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* input quantity */
.quantity-input {
    width: 20px;
    padding: 5px;
    width: 20%;
    margin-left: 10px;
}

/*  */
.viewi4-product__address {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
}

.viewi4__address {
    display: flex;
    width: 100%;
    margin: 10px 0;
}

.viewi4__address-item {}

.viewi4__address-icon {
    font-size: 18px;
    line-height: 18px;
    margin-right: 10px;
    color: var(--color-shop);
}

.viewi4__address-txt {
    font-size: 16px;
}

/*  */
.viewi4-middle__price-div {
    margin-bottom: 10px;
}

.viewi4-product {
    width: 100%;
    background-color: var(--white-color);
    margin: 10px 0 30px 0;
    display: flex;
    flex-wrap: wrap;
    padding-bottom: 20px;
}

.viewi4-product__header {
    width: 100%;
    padding: 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #ccc;
    line-height: 24px;
}

.viewi4-product__left {
    width: 30%;
    display: flex;
}

.viewi4-left__img {
    margin-left: auto;
    margin-right: auto;
}

.viewi4-product__middle {
    padding-right: 20px;
    width: 45%;
    display: flex;
    flex-direction: column;
}

.viewi4-middle__review {
    min-height: 270px;
}

.left__img-viewi4 {
    position: sticky;
    top: 0;
    width: 300px;
}

/* i4 middle */
.viewi4-middle__price-div {}

.viewi4-middle__price {
    font-size: 25px;
    line-height: 30px;
    color: red;
    font-weight: 700;
    font-style: italic;
    display: inline-block;
}

.viewi4-middle__oldprice {
    display: inline-block;
    font-size: 18px;
    opacity: .5;
    margin-left: 10px;
    font-style: italic;
    text-decoration: line-through;
}

.middle__how-text-sub p,
.viewi4-middle__how-text {
    font-size: 14px;
    font-weight: 700;
}

.middle__how-text-sub p,
.middle__how-text-sub {
    font-weight: 500;
}

.middle__how-text-sub p {
    margin-top: 5px;
    margin-left: 10px;
}

/* btn */
.middle__btn-space {
    display: flex;
}

.viewi4-middle__btn {
    font-size: 18px;
    color: var(--white-color);
    padding: 10px 20px;
    background-color: red;
    border-radius: 5px;
    border: none;
    margin-right: 10px;
}

.viewi4-middle__btn-cart {
    background-color: var(--color-shop);
}

.viewi4-middle__btn:hover {
    opacity: .7;
}

/* check */
.fieldset-viewi4 {
    padding: 10px 15px;
    border-radius: 10px;
    border-color: lawngreen;
}

.legend-viewi4 {
    padding: 5px 10px;
    background-color: lawngreen;
    border-radius: 30px;
    font-size: 14px;
    margin-left: 10px;
    color: var(--text-white);
}

.fieldset-viewi4__text {
    font-size: 13px;
    padding: 2px;
}

/* icon */
.viewi4__icon {
    background-color: lawngreen;
    padding: 2px;
    border-radius: 5px;
    width: 15px;
    height: 15px;
    line-height: 12px;
    color: var(--text-white);
    margin-top: 2px;
    margin-right: 5px;

}

.fieldser-flex {
    width: 100%;
    margin-bottom: 5px;
    display: inline-flex;
}

/* i4 right */
.viewi4-product__right {
    width: 25%;
    padding-left: 20px;
    padding-right: 20px;
    border-left: 1px solid #ccc;
    margin: -20px 0 -20px 0;
}

/*  */
.promise-icon {
    color: orange;
    margin-right: 10px;
}

.viewi4__promise-txt-item {
    margin: 10px 0;
    font-size: 14px;
}

.viewi4-product__promise {
    margin-top: 20px;
    border-bottom: 1px solid #ccc;
}

.viewi4__promise-header {
    margin-bottom: 20px;
}

.viewi4__promise-header-text {
    text-align: center;
    font-size: 18px;
    font-weight: 700;
    color: red;
}

.viewi4__promise-text {
    margin-bottom: 20px;
}
</style>
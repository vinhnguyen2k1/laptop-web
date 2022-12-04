<?php 
include '../checkrole/checkrole.php';
include '../conect_db.php';
$rowCart = mysqli_query($con,"SELECT * FROM `cart` ORDER BY `cart`.`idCart` DESC")->num_rows;
if($rowCart == 0){
?>
<div class="i4none-cart">
    <img src="../assets/imgs/error-cart/errorcart.png" alt="" class="i4none-cart__img">
</div>
<style>
.i4none-cart {
    display: flex;
}

.i4none-cart__img {
    margin: auto;
}
</style>
<?php
}else{
if (isset($_GET['limit']) && isset($_GET['page'])) {
    $getLimit = $_GET['limit'];
    $getOffset = $_GET['page'];
    } else {
    $getLimit = 3;
    $getOffset = 1;
    }
    $offset = ($getOffset - 1) * $getLimit;
    $totalpages = ceil($rowCart / $getLimit);
$cart = mysqli_query($con,"SELECT * FROM `cart` ORDER BY `cart`.`idCart` DESC LIMIT ".$getLimit." OFFSET ".$offset.";");
$order = mysqli_query($con,"SELECT * FROM `oder`");
$products = mysqli_query($con,"SELECT * FROM `products`");
// delete cart
if(isset($_POST['idCart']))
foreach($cart as $key => $value){
    if($_POST['idCart'] == $value['idCart']){
        mysqli_query($con,"DELETE FROM `cart` WHERE `cart`.`idCart` = ".$_POST['idCart']."");
        $cart = mysqli_query($con,"SELECT * FROM `cart` ORDER BY `cart`.`idCart` DESC");
    }
}
?>
<!-- cart -->
<div class="check-order">
    <div class="quantity-header">
        <span class="quantity-txt">Số lượng đơn hàng: có <?=$rowCart?> đơn hàng</span>
    </div>
    <?php foreach($cart as $key => $row){ ?>
    <div class="boxFlex-order">
        <div class="boxOder-date">
            <div class="boxOder-header__left">
                Ngày đặt hàng:
            </div>
            <div class="boxOder-header__middle">
                <?= date('d/m/Y', $row['date']) ?>
            </div>
            <div class="boxOder-header__right">
                <form action="" method="post">
                    <input type="hidden" name="idCart" value="<?=$row['idCart']?>">
                    <input type="submit" onclick="alert('bạn đã xóa đơn hàng <?=$row['idCart']?>')"
                        class="boxOder-delete" value="Hủy đơn hàng">
                </form>
            </div>
        </div>
        <div class="hidden-oder-focus">
            <div class="focus-item">
                <!-- lặp order data -->
                <?php foreach($order as $key => $orders){ 
                if($orders['idCart'] == $row['idCart']){
                    foreach($products as $key => $value){
                        if($orders['idProduct'] == $value['idProduct']) {
                ?>
                <!-- item -->
                <div class="boxOder-header__link">
                    <a href="../?viewi4=<?=$orders['idProduct']?>&id=<?=$orders['idProduct']?>" class="boxOder-link">
                        Xem sản phẩm
                    </a>
                </div>
                <div class="boxOder-item">
                    <div class="boxOder-item__img">
                        <img src=".<?=$value['img']?>" alt="" class="fix-boxOder__img">
                    </div>
                    <div class="boxOder-item__title">
                        <div class="boxOder-txt"><?=$value['title']?></div>
                    </div>
                    <div class="boxOder-item__quantity">
                        <p class="boxOder-txt">x<?=$orders['quantity']?></p>
                    </div>
                </div>
                <?php } } } } ?>
            </div>
        </div>
        <!-- total -->
        <div class="boxOder-total">
            <div class="boxOder-total__txt">
                Tổng tiền đơn hàng: <span
                    class="boxOder-total__span"><?=number_format($row['total'],0,' ','.')?>đ</span>
            </div>
        </div>
        <!-- thông tin người nhận -->
        <div class="i4user-cart">
            <div class="i4user-cart__item">
                <div class="i4user-cart__item-box">
                    <span class="i4user-txt i4user-txt-style">Tên người nhận:</span>
                </div>
                <div class="i4user-cart__item-boxRight">
                    <span class="i4user-txt"><?=$row['name']?></span>
                </div>
            </div>
            <div class="i4user-cart__item">
                <div class="i4user-cart__item-box">
                    <span class="i4user-txt i4user-txt-style">Số điện thoại người nhận:</span>
                </div>
                <div class="i4user-cart__item-boxRight">
                    <span class="i4user-txt"><?=$row['phone']?></span>
                </div>
            </div>
            <div class="i4user-cart__item">
                <div class="i4user-cart__item-box">
                    <span class="i4user-txt i4user-txt-style">Địa chỉ giao hàng:</span>
                </div>
                <!-- check address -->
                <?php
                for($i=0;$i< strlen($row['address']);$i++){
                    if($row['address'][$i] == "^")
                    $row['address'][$i] = ".";
                }
                ?>
                <div class="i4user-cart__item-boxRight">
                    <span class="i4user-txt"><?=$row['address']?></span>
                </div>
            </div>
            <div class="i4user-cart__item">
                <div class="i4user-cart__item-box">
                    <span class="i4user-txt i4user-txt-style">Ghi chú khi giao hàng:</span>
                </div>
                <div class="i4user-cart__item-boxRight">
                    <span class="i4user-txt"><?=$row['note']?></span>
                </div>
            </div>
        </div>
    </div>
    <?php 
} 
?>
    <div class="check-pages__cart">
        <?php include '../page.php' ?>
    </div>
</div>
<?php } ?>
<style>
/* pages */
.check-pages__cart {
    justify-content: center;
    width: 100%;
    display: flex;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px 0;
}

/* i4user cart */
.i4user-txt {
    font-size: 14px;
}

.i4user-txt-style {
    opacity: .7;
}

.i4user-cart {
    box-shadow: 0 0 2px #ccc;
    width: 100%;
    background-color: white;
    padding: 10px 20px;
}

.i4user-cart__item-box {
    width: 20%;
    display: flex;
    margin-right: 20px;
    justify-content: right;
}

.i4user-cart__item-boxRight {
    width: 80%;
}

.i4user-cart__item {
    margin: 5px 0;
    display: flex;
    width: 100%;
}

/* quantity */
.quantity-txt {
    font-size: 18px;
    margin: auto;
}

.quantity-header {
    display: flex;
    width: 100%;
    background-color: white;
    padding: 10px 0;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
}

/* total */
.boxOder-total {
    width: 100%;
    background-color: white;
    display: flex;
    justify-content: right;
    box-shadow: 0 0 2px #ccc;
    padding: 10px;
}

.boxOder-total__txt {
    margin-right: 20px;
    font-size: 14px;
}

.boxOder-total__span {
    margin-left: 20px;
    color: red;
    font-size: 20px;
    font-weight: 700;
}

/*  */
.check-order {
    position: relative;
    background-color: #ebebeb;
    width: 100%;
    padding: 45px 10px 45px 10px;
}

.boxFlex-order {
    margin-bottom: 20px;
    width: 100%;
    background-color: #fcfcfc;
    box-shadow: 0 0 2px #ccc;
}

/* header */
.boxOder-date {
    background-color: white;
    display: flex;
    width: 100%;
    box-shadow: 0 0 2px #ccc;
}

.boxOder-header {
    display: inline-flex;
    width: 100%;
}

.boxOder-header__right {
    width: 15%;
    position: relative;
    padding: 10px 0;
}

.boxOder-delete {
    font-size: 14px;
    color: white;
    border: none;
}

.boxOder-delete:hover {
    opacity: .7;
}

.boxOder-delete {
    text-decoration: none;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: red;
}

.boxOder-header__left {
    padding: 10px 0;
    display: flex;
    justify-content: right;
    font-size: 14px;
    width: 11%;
    margin: auto;
}


.boxOder-header__middle {
    padding: 10px 0;
    display: flex;
    justify-content: left;
    color: var(--color-shop);
    font-size: 14px;
    margin-left: 20px;
    width: 74%;
}

/* item */
.boxOder-header__link {
    width: 100%;
    padding: 10px 20px;
    background-color: #eaf4ff;
}

.boxOder-item {
    background-color: white;
    padding: 10px 0;
    align-items: center;
    display: flex;
}

.boxOder-item__img {
    width: 18%;
    display: flex;
}

.boxOder-item__title {
    width: 62%;
}

.boxOder-item__quantity {
    width: 20%;
    display: flex;
}

.fix-boxOder__img {
    width: 140px;
    margin: auto;
}

.boxOder-txt p,
.boxOder-txt {
    margin: auto;
    font-size: 14px;
    line-height: 18px;
}

.boxOder-txt p {
    margin-left: 20px;
}

.boxOder-link {
    text-decoration: none;
    color: var(--color-shop);
    font-size: 14px;
}
</style>
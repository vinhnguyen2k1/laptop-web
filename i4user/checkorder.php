<?php 
include '../checkrole/checklogin.php';
include '../conect_db.php';
$cart = mysqli_query($con,"SELECT * FROM `cart`");
$check = 0;
foreach($cart as $key => $value){
    if($value['idUser'] == $_SESSION['current_user']['idUser'])
    $check++;
}
if($check == 0){
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
$cart = mysqli_query($con,"SELECT * FROM `cart` ORDER BY `cart`.`idCart` DESC");
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
// cart item
foreach($cart as $key => $row){
    if($row['idUser'] == $_SESSION['current_user']['idUser']){
?>
<div class="check-order">
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
                        class="boxOder-delete" value="Hủy đặt hàng">
                </form>
            </div>
        </div>
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
        <!-- total -->
        <div class="boxOder-total">
            <div class="boxOder-total__txt">
                Tổng tiền đơn hàng: <span
                    class="boxOder-total__span"><?=number_format($row['total'],0,' ','.')?>đ</span>
            </div>
        </div>
    </div>
</div>
<?php }
} 
}?>
<style>
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
    width: 100%;
    padding: 20px;
}

.boxFlex-order {
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
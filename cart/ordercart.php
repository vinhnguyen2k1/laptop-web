<?php include '../checkrole/checklogin.php'; ?>
<?php 
include '../conect_db.php';
if(!empty($_POST) && isset($_POST['order']) && $_POST['order'] =='Đặt hàng ngay'){
    for($i=0;$i< strlen($_POST['address']);$i++){
        if($_POST['address'][$i] == ".")
        $_POST['address'][$i] = "^";
    }
    for($i=0;$i< strlen($_POST['note-order']);$i++){
        if($_POST['note-order'][$i] == "." || $_POST['note-order'][$i] == "'" || $_POST['note-order'][$i] == '"')
        $_POST['note-order'][$i] = " ";
    }
    // add cart
    mysqli_query($con,"INSERT INTO `cart` (`idCart`, `idUser`, `name`, `phone`, `address`, `note`, `total`, `date`) VALUES (NULL, '".$_POST['idUser']."', '".$_POST['fullname']."', ".$_POST['phone'].", '".$_POST['address']."', '".$_POST['note-order']."', ".$_POST['total']." , " . time() . ");");
    $product = mysqli_query($con,"SELECT * FROM `products`");
    $cart = mysqli_query($con,"SELECT * FROM `cart` ORDER BY `cart`.`idCart` DESC");
    foreach ($cart as $in => $idcart){
        // chỉ duyệt 1 id cart cuối cùng
        if($_SESSION['current_user']['idUser'] == $idcart['idUser'])
        foreach($_SESSION['cart'] as $key => $value){
            mysqli_query($con,"INSERT INTO `oder` (`idOder`, `idCart`, `idProduct`, `quantity`) VALUES (NULL, ".$idcart['idCart'].", ".$key.", ".$value.");");
            // xóa session cart và chuyển hướng 
            unset($_SESSION['cart']);
            ?>
<meta http-equiv="refresh" content="0;url=../i4user/view-user.php?checkorder"> <?php
        }
        break;
    } 
}
$order = mysqli_query($con, "SELECT * FROM `i4user`");
while($row = mysqli_fetch_array($order)){
    if($_SESSION['current_user']['idUser'] == $row['idUser']){
?>
<form action="" method="POST">
    <div class="order-cart">
        <div class="order-cart__sum">
            <div class="order-cart__sum-70">
                <p class="cart__sum-txt">Tổng thanh toán</p>
            </div>
            <div class="order-cart__sum-15 order-cart__primary">
                <span class="cart__sum-txt-span"><?=number_format($sum,0,' ','.')?>đ</span>
            </div>
            <div class="order-cart__sum-15 sum-15__relative">
                <a href="">
                    <input type="submit" name="order" value="Đặt hàng ngay" class="input-submit">
                </a>
            </div>
        </div>
        <div class="header-order">
            <h1 class="header-order__h1">Thông tin khách hàng</h1>
            <p class="header-order__txt">Quản lý thông tin đặt hàng cho đơn hàng</p>
        </div>
        <div class="order-cart__form">

            <!-- item -->
            <div class="box-flex__cart">
                <div class="cart__form-item">
                    <div class="form-item__30">
                        <span class="cart__form-txt">Tên người nhận </span>
                    </div>
                    <div class="form-item__70">
                        <span class="cart__form-i4"><?=$row['fullname']?></span>
                    </div>
                </div>
            </div>
            <!-- check address -->
            <?php
            for($i=0;$i< strlen($row['address']);$i++){
                if($row['address'][$i] == "^")
                $row['address'][$i] = ".";
            }
            ?>
            <!-- item -->
            <div class="box-flex__cart">
                <div class="cart__form-item">
                    <div class="form-item__30">
                        <span class="cart__form-txt">Địa chỉ nhận hàng </span>
                    </div>
                    <div class="form-item__70">
                        <span class="cart__form-i4"><?=$row['address']?> </span>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="box-flex__cart">
                <div class="cart__form-item">
                    <div class="form-item__30">
                        <span class="cart__form-txt">Số điện thoại người nhận </span>
                    </div>
                    <div class="form-item__70">
                        <span class="cart__form-i4"><?=$row['phone']?> </span>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="box-flex__cart">
                <div class="cart__form-item">
                    <div class="form-item__30">
                        <span class="cart__form-txt">Ghi chú khi giao hàng </span>
                    </div>
                    <div class="form-item__70">
                        <textarea style="padding:5px;" name="note-order" id="" cols="50" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="box-flex__cart">
                <div class="cart__form-item">
                    <div class="form-item__30">
                    </div>
                    <div class="form-item__70">
                        <a href="../i4user/view-user.php?i4user" class="fix-order__link-btn">
                            <p class="fix-order__btn">Sửa Thông Tin</p>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- i4 order cart -->
    <input type="hidden" name="idUser" value="<?=$row['idUser']?>">
    <input type="hidden" name="product" value="<?=implode(",",array_keys($_SESSION['cart']))?>">
    <input type="hidden" name="fullname" value="<?=$row['fullname']?>">
    <input type="hidden" name="address" value="<?=$row['address']?>">
    <input type="hidden" name="phone" value="<?=$row['phone']?>">
    <input type="hidden" name="total" value="<?=$sum?>">

</form>
<?php
    }
}
?>
<style>
/* header order */

.header-order {
    margin: 10px 20px;
    width: 100%;
}

.header-order__h1 {
    font-size: 18px;
}

.header-order__txt {
    font-size: 15px;
    margin: 5px 0;
    opacity: 0.5;
}

/* i4 */
.fix-order__link-btn {
    text-decoration: none;
}

.fix-order__btn {
    background-color: var(--color-shop);
    display: inline-block;
    color: var(--text-white);
    padding: 10px 20px;
    font-size: 14px;
}

.fix-order__btn:hover {
    opacity: .7;
}

.sum-15__relative {
    position: relative;
}

.input-submit {
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border: none;
    background: red;
    color: var(--white-color);
}

.input-submit:hover {
    cursor: pointer;
    opacity: .6;
}

.cart__form-i4,
.cart__form-txt {
    font-size: 14px;
}

.cart__form-i4 {
    font-size: 14px;
}

.cart__form-txt {
    opacity: .7;
}

/* FLEX item */
.box-flex__cart {
    display: flex;
    width: 100%;
}

.form-item__30 {
    width: 30%;
    display: flex;
    justify-content: right;
}

.form-item__70 {
    margin-left: 20px;
    justify-content: left;
    width: 70%;
}

/* order */
.cart__form-item {
    display: flex;
    width: 70%;
    margin: 5px 0;
    display: flex;
    width: 70%;
}

.cart__form-tr {
    display: flex;
}

.order-cart {
    background-color: var(--white-color);
    margin-bottom: 10px;
}

.order-cart__sum {
    /* background-color: #eaf4ff; */
    display: flex;
    /* border-bottom: 1px solid #ccc; */
}

.order-cart__primary {
    background-color: #fdfdfd;
}

.order-cart__sum-70 {
    padding: 10px 0;
    width: 70%;
    display: flex;
    justify-content: center;
    border-bottom: 1px solid #f3f3f3;
}

.order-cart__sum-15 {
    padding: 10px 0;
    width: 15%;
    display: flex;
    justify-content: center;
}

.cart__sum-txt {
    font-size: 18px;
}

.cart__sum-txt-span {
    font-size: 14px;
    color: red;
    font-weight: 700;
}

.order-cart__form {
    width: 100%;
    padding: 20px;
}
</style>
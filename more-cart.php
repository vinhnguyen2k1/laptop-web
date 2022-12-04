<?php
include './conect_db.php';
$productRow = mysqli_query($con, "SELECT * FROM `products`")->num_rows;
if (!empty($_SESSION['cart'])) {
    // chuyển keys [cart] thành chuỗi 1,2,3
    $ar = implode(",", array_keys($_SESSION['cart']));
    $productList = mysqli_query($con, "SELECT * FROM `products` WHERE `idProduct` IN (" . $ar . ")");
    $productRow = $productList->num_rows;

?>
<div class="more-cart">
    <div class="more-cart__header">
        Sản Phẩm Mới Thêm
    </div>
    <div class="more-cart__hidden">
        <?php for ($i = 0; $i < $productRow; $i++) {
            if (!empty($_SESSION['cart'])) {
                $row = mysqli_fetch_array($productList); ?>
        <a href="./?viewi4=<?= $row['idProduct'] ?>&id=<?= $row['idProduct'] ?>" class="box-product__cart-link">
            <div class="box-product__cart">
                <div class="more-cart__img">
                    <img src="<?= $row['img'] ?>" alt="" class="more-cart__img-fix">
                </div>
                <div class="more-cart__title">
                    <span class="more-cart__title-txt"><?= $row['title'] ?></span>
                </div>
                <div class="more-cart__quantity">
                    <?php $newprice = $row['price'] - (($row['price'] / 100) * $row['discount']); ?>
                    <span class="more-cart__price"><?= number_format($newprice, 0, ' ', '.') ?>đ</span>
                </div>
            </div>
        </a>
        <?php  }
        } ?>
    </div>
    <div class="more-cart__footer">
        <span style="color:#666;">Có <?= $productRow ?> sản phẩm trong giỏ</span>
        <a href="./cart/cart.php">
            <button class="cart__footer-btn">Xem Giỏ Hàng</button>
        </a>
    </div>
</div>
<?php } ?>

<style>
/* more cart */
.more-cart__hidden {
    max-height: 300px;
    overflow-y: scroll;
}

.more-cart__hidden::-webkit-scrollbar {
    display: none;
}

.neo-more__card {}

.cart-icon {
    display: inline-block;
    position: relative;
}

.cart-icon:hover .more-cart {
    display: block;
}

.more-cart {
    position: absolute;
    width: 350px;
    background-color: white;
    top: 140%;
    right: -74px;
    box-shadow: 0 0 5px #ccc;
    z-index: 3;
    animation: showAnimation ease-in .2s;
    display: none;
}

@keyframes showAnimation {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.more-cart::before {
    content: "";
    position: absolute;
    width: 100%;
    top: -13px;
    height: 20px;
}

.more-cart::after {
    content: "";
    position: absolute;
    top: -12px;
    right: 70px;
    width: 0px;
    height: 0px;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid var(--white-color);
}

.more-cart__img {
    width: 30%;
    display: flex;
}

.more-cart__img-fix {
    margin: auto;
}

.more-cart__title {
    width: 45%;
}

.more-cart__quantity {
    display: flex;
    width: 25%;
}

.more-cart__img-fix {
    width: 70px;
    padding: 10px 0;
}

.more-cart__price,
.more-cart__title-txt p {
    line-height: 14px;
    height: 24px;
    overflow: hidden;
    margin: auto;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}

.more-cart__price {
    color: red;
}

.box-product__cart {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.box-product__cart:hover {
    background-color: #fdfafa;
}

.more-cart__header {
    width: 100%;
    padding: 10px 20px;
    font-size: 14px;
    color: #999;
}

.box-product__cart-link {
    text-decoration: none;
    color: var(--black-color);
}

.more-cart__footer {
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #fbfbfb;
    align-items: center;
}

.cart__footer-btn {
    border: none;
    background-color: var(--color-shop);
    color: var(--text-white);
    padding: 8px 12px;
}

.cart__footer-btn:hover {
    opacity: .8;
}
</style>
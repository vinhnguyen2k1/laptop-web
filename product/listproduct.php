<?php include '../checkrole/checkrole.php'; ?>
<link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.2.0-web/css/all.min.css">
<!-- hiện thông báo xóa sp -->
<?php
include '../conect_db.php';
if (!empty($_GET['limit']) && !empty($_GET['page'])) {
   $getLimit = $_GET['limit'];
   $getOffset = $_GET['page'];
} else {
   $getLimit = 12;
   $getOffset = 1;
}
$offset = ($getOffset - 1) * $getLimit;
$list = mysqli_query($con, "SELECT * FROM `products` ORDER BY `idProduct` DESC limit " . $getLimit . " OFFSET " . $offset . "");
$rowProducts = mysqli_query($con, "SELECT * FROM `products` ORDER BY `idProduct` DESC")->num_rows;
$totalpages = ceil($rowProducts / $getLimit);
$test = mysqli_fetch_all($list);
?>
<div class="list-produc-php">
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">id</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Ảnh</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Tên</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Giới Thiệu</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Giá</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Giảm Giá<br />(%)</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">SL</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Hãng SX</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Sửa Sản Phẩm</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">Xóa Sản Phẩm</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl-header">id sản phẩm</p>
    </div>
</div>
<?php
foreach ($list as $key => $lists){
?>
<div class="list-produc-php">
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$lists['idProduct']?></p>
    </div>
    <div class="produc-php__colums">
        <img src=".<?=$lists['img']?>" alt="" class="produc-php__colums-img">
    </div>

    <div class="produc-php__colums">
        <div class="produc-php__colums-btn">Xem
            <div class="produc-php__hover">
                <div class="produc-php__hover-header">
                    <p class="prd-php__cl">Tên sản phẩm id [<?=$lists['idProduct']?>]</p>
                </div>
                <div class="produc-php__hover-text">
                    <p class="prd-php__cl"><?=$lists['title']?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="produc-php__colums">
        <div class="produc-php__colums-btn">Xem
            <div class="produc-php__hover">
                <div class="produc-php__hover-header">
                    <p class="prd-php__cl">Giới thiệu sản phẩm id [<?=$lists['idProduct']?>]</p>
                </div>
                <div class="produc-php__hover-text">
                    <p class="prd-php__cl"><?=$lists['review']?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=number_format($lists['price'])?></p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$lists['discount']?>%</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$lists['quantity']?></p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$lists['manufacturer']?></p>
    </div>
    <div class="produc-php__colums">
        <a href="../user/admin.php?idproduct=<?=$lists['idProduct']?>" class="btn-fix-product">
            <p class="prd-php__cl">Sửa</p>
        </a>
    </div>
    <div class="produc-php__colums">
        <a href="../user/admin.php?delete_product=<?=$lists['idProduct']?>" class="btn-del-product">
            <p class="prd-php__cl">Xóa</p>
        </a>
    </div>
</div>
<?php
}
?>
<div class="pages_product">
    <?php
      include '../page.php';
   ?>
</div>
<style>
.btn-del-product,
.btn-fix-product,
.produc-php__colums-btn {
    color: white;
    background-color: var(--color-shop);
    padding: 5px 10px;
    border-radius: 5px;

}

.btn-del-product,
.btn-fix-product {
    background-color: lawngreen;
    text-decoration: none;
}

.btn-del-product {
    background-color: red;
}

.produc-php__hover-header {
    width: 100%;
    font-size: 18px;
    font-weight: 700;
    border-bottom: 1px solid var(--color-shop);
    padding: 10px;
    display: flex;
    justify-content: center;
    color: black;
}

.produc-php__hover-text {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    line-height: 22px;
    text-align: left;
    color: black;
}

.produc-php__colums-btn:hover .produc-php__hover {
    display: flex;
    flex-direction: column;
}

.produc-php__hover {
    border-radius: 10px;
    position: fixed;
    top: 280px;
    left: 400px;
    right: 400px;
    bottom: 280px;
    min-height: 200px;
    display: none;
    background-color: var(--white-color);
    box-shadow: 0px 2px 2px 2px var(--color-shop);
    z-index: 2;
}

.prd-php__cl {
    text-align: left;
}

.prd-php__cl-header {
    font-size: 15px;
    font-weight: 700;
    width: 100%;
    text-align: center;
}

.list-produc-php {
    width: 100%;
    display: flex;
    background-color: #ccc;
}

.produc-php__colums {
    justify-content: center;
    align-items: center;
    display: flex;
    border-bottom: 1px solid var(--color-shop);
    width: 10%;
    min-width: 10%;
    max-height: 100%;
    overflow: hidden scroll;
    padding: 10px 2px;
    background-color: white;
}

.produc-php__colums::-webkit-scrollbar {
    display: none;
}

.produc-php__colums-img {
    width: 100%;
}
</style>
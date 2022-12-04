<!-- view slider -->
<div style="height: 450px; position:relative;" class="slider">
    <div style="height: 100%; margin-top:10px; position:relative;">
        <?php include './slider.php'; ?>
    </div>
</div>
<div class="container">
    <div class="container-header">
        <div class="container-header__land">
            <div class="container-header__box">
                <p class="container-header__text" style="max-width: calc(100% - 32px);">Sản Phẩm mới</p>
            </div>
            <div class="container-price">
                <p class="container-price__text">mức giá:</p>
                <a class="container-proce__link" href="./?form=5&to=10">
                    <p class="container-price__about">5 triệu - 10 triệu</p>
                </a>
                <a class="container-proce__link" href="./?form=10&to=20">
                    <p class="container-price__about">10 triệu - 20 triệu</p>
                </a>
                <a class="container-proce__link" href="./?form=20&to=30">
                    <p class="container-price__about">20 triệu - 30 triệu</p>
                </a>
                <a class="container-proce__link" href="./?form=30&to=1000">
                    <p class="container-price__about">Trên 30 triệu</p>
                </a>
            </div>
        </div>
    </div>

    <!-- view product -->
    <div class="container-products">
        <?php for ($i = 0; $i < $products->num_rows; $i++) {
$inProduct = mysqli_fetch_array($products); ?>
        <div class="container-products__item">
            <div style="height: 228px; width:228px; display:flex; justify-content: center;
            align-items: center; ">
                <a href="./?viewi4=<?=$inProduct['idProduct']?>&id=<?=$inProduct['idProduct']?>">
                    <!-- ảnh product -->
                    <div class="contai-img-view" style="background-image: url(<?= $inProduct['img'] ?>)">

                    </div>
                </a>
            </div>
            <?php if ($inProduct['discount'] !== '0') { ?>
            <!-- div yellow -->
            <div class="product-discount"></div>
            <!-- div % -->
            <div class="product-discount-persent">- <?= $inProduct['discount'] ?>% </div>
            <?php } ?>
            <div class="container-products__item-review" style="margin-top:10px; min-height: 50px;">
                <a href="./?viewi4=<?=$inProduct['idProduct']?>&id=<?=$inProduct['idProduct']?>"
                    class="container-products__item-review-link">
                    <div class="container-products__item-review-text">
                        <?= $inProduct['title'] ?>
                    </div>
                </a>
            </div>
            <?php 
            $newprice = $inProduct['price'] - (($inProduct['price'] / 100) * $inProduct['discount']);
               if ($inProduct['discount'] == '0') { 
          ?>
            <div class="price-div__product">
                <p class="new-price"> <?= number_format($newprice) ?>đ </p>
                <?php } else { ?>
                <div class="price-div__product2">
                    <p class="old-price"> <?= number_format($inProduct['price']) ?>đ </p>
                    <p class="new-price"> <?= number_format($newprice) ?>đ </p>
                    <?php } ?>
                </div>
                <!-- /div product item -->
            </div>
            <?php } ?>
        </div>
        <!-- hiển thị nút trang -->
        <div class="pages_product">
            <?php include './page.php'; ?>
        </div>
        <style>
        .contai-img-view {
            background-size: 100% 100%;
            width: 215px;
            height: 215px;
            transition: .3s;
            overflow: hidden;
        }

        .contai-img-view:hover {
            width: 228px;
            height: 228px;
        }
        </style>
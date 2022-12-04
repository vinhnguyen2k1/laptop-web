<?php include '../checkrole/checkrole.php'; ?>
<link rel="stylesheet" href="../assets/css/upproduct.css">
<?php
// form fix sp
if(isset($_GET['idproduct'])){
    include "../conect_db.php";
    $upload = mysqli_query($con, "SELECT * FROM `products`");
    foreach ($upload as $key => $uploads){
        if ($uploads['idProduct']==$_GET['idproduct']){

                    // hien thi sp cũ
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

</div>
<!--  -->
<div class="list-produc-php">
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$uploads['idProduct']?></p>
    </div>
    <div class="produc-php__colums">
        <img src=".<?=$uploads['img']?>" alt="" class="produc-php__colums-img">
    </div>

    <div class="produc-php__colums">
        <div class="produc-php__colums-btn">Xem
            <div class="produc-php__hover">
                <div class="produc-php__hover-header">
                    <p class="prd-php__cl">Tên sản phẩm id [<?=$uploads['idProduct']?>]</p>
                </div>
                <div class="produc-php__hover-text">
                    <p class="prd-php__cl"><?=$uploads['title']?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="produc-php__colums">
        <div class="produc-php__colums-btn">Xem
            <div class="produc-php__hover">
                <div class="produc-php__hover-header">
                    <p class="prd-php__cl">Giới thiệu sản phẩm id [<?=$uploads['idProduct']?>]</p>
                </div>
                <div class="produc-php__hover-text">
                    <p class="prd-php__cl"><?=$uploads['review']?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=number_format($uploads['price'])?></p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$uploads['discount']?>%</p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$uploads['quantity']?></p>
    </div>
    <div class="produc-php__colums">
        <p class="prd-php__cl"><?=$uploads['manufacturer']?></p>
    </div>
</div>
<!-- hien thi thong bao -->
<div class="div-in4mAlo">
    <p class="in4mAlo"
        style="<?php if ($alo == "Sửa sản phẩm thành công!"){ ?> color: green;<?php }else{ ?>color:red;<?php } ?>">
        <?=$alo?></p>
</div>
<!-- end thong bao -->
<form class="form-upload" action="" method="POST">

    <table class="table-upprd">
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Link ảnh:</td>
            <td><input type="text" class="upprd-input" name="imgProduct" value="<?=$uploads['img']?>"><br /></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Tên sản phẩm:</td>
            <td><textarea name="nameProduct" id="titleProductt" cols="30" rows="10"><?=$uploads['title']?></textarea>
            </td>

        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Giới thiệu sản phẩm:</td>
            <td><textarea name="reviewProduct" id="reviewProductt" cols="30"
                    rows="10"><?=$uploads['review']?></textarea></td>
            <!-- <td><input type="text" class="upprd-input" name="reviewProduct"><br /></td> -->
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item"><label for="manufacturer">Hãng SX:</label></td>
            <td><select name="manufacturer" id="manufacturer">
                    <option value="<?=$uploads['manufacturer']?>"><?=$uploads['manufacturer']?></option>
                    <option value="Apple">Apple</option>
                    <option value="Think Pad">Think Pad</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="Sony VAIO">Sony VAIO</option>
                    <option value="Dell">Dell</option>
                    <option value="Acer">Acer</option>
                    <option value="HP">HP</option>
                    <option value="Sam Sung">Samsung</option>
                    <option value="Asus">Asus</option>
                    <option value="Toshiba">Toshiba</option>
                    <option value="MSI">MSI</option>
                </select></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Giá sản phẩm:</td>
            <td><input type="number" class="upprd-input" name="priceProduct" value="<?=$uploads['price']?>"><br /></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Discount sản phẩm:</td>
            <td><input type="number" class="upprd-input" name="discountProduct" value="<?=$uploads['discount']?>"><br />
            </td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Số lượng SP trong kho:</td>
            <td><input type="number" class="upprd-input" name="quantityProduct" value="<?=$uploads['quantity']?>"><br />
            </td>
        </tr>
    </table>
    <div style="width:100%; justify-content: center; display: flex;">

        <input type="submit" class="upprd-submit" name="submit" value="UpProduct">
    </div>
</form>
<?php
        }
    }
}else{
?>
<!-- form upload binh thuong -->
<form class="form-upload" action="" method="POST">

    <table class="table-upprd">
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Link ảnh:(*)</td>
            <td><input type="text" class="upprd-input" name="imgProduct"><br /></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Tên sản phẩm: (*)</td>
            <td><textarea name="nameProduct" id="titleProductt" cols="30" rows="10"></textarea></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Giới thiệu sản phẩm:</td>
            <td><textarea name="reviewProduct" id="reviewProductt" cols="30" rows="10"></textarea></td>
            <!-- <td><input type="text" class="upprd-input" name="reviewProduct"><br /></td> -->
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item"><label for="manufacturer">Hãng SX: (*)</label></td>
            <td><select name="manufacturer" id="manufacturer">
                    <option value="None">None</option>
                    <option value="Apple">Apple</option>
                    <option value="Think Pad">Think Pad</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="Sony VAIO">Sony VAIO</option>
                    <option value="Dell">Dell</option>
                    <option value="Acer">Acer</option>
                    <option value="HP">HP</option>
                    <option value="Sam Sung">Samsung</option>
                    <option value="Asus">Asus</option>
                    <option value="Toshiba">Toshiba</option>
                    <option value="MSI">MSI</option>
                </select></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Giá sản phẩm: (*)</td>
            <td><input type="number" class="upprd-input" name="priceProduct"><br /></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Discount sản phẩm:</td>
            <td><input type="number" class="upprd-input" name="discountProduct"><br /></td>
        </tr>
        <tr class="table-upprd__list">
            <td class="table-upprd__item">Số lượng SP trong kho: (*)</td>
            <td><input type="number" class="upprd-input" name="quantityProduct"><br /></td>
        </tr>
    </table>
    <div style="width:100%; justify-content: center; display: flex;">

        <input type="submit" class="upprd-submit" name="submit" value="UpProduct">
    </div>
</form>
<?php
}
?>
<script src="../assets/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.replace('reviewProductt');
CKEDITOR.replace('titleProductt');
</script>
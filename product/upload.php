<?php include '../checkrole/checkrole.php'; ?>
<!-- up sp -->
<div style="width:100%; margin:20px 40px 0 40px;">
    <fieldset class="fieldset-upload">
        <legend class="legend-upload">UpLoad Sản Phẩm</legend>
        <?php
    include "../conect_db.php";
    $upload = mysqli_query($con, "SELECT * FROM `products`");
    // foreach ($upload as $key => $values) {
    // var_dump($values);
    // }
    $alo = "";
    if(!empty($_POST['submit']) && $_POST['submit'] == 'UpProduct'){
            $alo = "Thêm sản phẩm thành công!";
            // kiểm tra và thông báo.
            if(strlen($_POST['nameProduct'])>300)
            $alo = "Tên sản phẩm không được dài quá 300 ký tự";
            if(strlen($_POST['reviewProduct'])>1500)
            $alo = "Giới thiệu phẩm không được dài quá 1500 ký tự";
            if(strlen($_POST['priceProduct'])>11)
            $alo = "Giá không được hơn 11 số";
            if(strlen($_POST['priceProduct'])>11)
            $alo = "Giá không được hơn 11 số";
            if(strlen($_POST['quantityProduct'])>11)
            $alo = "Số lượng không được hơn 11 số";
            if($_POST['quantityProduct'] < 0)
            $alo = "Số lượng không được nhỏ hơn 0";
            // kiểm tra hàm bắt buộc rỗng
            $test = "";
            if($_POST['imgProduct'] == "")
            $test .= " Ảnh.";
            if($_POST['nameProduct'] == "")
            $test .= " Tên.";
            if($_POST['priceProduct'] == "")
            $test .= " Giá tiền.";
            if($_POST['manufacturer'] == "None")
            $test .= " Hãng SX.";
            if($_POST['quantityProduct'] == "")
            $test .= " Số lượng.";
            if ($test !== ""){
                $alo = "Không được để trống:  $test";
            }
            // kiểm tra dis rỗng
            if($_POST['discountProduct'] == "")
            $_POST['discountProduct'] = "0";
            // kiểm tra giảm giá
            if((int)$_POST['discountProduct'] > 100)
                $alo = "Không được giảm giá hơn 100%";

            if($alo == "Thêm sản phẩm thành công!" && $test == ""){
                $upload = mysqli_query($con, "INSERT INTO `products` (`idProduct`, `img`, `title`, `review`, `price`, `discount`, `quantity` , `manufacturer`) VALUES (NULL, '".$_POST['imgProduct']."', '".$_POST['nameProduct']."', '".$_POST['reviewProduct']."', '".$_POST['priceProduct']."', '".$_POST['discountProduct']."' , '".$_POST['quantityProduct']."', '".$_POST['manufacturer']."');");
            }
    }
?>
        <div class="div-in4mAlo">
            <p class="in4mAlo"
                style="<?php if ($alo == "Thêm sản phẩm thành công!"){ ?> color: green;<?php }else{ ?>color:red;<?php } ?>">
                <?=$alo?></p>
        </div>
        <?php
    include '../product/upproduct.php';
?>
    </fieldset>
</div>
<style>
.div-in4mAlo {
    margin-top: 10px;
    display: flex;
}

.in4mAlo {
    font-size: 18px;
    margin: auto;
}
</style>
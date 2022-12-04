<?php include '../checkrole/checkrole.php'; ?>
<link rel="stylesheet" href="../assets/css/fix-product.css">
<!-- up sp -->
<div style="width:100%; margin:20px 40px 0 40px;">
    <fieldset class="fieldset-upload">
        <legend class="legend-upload">Sửa Sản Phẩm</legend>
        <?php
    include "../conect_db.php";
    $upload = mysqli_query($con, "SELECT * FROM `products`");
    $alo = "";
    if (isset($_GET['delete_product'])){
        mysqli_query($con, "DELETE FROM `products` WHERE `products`.`idProduct` = ".$_GET['delete_product']."");
        ?>
        <script>
        window.alert("Đã xóa sản phẩm id: <?=$_GET['delete_product']?> !");
        </script>
        <meta http-equiv="refresh" content="0;url=../user/admin.php?dsSpham">
        <?php    
    }
    if(isset($_GET['idproduct'])){
        $id = $_GET['idproduct'];
        if(!empty($_POST['submit']) && $_POST['submit'] == 'UpProduct'){
            $leng = $_POST['nameProduct'];
    
        // for($i = 0 ; $i < strlen($leng); $i++){
        //     if($leng[$i] == '"')
        //     $leng[$i] = '&quot;';
        //     if($leng[$i] == "'")
        //     $leng[$i] = '&#39;';
        // }

            $lengRv = $_POST['reviewProduct'];
        // for($i = 0 ; $i < strlen($lengRv); $i++){
        //     if($lengRv[$i] == '"')
        //     $lengRv[$i] = '&quot;';
        //     if($lengRv[$i] == "'")
        //     $lengRv[$i] = '&#39;';
        // }
            $alo = "";
            if($_POST['discountProduct'] == "")
            $_POST['discountProduct'] = "0";
            // kiểm tra giảm giá
            if((int)$_POST['discountProduct'] > 100){
                $alo = "Không được giảm giá hơn 100%";
            }else{
                $alo = "Sửa sản phẩm thành công!";
                $fixproduct = mysqli_query($con, "UPDATE `products` SET `img` = '".$_POST['imgProduct']."', `title` = '".$leng."', `review` = '".$lengRv."', `price` = '".$_POST['priceProduct']."', `discount` = '".$_POST['discountProduct']."', `quantity` = '".$_POST['quantityProduct']."', `manufacturer` = '".$_POST['manufacturer']."' WHERE `products`.`idProduct` = ".$id.";"); 
            }
            // kiểm tra và thông báo.
            if(strlen($leng)>300)
            $alo = "Tên sản phẩm không được dài quá 300 ký tự";
            if(strlen($lengRv)>1500)
            $alo = "Giới thiệu phẩm không được dài quá 1500 ký tự";
            if(strlen($_POST['priceProduct'])>11)
            $alo = "Giá tiền không được hơn 11 số";
            if(strlen($_POST['quantityProduct'])>11)
            $alo = "Số lượng không được hơn 11 số";
            
        }
    }
    
?>
        <?php
    include '../product/upproduct.php';
?>
    </fieldset>
</div>
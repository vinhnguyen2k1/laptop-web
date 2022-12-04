<?php
session_start();
include '../conect_db.php';
$cartList = mysqli_query($con,"SELECT * FROM `cart`");
$oderList = mysqli_query($con,"SELECT * FROM `oder`");
$productRow = mysqli_query($con,"SELECT * FROM `products`")->num_rows;


// unset($_SESSION['cart']);exit;
// var_dump($_POST['product']);exit;
if(isset($_GET['addcart'])){
    if(isset($_POST['addCart'])){
        foreach ($_POST['product'] as $key => $value){
            $_SESSION['cart'][$key] = $value;
            ?>
<meta http-equiv="refresh" content="0;url=../?viewi4=<?=$key?>&id=<?=$key?>"> <?php
        }
    }
    if(isset($_POST['rightNow'])){
        foreach ($_POST['product'] as $key => $value){
            $_SESSION['cart'][$key] = $value;
        }
    }
}
    

// duyệt product id
if(!empty($_SESSION['cart'])){
    // chuyển keys [cart] thành chuỗi 1,2,3
    $ar = implode(",",array_keys($_SESSION['cart']));
    $productList = mysqli_query($con,"SELECT * FROM `products` WHERE `idProduct` IN (".$ar.")");
    $productRow = $productList->num_rows;
}

// xóa product khỏi giỏ hàng
if(isset($_GET['delete'])){
    $key = $_GET['delete'];
    unset($_SESSION['cart'][$key]);
    header('location: ./cart.php');
}
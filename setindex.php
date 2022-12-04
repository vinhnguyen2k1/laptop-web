<?php
include './conect_db.php';
session_start();
$result = mysqli_query($con, "SELECT * FROM user");
$search = isset($_GET['search']) ? $_GET['search'] : "";
if (!empty($_GET['limit']) && !empty($_GET['page'])) {
    if($_GET['page'] < 0){
        header('location: ./');
    }
$getLimit = $_GET['limit'];
$getOffset = $_GET['page'];
} else {
$getLimit = 12;
$getOffset = 1;
}
$offset = ($getOffset - 1) * $getLimit;
if ($search) {
$rowProducts = mysqli_query($con, "SELECT * FROM `products` WHERE `title` LIKE '%".$search."%' OR `manufacturer` LIKE '%".$search."%';")->num_rows;
$products = mysqli_query($con, "SELECT * FROM `products` WHERE `title` LIKE '%".$search."%' OR `manufacturer` LIKE '%".$search."%' ORDER BY `idProduct` DESC limit " . $getLimit . " OFFSET " . $offset . "");
} else {
$rowProducts = mysqli_query($con, "SELECT * FROM `products`")->num_rows;
$products = mysqli_query($con, "SELECT * FROM `products` ORDER BY `idProduct` DESC limit " . $getLimit . " OFFSET " . $offset . "");
}
if (isset($_GET['discount'])) {
$rowProducts = mysqli_query($con, "SELECT * FROM `products` WHERE `discount`")->num_rows;
$products = mysqli_query($con, "SELECT * FROM `products` WHERE `discount` ORDER BY `idProduct` DESC limit " . $getLimit . " OFFSET " . $offset . "");
}
if (isset($_GET['form']) && isset($_GET['to'])) {
$checkprice = mysqli_query($con,"SELECT * FROM `products`");
foreach($checkprice as $key => $value){
    $newprice = $value['price'] - (($value['price'] / 100) * $value['discount']);
    if($newprice >= $_GET['form'] * 1000000 && $newprice <= $_GET['to'] * 1000000){
        $id[] = $value['idProduct'];
    }
}
if(!empty($id)){
$arrid = implode(",",array_values($id));
$rowProducts = mysqli_query($con, "SELECT * FROM `products` WHERE `idProduct` IN (".$arrid.")")->num_rows;
$products = mysqli_query($con, "SELECT * FROM `products` WHERE `idProduct` IN (".$arrid.")");
}else{
    $products = mysqli_query($con, "SELECT * FROM `products` WHERE `price` = 0");
}
}
if (isset($_GET['manufacturer'])) {
    $rowProducts = mysqli_query($con, "SELECT * FROM `products` WHERE `manufacturer` LIKE '".$_GET['manufacturer']."'")->num_rows;
    $products = mysqli_query($con, "SELECT * FROM `products` WHERE `manufacturer` LIKE '".$_GET['manufacturer']."' ORDER BY `idProduct` DESC limit " . $getLimit . " OFFSET " . $offset . "");
}

$totalpages = ceil($rowProducts / $getLimit);

mysqli_close($con);
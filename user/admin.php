<!-- check quyền -->
<?php session_start(); 
include '../checkrole/checkrole.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/adminpage.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/imgs/favicon/logo.png" />
    <title>Sell LapTop</title>
</head>

<body style="background-color: rgb(241, 241, 240);">
    <!-- Header -->
    <div id="header">
        <div class="grid">
            <div class="header-container">
                <div class="header-container__logo">
                    <a href="../index.php">
                        <img src="../assets/imgs/containerHeader/Logo.png" alt="Logo"
                            class="header-container__logo-size">
                    </a>
                    <!-- logo img -->
                </div>
                <div class="header-container__search">

                </div>
                <div class="header-container__cart">

                </div>
            </div>
        </div>
        <div class="header-menu">
            <div class="grid">
                <div class="header-menu-flex">
                    <div class="header-menu_product">
                        <ul class="header-menu_product-list">
                            <a href="../index.php" class="header-menu_product-link">
                                <li style="padding:0 30px;" class="header-menu_product-item">
                                    <i class="fix-item-icon fa-solid fa-house"></i>
                                    <p class="product-item_name">Home</p>
                                </li>
                            </a>
                            <a href="./logout.php?logout" class="header-menu_product-link">
                                <li style="padding:0 30px;" class="header-menu_product-item">
                                    <i class="fix-item-icon fa-solid fa-circle-xmark"></i>
                                    <p class="product-item_name">Logout</p>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <div class="header-menu_user">
                        <ul class="header-menu_product-list">
                            <li class="header-menu_product-item">
                                <?php
                                if (!empty($_SESSION['current_user'])){
                                    ?>
                                <i class="fix-item-icon fa-solid fa-user"></i>
                                <a class="header-menu_product-link product-link_style" href=""> Xin chào
                                    <?= $_SESSION['current_user']['username'] ?> </a>
                                <?php
                                }
                                
                            ?>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body">
        <div class="grid">
            <div class="grid_flex">
                <div class="grid_flex-left">
                    <div class="grid_flex-left__header">
                        <p class="grid_flex-left__header-text">
                            <a href="./admin.php" class="left__link-header">ADmin Page</a>
                        </p>
                    </div>
                    <div class="grid_flex-left__item">
                        <ul class="grid_flex-left__ul">
                            <?php if ($_SESSION['current_user']['status'] == 'admin') { ?>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?listadmin" class="grid_flex-left__a">List Admin</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?listsuper" class="grid_flex-left__a">List Super</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?listuser" class="grid_flex-left__a">List User</a>
                            </li>
                            <?php } ?>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?uploadimg" class="grid_flex-left__a">Upload Ảnh</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?setslider" class="grid_flex-left__a">Slider</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?upload" class="grid_flex-left__a">Upload Sản Phẩm</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?dsSpham" class="grid_flex-left__a">Danh Sách Sản Phẩm</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./admin.php?orderlist" class="grid_flex-left__a">Danh Sách Đơn Hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="grid_flex-right">
                    <?php
                    if(empty($_GET)){
                        ?>
                    <img class="grid_flex-right__img" src="../assets/imgs/admin/Set.png" alt="txt">
                    <?php
                    }
                    if(isset($_GET['listuser'])){
                        include './listuser.php';
                    }
                    if(isset($_GET['listadmin'])){
                        include './listadmin.php';
                    }
                    if(isset($_GET['listsuper'])) {
                        include '../user/listsuper.php';
                    }
                    if(isset($_GET['upload'])){
                        include '../product/upload.php';
                    }
                    if(isset($_GET['uploadimg'])){
                        include '../product/uploadimg.php';
                    }
                    if(isset($_GET['dsSpham'])){
                        include '../product/listproduct.php';
                    }
                    if(isset($_GET['idproduct']) || isset($_GET['delete_product']) ){
                        include '../product/fixproduct.php';
                    }
                    if(isset($_GET['setslider'])) {
                        include '../slider/slider.php';
                    }
                    if(isset($_GET['orderlist'])) {
                        include '../user/lisetoder.php';
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
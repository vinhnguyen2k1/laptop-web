<?php 
session_start();
include '../checkrole/checklogin.php'; ?>

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
                            <a href="../user/logout.php?logout" class="header-menu_product-link">
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
    <div class="body" style="min-height: 500px;">
        <div class="grid">
            <div class="grid_flex">
                <div class="grid_flex-left">
                    <div class="grid_flex-left__header">
                        <p class="grid_flex-left__header-text">
                            <a href="" class="left__link-header">Tài Khoản Của Tôi</a>
                        </p>
                    </div>
                    <div class="grid_flex-left__item">
                        <ul class="grid_flex-left__ul">
                            <li class="grid_flex-left__li">
                                <a href="./view-user.php?i4user" class="grid_flex-left__a">Hồ Sơ</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./view-user.php?checkorder" class="grid_flex-left__a">Đơn Hàng</a>
                            </li>
                            <li class="grid_flex-left__li">
                                <a href="./view-user.php?changepass" class="grid_flex-left__a">Đổi Mật Khẩu</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="grid_flex-right" style="min-height: 450px;">
                    <?php
                    if(empty($_GET)){
                        ?>
                    <img class="grid_flex-right__img" src="../assets/imgs/admin/Set.png" alt="txt">
                    <?php
                    }
                    switch($_SERVER['QUERY_STRING']) {
                        case 'i4user':
                            include './i4user.php';
                            break;
                        case 'checkorder':
                            include './checkorder.php';
                            break;
                        case 'changepass':
                            include './changepass.php';
                            break;
                        // default:
                        //     echo '<meta http-equiv="refresh" content="0;url=../user/login.php">';
                        //     break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
</body>
<style>

</style>

</html>
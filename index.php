<!-- SELECT * FROM `products` WHERE `price` >= 5000000 AND `price` <= 10000000 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="./assets/imgs/favicon/logo.png" />
    <title>Sell LapTop</title>
</head>

<body style="background-color: rgb(241, 241, 240);">
    <!-- PHP -->
    <?php
  include "./setindex.php";
  ?>
    <!-- Header -->
    <div id="header">
        <div class="grid">
            <div class="header-container">
                <div class="header-container__logo">
                    <a href=".">
                        <img src="./assets/imgs/containerHeader/Logo.png" alt="Logo"
                            class="header-container__logo-size">
                    </a>
                </div>
                <div class="header-container__search">
                    <form class="header-container__search" action="" method="GET" style="width: 100%;">
                        <input class="header-container__search-input" type="text"
                            placeholder="Bạn muốn tìm sản phẩm gì?" name="search" autocomplete="off">
                        <button class="header-container__search-icon" style="padding-top:0;" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <!-- cart in index -->
                <div class="header-container__cart neo-more__card">
                    <div class="cart-icon">
                        <!-- quantiny (red) product in cart -->
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            $productRow = 0;
                            foreach($_SESSION['cart'] as $key => $value){
                                $productRow++;
                            }
                            ?>
                        <div class="box-quantity">
                            <span class="box-quantity__txt"><?= $productRow ?></span>
                        </div>
                        <?php } ?>
                        <!-- end quantiny product in cart -->
                        <!-- icon cart -->
                        <a href="./cart/cart.php">
                            <i class="fa-sharp fa-solid fa-cart-shopping header-container__cart-icon"></i>
                        </a>
                        <!-- more cart -->
                        <?php include './more-cart.php' ?>
                        <!-- end more cart -->
                    </div>
                    <!-- end cart -->
                </div>
            </div>
        </div>
        <div class="header-menu">
            <div class="grid">
                <div class="header-menu-flex">
                    <div class="header-menu_product">
                        <ul class="header-menu_product-list">
                            <li class="header-menu_product-item">
                                <i class="fix-item-icon fa-sharp fa-solid fa-laptop"></i>
                                <p class="product-item_name">Danh Mục</p>
                                <ul class="more-list_menu">
                                    <li class="menu-item__space">Hãng Sản Xuất</li>
                                    <div class="about-laptop">
                                        <ul class="about-laptop__list">
                                            <a href="?manufacturer=HP" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">HP</li>
                                            </a>
                                            <a href="?manufacturer=MSI" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">MSI</li>
                                            </a>
                                            <a href="?manufacturer=Asus" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Asus</li>
                                            </a>
                                            <a href="?manufacturer=Acer" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Acer</li>
                                            </a>
                                            <a href="?manufacturer=Dell" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Dell</li>
                                            </a>
                                            <a href="?manufacturer=Apple" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Apple</li>
                                            </a>
                                            <a href="?manufacturer=Tosiba" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Tosiba</li>
                                            </a>
                                            <a href="?manufacturer=Lenovo" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Lenovo</li>
                                            </a>
                                            <a href="?manufacturer=Sam Sung" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">SamSung</li>
                                            </a>
                                            <a href="?manufacturer=SonyVAIO" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Sony VAIO</li>
                                            </a>
                                            <a href="?manufacturer=Think Pad" class="more-menu__dm-link">
                                                <li class="more-list_menudm-items">Think Pad</li>
                                            </a>
                                        </ul>
                                    </div>
                                </ul>
                                <style>
                                .about-laptop {
                                    display: block;
                                    margin: 0;
                                    padding: 0 20px;
                                }

                                .about-laptop__list {}

                                .more-list_menu {
                                    padding-top: 0;
                                    display: none;
                                }

                                .menu-item__space {
                                    background-color: var(--color-shop);
                                    padding: 2px 20px;
                                    width: 100%;
                                    display: block;
                                    color: white;
                                }

                                .more-list_menudm-items {
                                    display: inline-block;
                                    max-width: 200px;
                                    min-width: 200px;
                                    padding: 5px 0;
                                    transition: .5s;
                                }

                                .more-menu__dm-link {
                                    text-decoration: none;
                                    color: black;
                                }

                                .more-menu__dm-link:hover .more-list_menudm-items {
                                    padding-left: 10px;
                                }

                                .more-menu__dm-link:hover {
                                    color: var(--color-shop);
                                }
                                </style>
                            </li>
                            <li class="header-menu_product-item">
                                <i class="fix-item-icon fa-brands fa-hotjar"></i>
                                <a href="./?discount" style="text-decoration: none; color:var(--white-text);">
                                    <p class="product-item_name">Khuyến Mãi</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="header-menu_user">
                        <ul class="header-menu_product-list">
                            <?php if (!empty($_SESSION['current_user'])) { ?>
                            <li class="hover_dot-down header-menu_product-item">
                                <i class="fix-item-icon fa-solid fa-user"></i>
                                <a class="header-menu_product-link product-link_style">
                                    <?= $_SESSION['current_user']['username'] ?> </a>
                                <i class="user-icon-down fa-solid fa-caret-down" style="margin-left:5px;"></i>
                                <i class="fa-solid fa-circle user-icon-dot" style="font-size:8px; margin-left:5px;"></i>
                                <ul class="more-list_user-menu">
                                    <?php if ($_SESSION['current_user']['status'] == 'admin' || $_SESSION['current_user']['status'] == 'super') { ?>
                                    <a href="./user/admin.php" class="more-list_user-link">
                                        <li class="more-list_menu-item">
                                            <p class="user-more__choice"> Admin Page</p>
                                        </li>
                                    </a>
                                    <?php } ?>
                                    <a href="./i4user/view-user.php?i4user" class="more-list_user-link">
                                        <li class="more-list_menu-item">
                                            <p class="user-more__choice">Thông tin User</p>
                                        </li>
                                    </a>
                                    <a href="./user/logout.php?logout" class="more-list_user-link">
                                        <li class="more-list_menu-item">
                                            <p class="user-more__choice">Đăng xuất</p>
                                        </li>
                                    </a>
                                </ul>
                            </li>
                            <?php } else { ?>
                            <li class="header-menu_product-item">
                                <a class="header-menu_product-link product-link_style" href="./user/login.php">Đăng
                                    nhập</a>
                            </li>
                            <li class="header-menu_product-item">
                                <a class="header-menu_product-link product-link_style" href="./user/create.php">đăng
                                    ký</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- body -->
    <div class="body">
        <div class="grid">
            <?php if (isset($_GET['viewi4']) && isset($_GET['id'])) {
        include './product/viewProduct.php';
      } else
        //hiển thị các sản phẩm
        include './listpview.php'; ?>
        </div>
    </div>
    </div>
    <!-- I4 -->
    <div class="I4">
        <div class="body">
            <div class="grid">
                <div class="i4-flex">
                    <!--  -->
                    <div class="i4-flex__item">
                        <div class="i4-flex__item-img"></div>
                        <div class="i4-flex__item-text">
                            <p class="i4__item-text">Nhiều mặt hàng mới</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="i4-flex__item">
                        <div class="i4-flex__item-img"></div>
                        <div class="i4-flex__item-text">
                            <p class="i4__item-text">Giao hàng toàn quốc</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="i4-flex__item">
                        <div class="i4-flex__item-img"></div>
                        <div class="i4-flex__item-text">
                            <p class="i4__item-text">Mua hàng từ xa</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="i4-flex__item">
                        <div class="i4-flex__item-img"></div>
                        <div class="i4-flex__item-text">
                            <p class="i4__item-text">đổi trả trong vòng 15 ngày</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="i4-flex__item">
                        <div class="i4-flex__item-img"></div>
                        <div class="i4-flex__item-text">
                            <p class="i4__item-text">hỗ trợ suốt thời gian sử dụng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?PHP include './footer.php'; ?>

</body>
<style>
.box-quantity {
    position: absolute;
    width: 24px;
    height: 24px;
    top: -15px;
    right: -12px;
    background-color: red;
    border-radius: 50%;
    display: flex;
}

.box-quantity__txt {
    margin: auto;
    font-size: 14px;
    color: var(--text-white);
    font-weight: 700;
}
</style>

</html>
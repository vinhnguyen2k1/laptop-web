<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../assets/css/style.css">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/imgs/favicon/logo.png" />
    <title>Sell LapTop</title>
</head>

<body class="body-class">
    <?php
    session_start();
    include "../conect_db.php";
    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'reg') {
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "SELECT `idUser`,`username`,`creat_date`,`password`,`status` FROM `user` WHERE (`username`='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
        }
        if (!$result) {
            $error = 'Error';
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
            $test = $_POST['username'];
        }
        mysqli_close($con);
        if ($error !== false || $result->num_rows == 0) {
    ?>
    <div class="body">
        <div class="grid">
            <div class="form-login">
                <div class="space-logo__login">
                    <a href="../">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <form class="form-flex" action="./login.php?action=reg" method="Post" autocomplete="off">
                    <p class="form-login__input-text login-i4">* thông tin không chính xác</p>
                    <style>
                    .login-i4 {
                        color: red;
                    }
                    </style>
                    <div class="form-login__input-size">

                        <input type="text" placeholder="User Name" name="username" required="" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">
                        <input type="password" placeholder="Password" name="password" required=""
                            class="form-login__input" value="">
                    </div>
                    <div class="form-login__btn-size">
                        <input class="form-login__btn-style" type="submit" value="Đăng nhập">
                    </div>
                </form>
                <div class="form-hide__checkbox">
                    <input type="checkbox" class="form-hide-password"> Ẩn/Hiện Mật khẩu
                </div>
                <div class="clear"></div>
                <label class="form-login__Blank">bạn chưa có tài khoản? <a href="../user/create.php"
                        class="form-login__Blank-a">Đăng ký</a></label>
            </div>
        </div>
    </div>
    <?php
            exit;
        }
    }
    if (empty($_SESSION['current_user'])) {
        ?>
    <div class="body">
        <div class="grid">
            <div class="form-login">
                <div class="space-logo__login">
                    <a href="../">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <?php
                    if (!empty($_SESSION['ok_creat'])) {
                    ?>
                <h1 style="text-align:center; margin-bottom:30px; color:green;">Đăng ký tài khoản thành công!</h1>
                <?php
                    }
                    ?>

                <form class="form-flex" action="./login.php?action=reg" method="Post" autocomplete="off">
                    <div class="form-login__input-size">

                        <input type="text" placeholder="User Name" name="username" required="" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="Password" name="password" required=""
                            class="form-login__input" value="">
                    </div>
                    <div class="form-login__btn-size" style="width:100%;">
                        <input class="form-login__btn-style" type="submit" value="Đăng nhập">
                    </div>
                </form>
                <div class="form-hide__checkbox">
                    <input type="checkbox" class="form-hide-password"> Ẩn/Hiện Mật khẩu
                </div>
                <div class="clear"></div>
                <label class="form-login__Blank">bạn chưa có tài khoản? <a href="../user/create.php"
                        class="form-login__Blank-a">Đăng ký</a></label>
            </div>
        </div>
    </div>
    <?php
    } else {
    ?>
    <meta http-equiv="refresh" content="0;url=../">
    <?php }
    unset($_SESSION['ok_creat']);
    ?>
</body>
<script>
   document.querySelector('.form-hide-password').onclick = () => {
        if(document.querySelector('.form-hide-password').checked) {
            document.querySelector('input[name=password]').type = 'text';
        }else {
            document.querySelector('input[name=password]').type = 'password';
        }
   }
</script>
</html>